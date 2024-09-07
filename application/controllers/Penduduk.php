<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}

		$this->load->model('M_Penduduk');
	}

	public function index()
	{
		$data = [
			'title' => 'Daftar Penduduk',
			'data_penduduk' => $this->M_Penduduk->get_all_penduduk()
		];
		$this->load->view('admin/penduduk/index', $data);
	}

	// Method untuk menampilkan form tambah penduduk dan menyimpan data
	public function tambah()
	{
		// Judul halaman
		$data['title'] = 'Tambah Penduduk';

		// Aturan validasi input
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required|numeric|exact_length[16]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja/Intansi', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('status_nikah', 'Status Nikah', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');

		// Cek apakah validasi berhasil
		if ($this->form_validation->run()) {
			$this->load->library('upload', $config);
			$penduduk_data = array(
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'alamat' => $this->input->post('alamat'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'unit' => $this->input->post('unit'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'status_nikah' => $this->input->post('status_nikah'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
			);

			// Simpan data ke database
			$this->M_Penduduk->insert_penduduk($penduduk_data);

			// Set pesan sukses dan redirect ke halaman daftar penduduk
			$this->session->set_flashdata('success', 'Data penduduk berhasil disimpan.');
			return redirect('penduduk');
		}

		// Jika validasi gagal atau pertama kali masuk, tampilkan form
		$this->load->view('admin/penduduk/tambah_penduduk', $data);
	}

	public function edit($id_penduduk)
	{
		// Judul halaman
		$data['title'] = 'Edit Penduduk';

		// Ambil data penduduk dari database berdasarkan ID
		$data['penduduk'] = $this->M_Penduduk->get_penduduk_by_id($id_penduduk);

		// Cek apakah data penduduk ditemukan
		if (empty($data['penduduk'])) {
			show_404(); // Jika tidak ditemukan, tampilkan halaman 404
		}

		// Aturan validasi input
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required|numeric|exact_length[16]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja/Intansi', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('status_nikah', 'Status Nikah', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');

		// Cek apakah form dikirimkan
		if ($this->form_validation->run()) {
			// Ambil data input dari form
			$penduduk_data = array(
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'alamat' => $this->input->post('alamat'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'unit' => $this->input->post('unit'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'status_nikah' => $this->input->post('status_nikah'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
			);

			// Update data penduduk di database
			$this->M_Penduduk->update_penduduk($id_penduduk, $penduduk_data);

			// Set pesan sukses dan redirect ke halaman daftar penduduk
			$this->session->set_flashdata('success', 'Data penduduk berhasil diperbarui.');
			return redirect('penduduk');
		}

		// Tampilkan form edit dengan data penduduk yang ada
		$this->load->view('admin/penduduk/edit-penduduk', $data);
	}

	public function hapus($id_penduduk)
	{
		if (!isset($id_penduduk)) redirect('penduduk');

		if ($this->M_Penduduk->delete($id_penduduk)) {
			$this->session->set_flashdata('success', 'Data Penduduk Berhasil Dihapus');
			redirect(site_url('penduduk'));
		}
	}
}
