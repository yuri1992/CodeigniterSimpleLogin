<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simplelogin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('login_model');
	}
	private function base_template($templates_to_load) {
		$this->load->view('base_header.php');
		#$this->load->view('dash/menu.php');
		foreach ($templates_to_load as $template_path=>$template_data); {
			$this->load->view($template_path,$template_data);
		}
		$this->load->view('base_footer.php');
	}
	public function index() {
		$this->login();
	}
	public function login() {
		on_success_session();
		$data = array();

		$this->form_validation->set_rules('email', 'Email Adress', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run())
		{
			$data['email'] = $this->input->post('email');
			$data['password_enc'] = sha1($this->input->post('password'));
			if ($this->login_model->is_login_valid($data)) {
				$this->set_session_login($data);
				redirect('/user/panel');
			}
		} 

		$arr = array('customers/login.php'=>$data);
		$this->base_template($arr);
	}
	public function logout() {
		$this->unset_session_login();
		$this->index();
		return "";	
	}
	private function set_session_login($data) {
		$newdata = array(
	        'email'  => $data['email'],
	        'password' => $data['password_enc'],
	        'date' => date('d-m-Y'),
	        'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
	}
	private function unset_session_login() {
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('date');
		$this->session->sess_destroy();
	}

}
