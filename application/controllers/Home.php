<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('EventModel','',TRUE);
  }

 function index()
 {
    $sessionData = $this->session->userdata('logged_in');
    if(!$sessionData)
      $authority=0;
    else
      $authority=$sessionData['authority'];
    $title['browserTitle']='Home';
    $data['dummy']='data';

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('home',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('home',$data);
    }

    $this->load->view('includes/foot');
  }
}

?>