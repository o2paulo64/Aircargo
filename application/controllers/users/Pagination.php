<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagination extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
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

    $limit_per_page = 5;
    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
    $total_records = 1395;

    $data['aircraft']=$this->EventModel->get_aircraft($limit_per_page,($start_index-1)*5);
    $title['browserTitle']='Home';
             
    $config['base_url'] = base_url().'home/index';
    $config['total_rows'] = $total_records;
    $config['per_page'] = $limit_per_page;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';

    $config['num_links'] = 2;

    $config['first_link']='First';
    $config['first_tag_open'] = '<li class="waves-effect">';
    $config['first_tag_close'] = '</li>';
     
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="waves-effect">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = 'chevron_right';
    $config['prev_link'] = 'chevron_left';
    $config['next_tag_open'] = '<li class="waves-effect"><i class="material-icons">';
    $config['next_tag_close'] = '</i></li>';

    $config['prev_tag_open'] = '<li class="waves-effect"><i class="material-icons">';
    $config['prev_tag_close'] = '</i></li>';

    $config['num_tag_open'] = '<li class="waves-effect">';
    $config['num_tag_close'] = '</li>';
    
    $config["uri_segment"] = 3;
    $config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    // build paging links
    $data["links"] = $this->pagination->create_links();   

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