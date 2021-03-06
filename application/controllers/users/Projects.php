<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Projects extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
    $this->load->model('ProjectModel','',TRUE);
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

    $getAdvanceSearch=$this->input->get('asearch');
    $search=array(
      'region' => $getAdvanceSearch[0],
      'district' => $getAdvanceSearch[1],
      'location_name' => $getAdvanceSearch[2],
      'description' => $getAdvanceSearch[3],
      'cost' => $getAdvanceSearch[4],
      'fundsource_type' => $getAdvanceSearch[5]
    );

    $data['advanceSearchExist']=0;
    $data['searchExist']=0;
    $data['searchResult']='';

    if($search['region'] or $search['district'] or $search['location_name'] or $search['description'] or $search['cost'] or $search['fundsource_type']) {
      $search_count= $this->ProjectModel->advance_search_count($search);
      if($search_count==0){
        $data['advanceSearchExist']=0;
        $data['searchResult']='No results';
      }
      else {
        $data['advanceSearchExist']=1;
      }
    }
    else if($searchString) {
      $search_count= $this->ProjectModel->search_gov_proj_count($searchString);
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
    elseif ($orderBy=='description'){
      $sort='description';
      $order='desc';
    }
    elseif ($orderBy=='cost'){
      $sort='cost';
      $order='desc';
    }
    elseif ($orderBy=='fundsource_type'){
      $sort='fundsource_type';
      $order='desc';
    }
    elseif ($orderBy=='description_ascending'){
      $sort='description';
      $order='asc';
    }
    elseif ($orderBy=='fundsource_type_ascending'){
      $sort='fundsource_type';
      $order='asc';
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
    if($data['advanceSearchExist']){
      $data['gov_proj']=$this->ProjectModel->advance_search($limit_per_page,($start_index-1)*10,$sort,$order,$search);
      $data['searchResult']=$this->ProjectModel->advance_search_count($search).' result/s.';
      $config['total_rows'] = $this->ProjectModel->advance_search_count($search);
      $data['total_rows'] = $config['total_rows'];
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Projects/index';
      $config['first_url']= base_url().'users/Projects/index?sortBy='.$orderBy.'&asearch%5B%5D='.$search['region'].'&asearch%5B%5D='.$search['district'].'&asearch%5B%5D='.$search['location_name'].'&asearch%5B%5D='.$search['description'].'&asearch%5B%5D='.$search['cost'].'&asearch%5B%5D='.$search['fundsource_type'].'';
      $data['search']=$search;
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&asearch%5B%5D='.$search['region'].'&asearch%5B%5D='.$search['district'].'&asearch%5B%5D='.$search['location_name'].'&asearch%5B%5D='.$search['description'].'&asearch%5B%5D='.$search['cost'].'&asearch%5B%5D='.$search['fundsource_type'].'';
    }
    else if($data['searchExist']){
      $data['gov_proj']=$this->ProjectModel->search_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order,$searchString);
      $config['total_rows'] = $this->ProjectModel->search_gov_proj_count($searchString);
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
      $data['gov_proj']=$this->ProjectModel->get_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order);
      $config['total_rows'] = $this->ProjectModel->get_gov_proj_count();
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

  function editProject()
  {
    $proj=$this->input->post('proj');
    $data['project_id']=$proj[0];
    $data['office_id']=$proj[1];
    $data['region']=$proj[2];
    $data['district']=$proj[3];
    $data['location_name']=$proj[4];
    $data['description']=$proj[5];
    $data['cost']=$proj[6];
    $data['fundsource_type']=$proj[7];

    $title['browserTitle']='Government Projects';

    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/editProject',$data);
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
      $title['browserTitle']='Government Projects';
      $this->form_validation->set_rules('region','region', 'required');
      $this->form_validation->set_rules('district','district', 'required');
      $this->form_validation->set_rules('location_name','location', 'required');
      $this->form_validation->set_rules('description','description', 'required');
      $this->form_validation->set_rules('cost','cost', 'numeric|required');
      $this->form_validation->set_rules('fundsource_type','fundsource_type', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $data = array(
        'project_id' => $this->input->post('project_id'),
        'office_id' => $this->input->post('office_id'),
        'office_id' => $this->input->post('office_id'),
        'region' => $this->input->post('region'),
        'district' => $this->input->post('district'),
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost'),
        'fundsource_type' => $this->input->post('fundsource_type')
        );

        $this->load->view('includes/head',$title);

        $this->load->view('admin/editProject',$data);
        $this->load->view('includes/foot');
      }
      else{
        $ip=array(
        'project_id' => $this->input->post('project_id'),
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost')
        );
        $op=array(
          'office_id' => $this->input->post('office_id'),
          'region' => $this->input->post('region'),
          'district' => $this->input->post('district')
        );
        $cr=array(
          'office_id' => $this->input->post('office_id'),
          'project_id' => $this->input->post('project_id'),
          'fundsource_type' => $this->input->post('fundsource_type')
        );

        $this->ProjectModel->update_proj($ip,$op,$cr);
        $this->session->set_flashdata('editProjSuccess',1);
        redirect('users/Projects');
      }
    }
    else
      redirect('home','refresh');
  }

  function createProject()
  {
   $title['browserTitle']='Government Projects';
   $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/createProject');
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
      $title['browserTitle']='Government Projects';
      $this->form_validation->set_rules('region','region', 'required');
      $this->form_validation->set_rules('district','district', 'required');
      $this->form_validation->set_rules('location_name','location', 'required');
      $this->form_validation->set_rules('description','description', 'required');
      $this->form_validation->set_rules('cost','cost', 'numeric|required');
      $this->form_validation->set_rules('fundsource_type','fundsource_type', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $this->load->view('includes/head',$title);

        $this->load->view('admin/createProject');
        $this->load->view('includes/foot');
      }
      else{
        $ip=array(
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost')
        );
        $project_id=$this->ProjectModel->create_proj1($ip);

        $op=array(
          'region' => $this->input->post('region'),
          'district' => $this->input->post('district')
        );
        $office_id=$this->ProjectModel->create_proj2($op);


        $cr=array(
          'office_id' => $office_id,
          'project_id' => $project_id,
          'fundsource_type' => $this->input->post('fundsource_type')
        );

        $this->ProjectModel->create_proj3($cr);
        $this->session->set_flashdata('createProjSuccess',1);
        redirect('users/Projects');
      }  
    }
    else
      redirect('home','refresh');
  }

  function deleteProject()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $proj=$this->input->post('proj');
      $data['project_id']=$proj[0];
      $data['office_id']=$proj[1];

      $this->ProjectModel->delete_proj($data);
      $this->session->set_flashdata('deleteProjSuccess',1);

      redirect('users/Projects'); 
    }
    else
      redirect('home','refresh');  
  }
}


?>