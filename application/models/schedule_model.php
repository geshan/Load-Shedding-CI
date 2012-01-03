<?php
class Schedule_Model extends CI_Model {

  var $day   = '';
  var $group = '';
  var $effective_from    = '';
  var $start_time    = '';
  var $end_time    = '';
  var $type    = '';
  var $status    = '';
  var $created_on = '';
  var $modified_on    = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   * 
   * Random function to get last 15 entries from the db limit 15
   */
  function get_last_15_entries()
  {
    $query = $this->db->get('ls_schedule', 15);
    return $query->result();
  }
/*
  function insert_entry()
  {
    $this->title   = $_POST['title']; // please read the below note
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->insert('entries', $this);
  }

  function update_entry()
  {
    $this->title   = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->update('entries', $this, array('id' => $_POST['id']));
  }
*/
  /**
   * 
   * Function to use the hash_map to lookup
   * what date of X group is same to the day of group 1
   * @param int $group
   * @param string $day
   * @return NULL or group1 day as string
   */
  function lookup($group='2', $day = 'Sunday')
  {
    $query = $this->db->get_where('ls_hash_map', array('xday1' => $day, 'xgroup' => $group), 1);
    if($query->num_rows > 0) {
      $row = $query->row();
      return $row->group1_day;
     /* $query2 = $this->db->get_where('ls_schedule', array('day'=>$group1_day, 
      																										'group' => '1', 
      																										'status' => '1', 
      																										'type' => $type
      																										)
                                    );
      return $query2->result();*/
    }
    else {
      return NULL;
    }
    
  }
  
  /**
   * 
   * Function to serach for the corrent start and end time as per day and group1
   * @param string $day
   * @param string $type - First or Second possible
   */
  function search($day = 'Sunday', $type='First') {
    $query = $this->db->get_where('ls_schedule', array('day'=> $day,
                                                        'group' => '1',
                                                        'status' => '1',
                                                        'type' => $type
                                                      )
                                  );
    //@todo get latest schedule and limit by 1
    return $query->result();
  }
}