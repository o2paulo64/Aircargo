<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel','',TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in')) redirect('home', 'refresh');
		else{
			$data['browserTitle']='Login as Admin';
			$this->load->helper(array('form'));
			$this->load->view('includes/headUser',$data);
			$this->load->view('login');
			$this->load->view('includes/foot');
		}
	}

	public function verifyLogin()
	{

		$this->load->library('form_validation');
		$data['browserTitle']='Login as Admin';
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|callback_checkDatabase');

		if($this->form_validation->run() == FALSE)
		{

			$this->load->view('includes/headUser',$data);
			$this->load->view('login');
			$this->load->view('includes/foot');
		}
		else
		{
		 	redirect('home', 'refresh');
		}

	}
	 
	function checkDatabase($password)
	{
		$username = $this->input->post('username');

		$result = $this->LoginModel->login($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
				'userid' => $row->id,
				'username' => $row->username,
				'authority' => $row->authority
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('checkDatabase', 'Invalid username or password');
			return FALSE;
		}
	}

	function logout()
	{
		$this->load->helper(array('form'));
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$data['userid'] = $session_data['userid'];

		session_destroy();
		$this->session->unset_userdata('logged_in');
		redirect('home');
	}
}
?>