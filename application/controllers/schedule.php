<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Controller to show the schedule as tabel and handle all schedule related tasks
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/schedule
	 *	- or -  
	 * 		http://example.com/index.php/schedule/index
	 *	- or -
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/schedule/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 * @author Geshan Manandhar
	 * @version 1.0 - 3-Jan-2011
	 * 
	 * 	 
	 * */
  
  /**
   * Some global/controller wide variables to set the things set by _set_vars function
   * Enter description here ...
   * @var unknown_type
   */
  var $days= array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
  var $groups = array('2','3','4','5','6','7');
  var $group1 = array('Sunday' => '', 'Monday' => '', 'Tuesday' => '',
	                	'Wednesday' => '', 'Thursday' => '', 'Friday' =>'',
	                	'Saturday' => ''
	                  );
  var $group2to7;
  var $statuses;
  var $light_back = 0;
  var $last_date;
  
  /**
   * 
   * Simple constructor with
   * loading module and library required
   */
	function __construct()
	{
		parent::__construct();
		$this->load->model('schedule_model', 'schedule');
		$this->load->library('template');
	}
	
	/**
	 * Main index function
	 * is routed to when index.php/schedule/ is entered as URL
	 */
	function index()
	{	
	  redirect('/schedule/show/', 'refresh');
	}

	
	/**
	 * 
	 * Simple get function to get last 15 entries
	 */
	function get()
	{
	  
	  $results = $this->schedule->get_last_15_entries();
	  $this->load->library('table');
	  
  	if ($results)
    {
     foreach ($results as $row)
     {
        echo $row->group;
        echo $row->day;
        echo $row->start_time;
        echo "<br/>";
     }
  	}
	}
	
	/**
	 * Function to render the schedule as a table
	 * Table is similar to that provided by NEA
	 */
	function show()
	{
	  $this->_set_current_status();
	  $this->_set_vars();
	  
	  //print_r($group2to7);
	  $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	  $nepal_day = $dateTime->format("l");
	  $nepal_time_h_m_s = $dateTime->format("H:i:s");

	  
	  $this->template->set('days',$this->days);
	  $this->template->set('group2to7', $this->group2to7);
	  $this->template->set('group1',$this->group1);
	  $this->template->set('statuses', $this->statuses);
	  $this->template->set('nepal_day', $nepal_day);
	  $this->template->set('nepal_time_h_m_s', $nepal_time_h_m_s);
	  $this->template->set('last_date', $this->last_date);
	  $this->template->render();
	}
	
	/**
	 * 
	 * Function to check if there is electricity or not
	 * as per group, time etc
	 * @param int $group
	 * @param string $nepal_day
	 * @param string $time in format hh:mm and 24h format like 15:30
	 */
	function check($group = 1, $nepal_day = '0', $time = '0') 
	{
	  $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	  $nepal_time =  $dateTime->format("Y-m-d H:i:s");
	  $nepal_time_h_m_s = $dateTime->format("H:i:s");
	 
	  if($nepal_day == '0') {
	    //get today's day
	    $nepal_day = $dateTime->format("l");
	  }
	  if(! in_array($nepal_day, $this->days)) {
	    /*$this->template->set_message('Invalid day given');
	    $this->template->set('message_class', 'error');
	    $this->template->render();*/
	    print "Error in given day";
	    exit();
	  }
	  
    $no_light = $this->_check_light($group, $nepal_day); //no_light 1 is there is no light
	  if($no_light) {
	    $message = "Group ". $group . " does not have light for this time.";
	    $full_message = "It is a check for ". $nepal_time_h_m_s ." - ". $nepal_day ." at the current moment and ". $message;
	    $this->template->set('msg_class', 'no');
	    if($this->light_back != 0) {
	      $this->template->set('light_back_msg', "The light will be back in around " .$this->light_back. " hours.");
	    }
	  }
	  else {
	    $message = "Group ". $group . " has light for this time.";
	    $full_message = "It is a check for ". $nepal_time_h_m_s ." - ". $nepal_day ." and ". $message;
	    $this->template->set('msg_class', 'yes');
	  }
	  
	  $this->template->set('custom_message', $message);
	  $this->template->set('full_message', $full_message);
	  $this->template->set('last_date', $this->last_date);
	  $this->template->render();
	  //check if there is light;
	}
	/**
	 * 
	 * Function to test embed
	 */
	function embed()
	{
	  $this->template->render();
	}
	/********************** ================== Web API functions Part Start ====================== *****************/
	/**
	 * 
	 * Check if there is light currently
	 * as per group and day
	 * Output is XML for other web API consumers
	 * @param int $group
	 * @param string $nepal_day
	 */
	function check_current($group = 1, $nepal_day='0')
	{
	  $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	  $nepal_time =  $dateTime->format("Y-m-d H:i:s");
	  $nepal_time_h_m_s = $dateTime->format("H:i:s");
	   
	  if($nepal_day == '0') {
	    //get today's day
	    $nepal_day = $dateTime->format("l");
	  }
	  if(! in_array($nepal_day, $this->days)) {
	    /*$this->template->set_message('Invalid day given');
	     $this->template->set('message_class', 'error');
	    $this->template->render();*/
	    print "Error in given day";
	    exit();
	  }
	   //check group
	   if( ( ($group !=1) && (!in_array($group, $this->groups))) ) {
	     print "Error in given group should be 1 - 7";
	     exit();
	   }
	 
	  $no_light = $this->_check_light($group, $nepal_day);
	  if($no_light) {
	    $output['light_status'] = 0;
	    $output['message'] = "Group ". $group . " does not have light for this time.";
	    $output['full_message'] = "It is a check for ". $nepal_time_h_m_s ." - ". $nepal_day ." and ". $output['message'];
	    if($this->light_back != 0) {
	      $output['light_back_message']= "The light will be back in around " .$this->light_back. " hours.";
	    }
	  }
	  else {
	    $output['light_status'] = 1;
	    $output['message'] = "Group ". $group . " has light for this time.";
	    $output['full_message'] = "It is a check for ". $nepal_time_h_m_s ." - ". $nepal_day ." and ". $output['message'];
	  }
	  
	  $xml	= array_to_xml($output, 1, 'messages');
	  header('Content-Type: application/xml');
	  print $xml;
	}
	/********************** ================== Web API functions Part End ====================== *****************/
	
	/********************** ================== Private functions Part Start ====================== *****************/
	/**
	 * 
	 * Function to lookup what group 1 day does group x day correspond to
	 * @param int $group
	 * @param string $day
	 */
	function _lookup_schedule($group = 2, $day = 'Sunday')
	{
	  $group1_day =  $this->schedule->lookup($group, $day);
	  //print $group1_day .'<br>';
	  return $group1_day;
	}
	
	/**
	 * 
	 * Function to serach/get the timings etc for group 1
	 * @param string $day
	 * @param string $type
	 * @return string
	 */
	function _search($day = 'Sunday', $type='First')
	{
	  $result = $this->schedule->search($day, $type);
	  $ret = '';
	  foreach ($result as $row) {
	    $ret .=$row->start_time . ' - ' . $row->end_time;
	    $ret .='<br/>'; 
	  }
	  return $ret; 
	}
	
	/**
	 * 
	 * Function to set global variables for group1 and group2to7
	 * main function to execute logic from db
	 * should be called just once
	 */
	function _set_vars() 
	{
	  //$group2to7[][] = '';
	  if($this->group1['Sunday'] == '') {
	    foreach($this->days as $day) {
	      $this->group1[$day] .= $this->_search($day, 'First');
	      $this->group1[$day] .= $this->_search($day, 'Second');
	    }
	    
	    foreach($this->groups as $group){
	      foreach($this->days as $day) {
	        $this->group2to7[$group][$day] = $this->group1[$this->_lookup_schedule($group, $day)];
	      }
	    
	    }  
	  }

	  $this->last_date = $this->schedule->getLastDate();
	   
	}
	

	/**
	 * 
	 * Function that checks light or not in given group for particular day
	 * @param int $group
	 * @param string $nepal_day
	 */
	function _check_light($group = 1, $nepal_day)
	{
	  
	  $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	  $nepal_time =  $dateTime->format("Y-m-d H:i:s");
	  $nepal_time_h_m_s = $dateTime->format("H:i:s");
	  
	  	  //check group
    
	  $this->_set_vars();
	  
	  if($group == '1') {
	    $group1_day = $nepal_day;
	  }
	  else {
	    $group1_day = $this->_lookup_schedule($group, $nepal_day);
	  }
	  
	  $ls_times = explode('<br/>', $this->group1[$group1_day]); //breaking for comparion
	  
	  $ls_timing[0] = explode(' - ', $ls_times[0]);
	  if(isset($ls_times[1])) {
	    $ls_timing[1] = explode(' - ', $ls_times[1]);
	  }
	  if(empty($ls_times[1])) {
	    unset($ls_times[1]);
	  }
	  unset($ls_times[2]);
	  //print_r($ls_timing);
	
	  //print $nepal_time ." - ". $nepal_day;
	  $no_light = 0;
	  foreach ($ls_timing as $ls) {
	    if( (isset($ls[0]) && isset($ls[1])) ) {
	      if($nepal_time_h_m_s > $ls[0] && $nepal_time_h_m_s < $ls[1]) { //simple time comparision is working till now
	        //@todo will need chage of logic
	        $no_light = 1;
	        $this->_set_light_back($ls[1], $nepal_time_h_m_s);
	        break;
	      }  
	    }
	  }
	  return $no_light;
	}
	
	/**
	*
	* Function to set when light will be back
	* called only if there is load shedding now,
	* does not return anything but sets a controller wide variable light_back with estimated hours
	* for light to come back.
	* @param unknown_type $end_time
	* @param unknown_type $nepal_time_h_m_s
	*/
	function _set_light_back($end_time, $nepal_time_h_m_s)
	{
	  $to_time=strtotime($end_time);
	  $from_time=strtotime($nepal_time_h_m_s);
	  $this->light_back = round(abs($to_time - $from_time) / 3600,1); //in hours
	  //print "<h3>Light will be back in around " .$light_back. "</h3>";
	  //$light_go =
	}
	
	/**
	 * 
	 * Function to set current statuses
	 */
	function _set_current_status()
	{
	  
	  $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	  $nepal_time =  $dateTime->format("Y-m-d H:i:s");
	  $nepal_time_h_m_s = $dateTime->format("H:i:s");
	  $nepal_day = $dateTime->format("l");
	  
	  $this->statuses[1] = !($this->_check_light(1, $nepal_day));
	  foreach($this->groups as $group) {
	    $this->statuses[$group] = !($this->_check_light($group, $nepal_day));
	  }

	}
	
	/********************** ================== Private functions Part End ====================== *****************/
}

/* End of file schedule.php */
/* Location: ./application/controllers/schedule.php */