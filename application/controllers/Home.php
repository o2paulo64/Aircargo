<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('UserModel','',TRUE);
    $this->load->model('EventModel','',TRUE);
  }

 function index()
 {
    // $sessionData = $this->session->userdata('logged_in');
    // $timezone=$sessionData['timezone'];
    // if ($timezone==NULL)
    $timezone="Asia/Singapore";
    date_default_timezone_set($timezone);

    // $authority=$sessionData['authority'];
    $authority=0; //means user can be anyone

    $data['aircraft']=$this->EventModel->get_aircraft();
    $title['browserTitle']='Homepage';

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/adminHome',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('home',$data);
    }

    $this->load->view('includes/foot');
  }
}

?>