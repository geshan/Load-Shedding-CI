<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
  
  var $days= array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
  var $groups = array('2','3','4','5','6','7');
  var $group1 = array('Sunday' => '', 'Monday' => '', 'Tuesday' => '',
	                	'Wednesday' => '', 'Thursday' => '', 'Friday' =>'',
	                	'Saturday' => ''
	                  );
  var $group2to7;
  
	function __construct()
	{
		parent::__construct();
		$this->load->model('schedule_model', 'schedule');
		$this->load->library('template');
	}
	
	//---------------------------------------------------------------
	
	function index()
	{	
		
	}

	//---------------------------------------------------------------	
	
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
	
	function show()
	{
	  
	  
	  $this->_set_vars();
	  
	  //print_r($group2to7);
	    
	  $this->template->set('days',$this->days);
	  $this->template->set('group2to7', $this->group2to7);
	  $this->template->set('group1',$this->group1);
	  
	  $this->template->render();
	}
	
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
	  
    $no_light = $this->_check_light($group, $nepal_day);
	  if($no_light) {
	    $message = "Group ". $group . " does not have light right now.";
	    $full_message = "It is ". $nepal_time_h_m_s ." - ". $nepal_day ." at the current moment and ". $message;
	    $this->template->set('msg_class', 'no');
	  }
	  else {
	    $message = "Group ". $group . " has light right now.";
	    $full_message = "It is ". $nepal_time_h_m_s ." - ". $nepal_day ." at the current moment and ". $message;
	    $this->template->set('msg_class', 'yes');
	  }
	  
	  $this->template->set('custom_message', $message);
	  $this->template->set('full_message', $full_message);
	  $this->template->render();
	  //check if there is light;
	}
	
	/********************** ================== Web API functions Part Start ====================== *****************/
	function check_current($group = 1, $nepal_day=0)
	{
	  $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	  $nepal_time =  $dateTime->format("Y-m-d H:i:s");
	  $nepal_time_h_m_s = $dateTime->format("H:i:s");
	   
	  if($nepal_day == 0) {
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
	   
	  $no_light = $this->_check_light($group, $nepal_day);
	  if($no_light) {
	    $output['light_status'] = 0;
	    $output['message'] = "Group ". $group . " does not have light right now.";
	    $output['full_message'] = "It is ". $nepal_time_h_m_s ." - ". $nepal_day ." at the current moment and ". $output['message'];
	  }
	  else {
	    $output['light_status'] = 1;
	    $output['message'] = "Group ". $group . " has light right now.";
	    $output['full_message'] = "It is ". $nepal_time_h_m_s ." - ". $nepal_day ." at the current moment and ". $output['message'];
	  }
	  
	  $xml	= array_to_xml($output,1,'messages' );
	  header('Content-Type: application/xml');
	  print $xml;
	}
	/********************** ================== Web API functions Part End ====================== *****************/
	
	/********************** ================== Private functions Part Start ====================== *****************/
	function _lookup_schedule($group = '2', $day = 'Sunday')
	{
	  $group1_day =  $this->schedule->lookup($group, $day);
	  //print $group1_day .'<br>';
	  return $group1_day;
	}
	
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
	
	function _set_vars() 
	{
	  //$group2to7[][] = '';
	   
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
	
	function _check_light($group = '1', $nepal_day)
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
	  
	  $ls_times = explode('<br/>', $this->group1[$group1_day]);
	  
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
	      if($nepal_time_h_m_s > $ls[0] && $nepal_time_h_m_s < $ls[1]) {
	        $no_light = 1;
	        break;
	      }  
	    }
	  }
	  
	  
	  return $no_light;
	  
	}
	
	/********************** ================== Private functions Part End ====================== *****************/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */