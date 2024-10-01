<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SK_Usaha extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}
		$this->load->model('M_SK_Usaha');
		$this->load->model('M_Penduduk');
		$this->load->library('form_validation');
	}

	// Fungsi untuk Petugas
	public function index()
	{
		if ($this->session->userdata('level') === 'admin') {
			redirect('dashboard');
		}
		$data['title'] = 'Daftar Pengajuan Surat Keterangan Usaha';
		$data['permohonan_list'] = $this->M_SK_Usaha->get_all_permohonan();
		$this->load->view('admin/sk_usaha/petugas/index', $data);
	}

	public function tambah()
	{
		if ($this->session->userdata('level') === 'admin') {
			redirect('dashboard');
		}
		$data['title'] = 'Tambah Pengajuan Surat Keterangan Usaha';
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk();

		$this->form_validation->set_rules('id_penduduk', 'Penduduk', 'required');
		$this->form_validation->set_rules('nomor', 'Nomor', 'required');
		$this->form_validation->set_rules('nama_usaha', 'nama_usaha', 'required');
		$this->form_validation->set_rules('tahun_usaha', 'tahun_usaha', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/sk_usaha/petugas/tambah', $data);
		} else {
			$permohonan_data = [
				'id_penduduk' => $this->input->post('id_penduduk'),
				'nomor' => $this->input->post('nomor'),
				'nama_usaha' => $this->input->post('nama_usaha'),
				'tahun_usaha' => $this->input->post('tahun_usaha'),
				'tanggal_permohonan' => date('Y-m-d H:i:s'),
				'status' => 'Menunggu'
			];

			if ($this->M_SK_Usaha->tambah_permohonan($permohonan_data)) {
				$this->session->set_flashdata('success', 'Pengajuan berhasil ditambahkan.');
				redirect('sk_usaha');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
				$this->load->view('admin/sk_usaha/petugas/tambah', $data);
			}
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('level') === 'admin') {
			redirect('dashboard');
		}
		$data['title'] = 'Edit Pengajuan Surat Usaha';
		$data['permohonan'] = $this->M_SK_Usaha->get_permohonan_by_id($id);
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk();

		$this->form_validation->set_rules('id_penduduk', 'Penduduk', 'required');
		$this->form_validation->set_rules('nomor', 'Nomor', 'required');
		$this->form_validation->set_rules('nama_usaha', 'nama_usaha', 'required');
		$this->form_validation->set_rules('tahun_usaha', 'tahun_usaha', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/sk_usaha/petugas/edit', $data);
		} else {
			$permohonan_data = [
				'id_penduduk' => $this->input->post('id_penduduk'),
				'nomor' => $this->input->post('nomor'),
				'nama_usaha' => $this->input->post('nama_usaha'),
				'tahun_usaha' => $this->input->post('tahun_usaha'),
			];

			if ($this->M_SK_Usaha->update_permohonan($id, $permohonan_data)) {
				$this->session->set_flashdata('success', 'Pengajuan berhasil diupdate.');
				redirect('sk_usaha');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
				$this->load->view('admin/sk_usaha/petugas/edit', $data);
			}
		}
	}

	public function hapus($id)
	{
		if ($this->session->userdata('level') === 'admin') {
			redirect('dashboard');
		}
		if ($this->M_SK_Usaha->delete_permohonan($id)) {
			$this->session->set_flashdata('success', 'Pengajuan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
		}
		redirect('sk_usaha');
	}

	public function hapus_admin($id)
	{
		if ($this->session->userdata('level') === 'pegawai') {
			redirect('dashboard');
		}
		if ($this->M_SK_Usaha->delete_permohonan($id)) {
			$this->session->set_flashdata('success', 'Pengajuan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
		}
		redirect('sk_usaha/admin_list');
	}

	// Fungsi untuk Admin
	public function admin_list()
	{
		if ($this->session->userdata('level') === 'pegawai') {
			redirect('dashboard');
		}
		$data['title'] = 'Daftar Permohonan Surat Keterangan Usaha';
		$data['permohonan_list'] = $this->M_SK_Usaha->get_all_permohonan();
		$this->load->view('admin/sk_usaha/admin/index', $data);
	}

	public function acc_permohonan($id)
	{
		if ($this->session->userdata('level') === 'pegawai') {
			redirect('dashboard');
		}
		$data = ['status' => 'Disetujui'];
		$this->M_SK_Usaha->update_permohonan($id, $data);
		$this->session->set_flashdata('success', 'Permohonan berhasil disetujui.');
		redirect('sk_usaha/admin_list');
	}

	public function tolak_permohonan($id)
	{
		if ($this->session->userdata('level') === 'pegawai') {
			redirect('dashboard');
		}
		$data['title'] = 'Alasan Penolakan';
		$data['permohonan'] = $this->M_SK_Usaha->get_permohonan_by_id($id);

		$this->form_validation->set_rules('alasan_penolakan', 'Alasan Penolakan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/sk_usaha/admin/tolak', $data);
		} else {
			$update_data = [
				'status' => 'Ditolak',
				'alasan_penolakan' => $this->input->post('alasan_penolakan')
			];

			if ($this->M_SK_Usaha->update_permohonan($id, $update_data)) {
				$this->session->set_flashdata('success', 'Permohonan berhasil ditolak.');
				redirect('sk_usaha/admin_list');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
				$this->load->view('admin/sk_usaha/admin/tolak', $data);
			}
		}
	}

	public function cetak_surat($id)
	{
		if ($this->session->userdata('level') === 'pegawai') {
			redirect('dashboard');
		}
		$permohonan = $this->M_SK_Usaha->get_permohonan_by_id($id);
		$data['permohonan'] = $permohonan;

		// Tampilkan halaman HTML untuk dicetak
		$this->load->view('admin/sk_usaha/admin/format_sk_usaha', $data);
	}

	public function cancel_permohonan($id)
	{
		if ($this->session->userdata('level') === 'pegawai') {
			redirect('dashboard');
		}
		// Mengubah status permohonan menjadi 'Menunggu'
		$this->M_SK_Usaha->update_status($id, 'Menunggu');

		// Redirect kembali ke halaman daftar permohonan
		redirect('sk_usaha/admin_list');
	}
}
