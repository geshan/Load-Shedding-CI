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
  
  function search($day = 'Sunday', $type='First') {
    $query = $this->db->get_where('ls_schedule', array('day'=> $day,
                                                        'group' => '1',
                                                        'status' => '1',
                                                        'type' => $type
                                                      )
                                  );
    return $query->result();
  }
}