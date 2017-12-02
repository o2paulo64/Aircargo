<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contracts extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
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
    $sort='';
    $limit_per_page = 10;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
    $orderBy=$this->input->get('sortBy');

    if($orderBy=='contractor_name'){
      $sort='contractor_name';
      $order='desc';
    }
    elseif ($orderBy=='region'){
      $sort='region';
      $order='desc';
    }
    elseif ($orderBy=='district'){
      $sort='district';
      $order='desc';
    }
    elseif ($orderBy=='start_date'){
      $sort='start_date';
      $order='desc';
    }
    elseif ($orderBy=='contractor_name_ascending'){
      $sort='contractor_name';
      $order='asc';
    }
    elseif ($orderBy=='region_ascending'){
      $sort='region';
      $order='asc';
    }
    elseif ($orderBy=='district_ascending'){
      $sort='district';
      $order='asc';
    }
    elseif ($orderBy=='start_date_ascending'){
      $sort='start_date';
      $order='asc';
    }
    else{
      $sort='default';
      $order='asc';
      $orderBy='default';
    }
    $data['prj_contractors']=$this->EventModel->get_contract($limit_per_page,($start_index-1)*10,$sort,$order);
    $data['sort']=$orderBy;
    // $total_records = $data['gov_proj']->num_rows();
    // $data['total']=$total_records;
    $config['base_url'] = base_url().'users/Contracts/index';
    $config['first_url']= base_url().'users/Contracts/index?sortBy='.$orderBy.'';
    $config['total_rows'] = $this->EventModel->get_contract_count();
    $config['per_page'] = $limit_per_page;

    $config['suffix'] = '?sortBy='.$orderBy.'';

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
    
    $config["uri_segment"] = 4;
    $config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    // build paging links
    $data["links"] = $this->pagination->create_links(); 


    $title['browserTitle']='Cargo Deliveries';
    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/adminHome',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('users/contracts',$data);
    }

    $this->load->view('includes/foot');
  }
}

?>