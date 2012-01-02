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
	  
	  $results = $this->schedule->get_last_ten_entries();
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
	  $this->view->days = 
	  $days= array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	  $this->template->set('days',$days);
	  $this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */