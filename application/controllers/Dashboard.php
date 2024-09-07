<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'username' => $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row(),
		];
		$this->load->view('admin/dashboard/index.php', $data);
	}
}
