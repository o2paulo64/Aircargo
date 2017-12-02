<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Projects extends CI_Controller 
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
    $sessionData = $this->session->userdata('logged_in');
    $timezone="Asia/Singapore";
    date_default_timezone_set($timezone);
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; //means user can be anyone 
    $sort='';
    $limit_per_page = 10;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
    $orderBy=$this->input->get('sortBy');
    $searchString=$this->input->get('search');

    if($searchString) {
      $search_count= $this->EventModel->search_gov_proj_count($searchString);
      $data['searchString']=$searchString;
      if($search_count==0){
        $data['searchExist']=0;
        $data['searchResult']='No results for keyword: '.$searchString.'';
      }
      else {
        $data['searchExist']=1;
      }
    }else{
      $data['searchExist']=0;
      $data['searchResult']='';
    } 
    
    $data['searchString']=$searchString;

    if($orderBy=='region'){
      $sort='region';
      $order='desc';
    }
    elseif ($orderBy=='district'){
      $sort='district';
      $order='desc';
    }
    elseif ($orderBy=='location'){
      $sort='location_name';
      $order='desc';
    }
    elseif ($orderBy=='cost'){
      $sort='cost';
      $order='desc';
    }
    elseif ($orderBy=='district_ascending'){
      $sort='district';
      $order='asc';
    }
    elseif ($orderBy=='location_ascending'){
      $sort='location_name';
      $order='asc';
    }
    elseif ($orderBy=='cost_ascending'){
      $sort='cost';
      $order='asc';
    }
    elseif ($orderBy=='region_ascending'){
      $sort='region';
      $order='asc';
    }
    else{
      $sort='default';
      $order='asc';
      $orderBy='default';
    }

    //*************************************PAGINATION***********************************//
    if($data['searchExist']){
      $data['gov_proj']=$this->EventModel->search_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order,$searchString);
      $config['total_rows'] = $this->EventModel->search_gov_proj_count($searchString);
      $data['total_rows'] = $config['total_rows'];
      $data['searchResult']=$data['total_rows'].' result/s for keyword: '.$searchString.'';
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Projects/index';
      $config['first_url']= base_url().'users/Projects/index?sortBy='.$orderBy.'&search='.$searchString.'';
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&search='.$searchString.'';
    }
    else{
      $data['gov_proj']=$this->EventModel->get_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order);
      $config['total_rows'] = $this->EventModel->get_gov_proj_count();
      $data['total_rows'] = $config['total_rows'];

      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Projects/index';
      $config['first_url']= base_url().'users/Projects/index?sortBy='.$orderBy.'';
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'';
    }



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
    
    
    $config['use_page_numbers'] = TRUE;

    $this->pagination->initialize($config);

    // build paging links
    $data["links"] = $this->pagination->create_links(); 

    //*****************************END OF PAGINATION*********************************//

    $title['browserTitle']='Government Projects';
    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('users/projects',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('users/projects',$data);
    }

    $this->load->view('includes/foot');
  }
}

?>