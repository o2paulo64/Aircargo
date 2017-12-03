<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Constructs extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
    $this->load->model('ConstructModel','',TRUE);
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
      $search_count= $this->ConstructModel->search_gov_proj_count($searchString);
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

    if($orderBy=='location_name'){
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
    elseif ($orderBy=='contractor_name'){
      $sort='contractor_name';
      $order='desc';
    }
    elseif ($orderBy=='actual_start'){
      $sort='actual_start';
      $order='desc';
    }
    elseif ($orderBy=='actual_completion'){
      $sort='actual_completion';
      $order='desc';
    }
    else if($orderBy=='location_name_ascending'){
      $sort='location_name';
      $order='asc';
    }
    elseif ($orderBy=='description_ascending'){
      $sort='description';
      $order='asc';
    }
    elseif ($orderBy=='cost_ascending'){
      $sort='cost';
      $order='asc';
    }
    elseif ($orderBy=='contractor_name_ascending'){
      $sort='contractor_name';
      $order='asc';
    }
    elseif ($orderBy=='actual_start_ascending'){
      $sort='actual_start';
      $order='asc';
    }
    elseif ($orderBy=='actual_completion_ascending'){
      $sort='actual_completion';
      $order='asc';
    }
    else{
      $sort='default';
      $order='asc';
      $orderBy='default';
    }

    //*************************************PAGINATION***********************************//
    if($data['searchExist']){
      $data['gov_proj']=$this->ConstructModel->search_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order,$searchString);
      $config['total_rows'] = $this->ConstructModel->search_gov_proj_count($searchString);
      $data['total_rows'] = $config['total_rows'];
      $data['searchResult']=$data['total_rows'].' result/s for keyword: '.$searchString.'';
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Constructs/index';
      $config['first_url']= base_url().'users/Constructs/index?sortBy='.$orderBy.'&search='.$searchString.'';
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&search='.$searchString.'';
    }
    else{
      $data['gov_proj']=$this->ConstructModel->get_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order);
      $config['total_rows'] = $this->ConstructModel->get_gov_proj_count();
      $data['total_rows'] = $config['total_rows'];

      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Constructs/index';
      $config['first_url']= base_url().'users/Constructs/index?sortBy='.$orderBy.'';
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

    $title['browserTitle']='Government Constructs';
    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('users/Constructs',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('users/Constructs',$data);
    }

    $this->load->view('includes/foot');
  }

  function editConstruct()
  {
    $proj=$this->input->post('proj');
    $data['project_id']=$proj[0];
    $data['contractor_id']=$proj[1];
    $data['location_name']=$proj[2];
    $data['description']=$proj[3];
    $data['cost']=$proj[4];
    $data['contractor_name']=$proj[5];
    $data['actual_start']=$proj[6];
    $data['actual_completion']=$proj[7];

    $title['browserTitle']='Government Constructs';

    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/editConstruct',$data);
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
      $title['browserTitle']='Government Constructs';
      $this->form_validation->set_rules('location_name','location name', 'required');
      $this->form_validation->set_rules('description','description', 'required');
      $this->form_validation->set_rules('cost','cost', 'numeric|required');
      $this->form_validation->set_rules('contractor_name','contractor_name', 'required');
      $this->form_validation->set_rules('actual_start','actual_start', 'required');
      $this->form_validation->set_rules('actual_completion','actual_completion', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $data = array(
        'project_id' => $this->input->post('project_id'),
        'contractor_id' => $this->input->post('contractor_id'),
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost'),
        'contractor_name' => $this->input->post('contractor_name'),
        'actual_start' => $this->input->post('actual_start'),
        'actual_completion' => $this->input->post('actual_completion')
        );

        $this->load->view('includes/head',$title);

        $this->load->view('admin/editConstruct',$data);
        $this->load->view('includes/foot');
      }
      else{
        $ip=array( //infra proj
        'project_id' => $this->input->post('project_id'),
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost')
        );
        $op=array(
          'contractor_id' => $this->input->post('contractor_id'),
          'contractor_name' => $this->input->post('contractor_name')
        );
        $cr=array(
          'contractor_id' => $this->input->post('contractor_id'),
          'project_id' => $this->input->post('project_id'),
          'actual_start' => $this->input->post('actual_start'),
          'actual_completion' => $this->input->post('actual_completion')
        );

        $this->ConstructModel->update_proj($ip,$op,$cr);
        $this->session->set_flashdata('editProjSuccess',1);
        redirect('users/Constructs');
      }
    }
    else
      redirect('home','refresh');
  }

  function createConstruct()
  {
   $title['browserTitle']='Government Constructs';
   $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/createConstruct');
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
      $title['browserTitle']='Government Constructs';
      $this->form_validation->set_rules('location_name','location name', 'required');
      $this->form_validation->set_rules('description','description', 'required');
      $this->form_validation->set_rules('cost','cost', 'numeric|required');
      $this->form_validation->set_rules('contractor_name','contractor_name', 'required');
      $this->form_validation->set_rules('actual_start','actual_start', 'numeric|required');
      $this->form_validation->set_rules('actual_completion','actual_completion', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $this->load->view('includes/head',$title);

        $this->load->view('admin/createConstruct');
        $this->load->view('includes/foot');
      }
      else{
        $ip=array( //infra proj
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost')
        );
        $project_id=$this->ConstructModel->create_proj1($ip);

        $op=array( //contractor
          'contractor_name' => $this->input->post('contractor_name')
        );
        $contractor_id=$this->ConstructModel->create_proj2($op);


        $cr=array(
          'contractor_id' => $contractor_id,
          'project_id' => $project_id,
          'actual_start' => $this->input->post('actual_start'),
          'actual_completion' => $this->input->post('actual_completion')
        );

        $this->ConstructModel->create_proj3($cr);
        $this->session->set_flashdata('createProjSuccess',1);
        redirect('users/Constructs');
      }  
    }
    else
      redirect('home','refresh');
  }

  function deleteConstruct()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $proj=$this->input->post('proj');
      $data['project_id']=$proj[0];
      $data['contractor_id']=$proj[1];

      $this->ConstructModel->delete_proj($data);
      $this->session->set_flashdata('deleteProjSuccess',1);

      redirect('users/Constructs'); 
    }
    else
      redirect('home','refresh');  
  }
}


?>