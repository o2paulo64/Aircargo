<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contracts extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
    $this->load->model('ContractModel','',TRUE);
  }

  function index()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; //means user can be anyone 

    $data['authority']=$authority;

    $sort='';
    $limit_per_page = 10;
    $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
    $orderBy=$this->input->get('sortBy');
    $searchString=$this->input->get('search');

    if($searchString) {
      $search_count= $this->ContractModel->search_gov_proj_count($searchString);
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
    else if($orderBy=='contractor_name_ascending'){
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

    //*************************************PAGINATION***********************************//
    if($data['searchExist']){
      $data['gov_proj']=$this->ContractModel->search_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order,$searchString);
      $config['total_rows'] = $this->ContractModel->search_gov_proj_count($searchString);
      $data['total_rows'] = $config['total_rows'];
      $data['searchResult']=$data['total_rows'].' result/s for keyword: '.$searchString.'';
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Contracts/index';
      $config['first_url']= base_url().'users/Contracts/index?sortBy='.$orderBy.'&search='.$searchString.'';
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&search='.$searchString.'';
    }
    else{
      $data['gov_proj']=$this->ContractModel->get_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order);
      $config['total_rows'] = $this->ContractModel->get_gov_proj_count();
      $data['total_rows'] = $config['total_rows'];

      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Contracts/index';
      $config['first_url']= base_url().'users/Contracts/index?sortBy='.$orderBy.'';
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

    $title['browserTitle']='Government Contracts';
    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('users/Contracts',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('users/Contracts',$data);
    }

    $this->load->view('includes/foot');
  }

  function editContract()
  {
    $proj=$this->input->post('proj');
    $data['contractor_id']=$proj[0];
    $data['office_id']=$proj[1];
    $data['contractor_name']=$proj[2];
    $data['region']=$proj[3];
    $data['district']=$proj[4];
    $data['start_date']=$proj[5];

    $title['browserTitle']='Government Contracts';

    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/editContract',$data);
    }
    else{
      redirect('home','refresh');
    }


    $this->load->view('includes/foot');   
  }

  function edit()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $title['browserTitle']='Government Contracts';
      $this->form_validation->set_rules('contractor_name','Contractor Name', 'required');
      $this->form_validation->set_rules('region','region', 'required');
      $this->form_validation->set_rules('district','district', 'required');
      $this->form_validation->set_rules('start_date','start_date', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $data = array(
        'contractor_id' => $this->input->post('contractor_id'),
        'office_id' => $this->input->post('office_id'),
        'contractor_name' => $this->input->post('contractor_name'),
        'region' => $this->input->post('region'),
        'district' => $this->input->post('district'),
        'start_date' => $this->input->post('start_date')
        );

        $this->load->view('includes/head',$title);

        $this->load->view('admin/editContract',$data);
        $this->load->view('includes/foot');
      }
      else{
        $ip=array( //contractor
        'contractor_id' => $this->input->post('contractor_id'),
        'contractor_name' => $this->input->post('contractor_name')
        );
        $op=array( //infra office
          'office_id' => $this->input->post('office_id'),
          'region' => $this->input->post('region'),
          'district' => $this->input->post('district')
        );
        $cr=array( //contracts
          'office_id' => $this->input->post('office_id'),
          'contractor_id' => $this->input->post('contractor_id'),
          'start_date' => $this->input->post('start_date')
        );

        $this->ContractModel->update_proj($ip,$op,$cr);
        $this->session->set_flashdata('editProjSuccess',1);
        redirect('users/Contracts');
      }
    }
    else
      redirect('home','refresh');
  }

  function createContract()
  {
   $title['browserTitle']='Government Contracts';
   $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/createContract');
    }
    else{
      redirect('home','refresh');
    }
    $this->load->view('includes/foot');     
  }

  function create()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $title['browserTitle']='Government Contracts';
      $this->form_validation->set_rules('contractor_name','Contractor Name', 'required');
      $this->form_validation->set_rules('region','region', 'required');
      $this->form_validation->set_rules('district','district', 'required');
      $this->form_validation->set_rules('start_date','start_date', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $this->load->view('includes/head',$title);

        $this->load->view('admin/createContract');
        $this->load->view('includes/foot');
      }
      else{
        $ip=array( //contractor
        'contractor_name' => $this->input->post('contractor_name')
        );
        $contractor_id=$this->ContractModel->create_proj1($ip);

        $op=array(
          'region' => $this->input->post('region'),
          'district' => $this->input->post('district')
        );
        $office_id=$this->ContractModel->create_proj2($op);


        $cr=array(
          'office_id' => $office_id,
          'contractor_id' => $contractor_id,
          'start_date' => $this->input->post('start_date')
        );

        $this->ContractModel->create_proj3($cr);
        $this->session->set_flashdata('createProjSuccess',1);
        redirect('users/Contracts');
      }  
    }
    else
      redirect('home','refresh');
  }

  function deleteContract()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $proj=$this->input->post('proj');
      $data['contractor_id']=$proj[0];
      $data['office_id']=$proj[1];

      $this->ContractModel->delete_proj($data);
      $this->session->set_flashdata('deleteProjSuccess',1);

      redirect('users/Contracts'); 
    }
    else
      redirect('home','refresh');  
  }
}


?>