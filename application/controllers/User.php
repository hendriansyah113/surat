<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_User');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function authenticate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->M_User->login($username, $password);

		if ($user) {
			$this->session->set_userdata('id', $user->id);
			$this->session->set_userdata('username', $user->username);
			$this->session->set_userdata('level', $user->level);
			$this->session->set_userdata('is_login', TRUE);
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', 'Username atau Password Salah!!.');
			redirect('user');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user');
	}
}
