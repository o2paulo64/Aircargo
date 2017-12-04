<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
    $this->load->model('ReportModel','',TRUE);
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
      'operation_name' => $getAdvanceSearch[0],
      'airport_name' => $getAdvanceSearch[1],
      'type' => $getAdvanceSearch[2],
      'classification' => $getAdvanceSearch[3],
      'description' => $getAdvanceSearch[4]
    );

    $data['advanceSearchExist']=0;
    $data['searchExist']=0;
    $data['searchResult']='';

    if($search['operation_name'] or $search['airport_name'] or $search['type'] or $search['classification'] or $search['description']) {
      $search_count= $this->ReportModel->advance_search_count($search);
      if($search_count==0){
        $data['advanceSearchExist']=0;
        $data['searchResult']='No results';
      }
      else {
        $data['advanceSearchExist']=1;
      }
    }
    else if($searchString) {
      $search_count= $this->ReportModel->search_gov_proj_count($searchString);
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
    
    if ($orderBy=='operation_name'){
      $sort='operation_name';
      $order='desc';
    }
    elseif ($orderBy=='airport_name'){
      $sort='airport_name';
      $order='desc';
    }
    elseif ($orderBy=='aircraft_type'){
      $sort='type';
      $order='desc';
    }
    elseif ($orderBy=='classification'){
      $sort='classification';
      $order='desc';
    }
    elseif ($orderBy=='description'){
      $sort='description';
      $order='desc';
    }
    elseif ($orderBy=='operation_name_ascending'){
      $sort='operation_name';
      $order='asc';
    }
    elseif ($orderBy=='airport_name_ascending'){
      $sort='airport_name';
      $order='asc';
    }
    elseif ($orderBy=='aircraft_type_ascending'){
      $sort='type';
      $order='asc';
    }
    elseif ($orderBy=='classification_ascending'){
      $sort='classification';
      $order='asc';
    }
    elseif ($orderBy=='description_ascending'){
      $sort='description';
      $order='asc';
    }
    else{
      $sort='default';
      $order='asc';
      $orderBy='default';
    }

    //*************************************PAGINATION***********************************//
    if($data['advanceSearchExist']){
      $data['gov_proj']=$this->ReportModel->advance_search($limit_per_page,($start_index-1)*10,$sort,$order,$search);
      $data['searchResult']=$this->ReportModel->advance_search_count($search).' result/s.';
      $config['total_rows'] = $this->ReportModel->advance_search_count($search);
      $data['total_rows'] = $config['total_rows'];
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Reports/index';
      $config['first_url']= base_url().'users/Reports/index?sortBy='.$orderBy.'&asearch%5B%5D='.$search['operation_name'].'&asearch%5B%5D='.$search['airport_name'].'&asearch%5B%5D='.$search['type'].'&asearch%5B%5D='.$search['classification'].'&asearch%5B%5D='.$search['description'].'';
      $data['search']=$search;
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&asearch%5B%5D='.$search['operation_name'].'&asearch%5B%5D='.$search['airport_name'].'&asearch%5B%5D='.$search['type'].'&asearch%5B%5D='.$search['classification'].'&asearch%5B%5D='.$search['description'].'';
    }
    else if($data['searchExist']){
      $data['gov_proj']=$this->ReportModel->search_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order,$searchString);
      $config['total_rows'] = $this->ReportModel->search_gov_proj_count($searchString);
      $data['total_rows'] = $config['total_rows'];
      $data['searchResult']=$data['total_rows'].' result/s for keyword: '.$searchString.'';
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Reports/index';
      $config['first_url']= base_url().'users/Reports/index?sortBy='.$orderBy.'&search='.$searchString.'';
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&search='.$searchString.'';
    }
    else{
      $data['gov_proj']=$this->ReportModel->get_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order);
      $config['total_rows'] = $this->ReportModel->get_gov_proj_count();
      $data['total_rows'] = $config['total_rows'];

      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Reports/index';
      $config['first_url']= base_url().'users/Reports/index?sortBy='.$orderBy.'';
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

    $title['browserTitle']='Reports';
    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('users/reports',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('users/reports',$data);
    }

    $this->load->view('includes/foot');
  }

  function editReport()
  {
    $proj=$this->input->post('proj');
    $data['report_id']=$proj[0];
    $data['airport_id']=$proj[1];
    $data['operator_id']=$proj[2];
    $data['typeno']=$proj[3];
    $data['operation_name']=$proj[4];
    $data['airport_name']=$proj[5];
    $data['aircraft_registration']=$proj[6];
    $data['classification']=$proj[7];
    $data['description']=$proj[8];
    $data['type']=$proj[9];

    $title['browserTitle']='Reports';

    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/editReport',$data);
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
      $this->form_validation->set_rules('operation_name','Operation name', 'required');
      $this->form_validation->set_rules('airport_name','Airport Name', 'required');
      $this->form_validation->set_rules('type','Aircraft Type', 'required');
      $this->form_validation->set_rules('classification','classification', 'required');
      $this->form_validation->set_rules('description','description', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $data = array(
        'report_id' => $this->input->post('report_id'),
        'airport_id' => $this->input->post('airport_id'),
        'operator_id' => $this->input->post('operator_id'),
        'typeno' => $this->input->post('typeno'),
        'operation_name' => $this->input->post('operation_name'),
        'airport_name' => $this->input->post('airport_name'),
        'aircraft_registration' => $this->input->post('aircraft_registration'),
        'classification' => $this->input->post('classification'),
        'description' => $this->input->post('description'),
        'type' => $this->input->post('type')
        );

        $this->load->view('includes/head',$title);

        $this->load->view('admin/editReport',$data);
        $this->load->view('includes/foot');
      }
      else{
        $ip=array(
          'airport_id' => $this->input->post('airport_id'),
          'airport_name' => $this->input->post('airport_name')
        );
        $op=array(
          'aircraft_registration' => $this->input->post('aircraft_registration'),
          'type' => $this->input->post('type')
        );
        $cr=array(
          'operator_id' => $this->input->post('operator_id'),
          'operation_name' => $this->input->post('operation_name')
        );

        $t=array(
          'typeno' => $this->input->post('typeno'),
          'classification' => $this->input->post('classification'),
          'description' => $this->input->post('description')
        );

        $this->ReportModel->update_proj($ip,$op,$cr,$t);
        $this->session->set_flashdata('editProjSuccess',1);
        redirect('users/Reports');
      }
    }
    else
      redirect('home','refresh');
  }

  function createReport()
  {
   $title['browserTitle']='Government Projects';
   $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/createReport');
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
      $this->form_validation->set_rules('operation_name','Operation name', 'required');
      $this->form_validation->set_rules('airport_name','Airport Name', 'required');
      $this->form_validation->set_rules('aircraft_registration','Aircraft Type', 'required');
      $this->form_validation->set_rules('type','Aircraft Type', 'required');
      $this->form_validation->set_rules('classification','classification', 'required');
      $this->form_validation->set_rules('description','description', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $this->load->view('includes/head',$title);

        $this->load->view('admin/createReport');
        $this->load->view('includes/foot');
      }
      else{

    

        /***************************************************/
        $ip=array(
        'airport_name' => $this->input->post('airport_name')
        );
        $airport_id=$this->ReportModel->create_proj1($ip);

        $op=array(
          'aircraft_registration' => $this->input->post('aircraft_registration'),
          'type' => $this->input->post('type')
        );
        $aircraft_registration= $this->ReportModel->create_proj2($op);

        $cr=array(
          'operation_name' => $this->input->post('operation_name')
        );
        $operator_id=$this->ReportModel->create_proj3($cr);

        $t=array(
          'classification' => $this->input->post('classification'),
          'description' => $this->input->post('description')
        );
        $typeno=$this->ReportModel->create_proj4($t);

        $cargo_id=$this->ReportModel->create_cargo();

        $r=array(
          'operator_id'=> $operator_id,
          'airport_id'=> $airport_id,
          'aircraft_registration'=> $aircraft_registration,
          'cargo_id'=> $cargo_id
        );
        $report_id=$this->ReportModel->create_proj5($r);

        $descr=array(
          'report_id'=> $report_id,
          'typeno'=> $typeno
        );
        $this->ReportModel->create_proj6($descr);

        $this->session->set_flashdata('createProjSuccess',1);
        redirect('users/Reports');
      }  
    }
    else
      redirect('home','refresh');
  }

  function deleteReport()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $proj=$this->input->post('proj');
      $data['report_id']=$proj[0];
      $data['airport_id']=$proj[1];
      $data['operator_id']=$proj[2];
      $data['typeno']=$proj[3];
      $data['aircraft_registration']=$proj[4];

      $this->ReportModel->delete_proj($data);
      $this->session->set_flashdata('deleteProjSuccess',1);

      redirect('users/Projects'); 
    }
    else
      redirect('home','refresh');  
  }
}


?>