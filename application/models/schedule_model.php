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

  function get_last_ten_entries()
  {
    $query = $this->db->get('ls_schedule', 10);
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
  function search($day, $group)
  {
    $query = $this->db->get_where('ls_schedule', array('day' => $day, 'group'), 1);
    return $query->result();
  }
}