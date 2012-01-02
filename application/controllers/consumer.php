<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consumer extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library('template');
  }
  
  //---------------------------------------------------------------
  
  function index()
  {
  
  }
  
  //---------------------------------------------------------------
  
  function get()
  {
   
    
    $url="http://http://localhost/wbs/index.php/schedule/check_current/4";
    $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
    curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4s
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); // add POST fields
    $result = curl_exec($ch); // run the whole proc
    print $result;
    print "working";
    //return $result;
    /*$xml = new SimpleXMLElement($result);
    $contents=(array)$xml;*/
    
    //print_r($contents);
    
  }
  
  
}