<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}

		$this->load->model('M_Admin');
		$this->load->library('session');

		// Check if user is logged in and is an admin
		if ($this->session->userdata('level') !== 'capil') {
			redirect('dashboard');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Daftar Akun',
			'data_users' => $this->M_Admin->get_users()
		];
		$this->load->view('admin/admin/index', $data);
	}

	// Method untuk menampilkan form tambah penduduk dan menyimpan data
	public function tambah()
	{
		// Judul halaman
		$data['title'] = 'Tambah Akun';

		// Aturan validasi input
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$password = md5($this->input->post('password'));

		// Cek apakah validasi berhasil
		if ($this->form_validation->run()) {
			$this->load->library('upload', $config);
			$users_data = array(
				'username' => $this->input->post('username'),
				'password' => $password,
				'level' => $this->input->post('level'),
			);

			// Simpan data ke database
			$this->M_Admin->insert_user($users_data);

			// Set pesan sukses dan redirect ke halaman daftar penduduk
			$this->session->set_flashdata('success', 'Akun berhasil disimpan.');
			return redirect('admin');
		}

		// Jika validasi gagal atau pertama kali masuk, tampilkan form
		$this->load->view('admin/admin/tambah_admin', $data);
	}

	public function edit($id)
	{
		// Judul halaman
		$data['title'] = 'Edit Akun';

		// Ambil data penduduk dari database berdasarkan ID
		$data['user'] = $this->M_Admin->get_user_by_id($id);

		// Cek apakah data penduduk ditemukan
		if (empty($data['user'])) {
			show_404(); // Jika tidak ditemukan, tampilkan halaman 404
		}

		// Aturan validasi input
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$password = md5($this->input->post('password'));

		// Cek apakah form dikirimkan
		if ($this->form_validation->run()) {
			// Ambil data input dari form
			$user_data = array(
				'username' => $this->input->post('username'),
				'password' => $password,
				'level' => $this->input->post('level')
			);

			// Update data penduduk di database
			$this->M_Admin->update_user($id, $user_data);

			// Set pesan sukses dan redirect ke halaman daftar penduduk
			$this->session->set_flashdata('success', 'Data Akun berhasil diperbarui.');
			return redirect('admin');
		}

		// Tampilkan form edit dengan data penduduk yang ada
		$this->load->view('admin/admin/edit-akun', $data);
	}

	public function hapus($id)
	{
		if (!isset($id)) redirect('penduduk');

		if ($this->M_Admin->delete($id)) {
			$this->session->set_flashdata('success', 'Data Akun Berhasil Dihapus');
			redirect(site_url('admin'));
		}
	}
}
