<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cargoes extends CI_Controller 
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->helper('url');
    $this->load->model('CargoModel','',TRUE);
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
      $search_count= $this->CargoModel->search_gov_proj_count($searchString);
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

    if($orderBy=='type_of_objects'){
      $sort='type_of_objects';
      $order='desc';
    }
    elseif ($orderBy=='no_objects'){
      $sort='no_objects';
      $order='desc';
    }
    elseif ($orderBy=='overall_cost'){
      $sort='overall_cost';
      $order='desc';
    }
    elseif ($orderBy=='type'){
      $sort='type';
      $order='desc';
    }
    elseif ($orderBy=='operation_name'){
      $sort='operation_name';
      $order='desc';
    }
    elseif ($orderBy=='airport_name'){
      $sort='airport_name';
      $order='desc';
    }
    elseif ($orderBy=='rnum'){
      $sort='rnum';
      $order='desc';
    }
    elseif ($orderBy=='location_name'){
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
    elseif ($orderBy=='shipping_date'){
      $sort='shipping_date';
      $order='desc';
    }
    else if($orderBy=='type_of_objects_ascending'){
      $sort='type_of_objects';
      $order='asc';
    }
    elseif ($orderBy=='no_objects_ascending'){
      $sort='no_objects';
      $order='asc';
    }
    elseif ($orderBy=='overall_cost_ascending'){
      $sort='overall_cost';
      $order='asc';
    }
    elseif ($orderBy=='type_ascending'){
      $sort='type';
      $order='asc';
    }
    elseif ($orderBy=='operation_name_ascending'){
      $sort='operation_name';
      $order='asc';
    }
    elseif ($orderBy=='airport_name_ascending'){
      $sort='airport_name';
      $order='asc';
    }
    elseif ($orderBy=='rnum_ascending'){
      $sort='rnum';
      $order='asc';
    }
    elseif ($orderBy=='location_name_ascending'){
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
    elseif ($orderBy=='shipping_date_ascending'){
      $sort='shipping_date';
      $order='asc';
    }
    else{
      $sort='default';
      $order='asc';
      $orderBy='default';
    }

    //*************************************PAGINATION***********************************//
    if($data['searchExist']){
      $data['gov_proj']=$this->CargoModel->search_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order,$searchString);
      $config['total_rows'] = $this->CargoModel->search_gov_proj_count($searchString);
      $data['total_rows'] = $config['total_rows'];
      $data['searchResult']=$data['total_rows'].' result/s for keyword: '.$searchString.'';
      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Cargoes/index';
      $config['first_url']= base_url().'users/Cargoes/index?sortBy='.$orderBy.'&search='.$searchString.'';
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['suffix'] = '?sortBy='.$orderBy.'&search='.$searchString.'';
    }
    else{
      $data['gov_proj']=$this->CargoModel->get_gov_proj($limit_per_page,($start_index-1)*10,$sort,$order);
      $config['total_rows'] = $this->CargoModel->get_gov_proj_count();
      $data['total_rows'] = $config['total_rows'];

      $data['sort']=$orderBy;
      $config['base_url'] = base_url().'users/Cargoes/index';
      $config['first_url']= base_url().'users/Cargoes/index?sortBy='.$orderBy.'';
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

    $title['browserTitle']='Government Cargoes';
    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('users/Cargoes',$data);
    }
    else{
      $this->load->view('includes/headUser',$title);
      $this->load->view('users/Cargoes',$data);
    }

    $this->load->view('includes/foot');
  }

  function editCargo()
  {
    $proj=$this->input->post('proj');
    $data['report_id']=$proj[0];
    $data['project_id']=$proj[1];
    $data['operator_id']=$proj[2];
    $data['airport_id']=$proj[3];
    $data['cargo_id']=$proj[4];
    $data['aircraft_registration']=$proj[5];
    $data['type_of_objects']=$proj[6];
    $data['no_objects']=$proj[7];
    $data['overall_cost']=$proj[8];
    $data['type']=$proj[9];
    $data['operation_name']=$proj[10];
    $data['airport_name']=$proj[11];
    $data['rnum']=$proj[12];
    $data['location_name']=$proj[13];
    $data['description']=$proj[14];
    $data['cost']=$proj[15];
    $data['shipping_date']=$proj[16];

    $title['browserTitle']='Government Cargoes';

    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/editCargo',$data);
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
      $title['browserTitle']='Government Cargoes';
      $this->form_validation->set_rules('type_of_objects','Type of Object', 'required');
      $this->form_validation->set_rules('no_objects','# of Objects', 'numeric|required');
      $this->form_validation->set_rules('overall_cost','Overall Cost', 'numeric|required');
      $this->form_validation->set_rules('type','type', 'required');
      $this->form_validation->set_rules('operation_name','operation name', 'required');
      $this->form_validation->set_rules('airport_name','airport name', 'required');
      $this->form_validation->set_rules('rnum','rnum', 'required');
      $this->form_validation->set_rules('location_name','location name', 'required');
      $this->form_validation->set_rules('description','description', 'required');
      $this->form_validation->set_rules('cost','cost', 'numeric|required');
      $this->form_validation->set_rules('shipping_date','shipping date', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $data = array(
        'report_id' => $this->input->post('report_id'),
        'project_id' => $this->input->post('project_id'),
        'operator_id' => $this->input->post('operator_id'),
        'airport_id' => $this->input->post('airport_id'),
        'cargo_id' => $this->input->post('cargo_id'),
        'aircraft_registration' => $this->input->post('aircraft_registration'),
        'type_of_objects' => $this->input->post('type_of_objects'),
        'no_objects' => $this->input->post('no_objects'),
        'overall_cost' => $this->input->post('overall_cost'),
        'type' => $this->input->post('type'),
        'operation_name' => $this->input->post('operation_name'),
        'airport_name' => $this->input->post('airport_name'),
        'rnum' => $this->input->post('rnum'),
        'location_name' => $this->input->post('location_name'),
        'description' => $this->input->post('description'),
        'cost' => $this->input->post('cost'),
        'shipping_date' => $this->input->post('shipping_date')
        );

        $this->load->view('includes/head',$title);

        $this->load->view('admin/editCargo',$data);
        $this->load->view('includes/foot');
      }
      else{
        $ip=array( //airport
        'airport_id' => $this->input->post('airport_id'),
        'airport_name' => $this->input->post('airport_name'),
        'rnum' => $this->input->post('rnum')
        );
        $op=array( //Airlineoperation
          'operator_id' => $this->input->post('operator_id'),
          'operation_name' => $this->input->post('operation_name')
        );
        $cr=array( //aircraft
          'aircraft_registration' => $this->input->post('aircraft_registration'),
          'type' => $this->input->post('type')
        );
        $carg=array( //cargo
          'cargo_id' => $this->input->post('cargo_id'),
          'type_of_objects' => $this->input->post('type_of_objects'),
          'overall_cost' => $this->input->post('overall_cost'),
          'no_objects' => $this->input->post('no_objects')
        );
        $infra=array( //aircraft
          'project_id' => $this->input->post('project_id'),
          'location_name' => $this->input->post('location_name'),
          'description' => $this->input->post('description'),
          'cost' => $this->input->post('cost')
        );

        $trans=array( //aircraft
          'report_id' => $this->input->post('report_id'),
          'project_id' => $this->input->post('project_id'),
          'shipping_date' => $this->input->post('shipping_date')
        );
        $this->CargoModel->update_proj($ip,$op,$cr,$carg,$infra,$trans);
        $this->session->set_flashdata('editProjSuccess',1);
        redirect('users/Cargoes');
      }
    }
    else
      redirect('home','refresh');
  }

  function createCargo()
  {
   $title['browserTitle']='Government Cargoes';
   $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $this->load->view('includes/head',$title);
      $this->load->view('admin/createCargo');
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
      $title['browserTitle']='Government Cargoes';
      $this->form_validation->set_rules('type_of_objects','Type of Object', 'required');
      $this->form_validation->set_rules('no_objects','# of Objects', 'numeric|required');
      $this->form_validation->set_rules('overall_cost','Overall Cost', 'numeric|required');
      $this->form_validation->set_rules('type','type', 'required');
      $this->form_validation->set_rules('operation_name','operation name', 'required');
      $this->form_validation->set_rules('airport_name','airport name', 'required');
      $this->form_validation->set_rules('rnum','rnum', 'required');
      $this->form_validation->set_rules('location_name','location name', 'required');
      $this->form_validation->set_rules('description','description', 'required');
      $this->form_validation->set_rules('cost','cost', 'numeric|required');
      $this->form_validation->set_rules('shipping_date','shipping date', 'required');

      if($this->form_validation->run() == FALSE)
      {
        $this->load->view('includes/head',$title);

        $this->load->view('admin/createCargo');
        $this->load->view('includes/foot');
      }
      else{
        $ip=array( //airport
        'airport_name' => $this->input->post('airport_name')
        );
        $airport_id=$this->CargoModel->create_proj1($ip);

        $op=array( //aircraft
          'aircraft_registration' => $this->input->post('aircraft_registration'),
          'type' => $this->input->post('type')
        );
        $aircraft_registration= $this->CargoModel->create_proj2($op);

        $cr=array( //airlineoperation
          'operation_name' => $this->input->post('operation_name')
        );
        $operator_id=$this->CargoModel->create_proj3($cr);

        $carg=array(  //cargo
          'type_of_objects' => $this->input->post('type_of_objects'),
          'overall_cost' => $this->input->post('overall_cost'),
          'no_objects' => $this->input->post('no_objects')
        );
        $cargo_id=$this->CargoModel->create_proj4($carg);

        $infra=array(  //infra
          'location_name' => $this->input->post('location_name'),
          'description' => $this->input->post('description'),
          'cost' => $this->input->post('cost')
        );
        $project_id=$this->CargoModel->create_proj5($infra);

        $r=array(
          'operator_id'=> $operator_id,
          'airport_id'=> $airport_id,
          'aircraft_registration'=> $aircraft_registration,
          'cargo_id'=> $cargo_id
        );
        $report_id=$this->CargoModel->create_proj6($r);

        $trans=array(
          'report_id'=> $report_id,
          'project_id'=> $project_id,
          'shipping_date'=> $this->input->post('shipping_date')
        );
        $this->CargoModel->create_proj7($trans);

        $this->session->set_flashdata('createProjSuccess',1);
        redirect('users/Cargoes');
      }  
    }
    else
      redirect('home','refresh');
  }

  function deleteCargo()
  {
    $sessionData = $this->session->userdata('logged_in');
    if($sessionData)
      $authority=$sessionData['authority'];
    else
      $authority=0; 

    if($authority==1){
      $proj=$this->input->post('proj');
      $data['report_id']=$proj[0];
      $data['project_id']=$proj[1];
      $data['operator_id']=$proj[2];
      $data['airport_id']=$proj[3];
      $data['cargo_id']=$proj[4];
      $data['aircraft_registration']=$proj[5];

      $this->CargoModel->delete_proj($data);
      $this->session->set_flashdata('deleteProjSuccess',1);

      redirect('users/Cargoes'); 
    }
    else
      redirect('home','refresh');  
  }
}


?>