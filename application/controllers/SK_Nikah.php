<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SK_Nikah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}
		$this->load->model('M_SK_Nikah');
		$this->load->model('M_Penduduk');
		$this->load->library('form_validation');
	}

	// Fungsi untuk Petugas
	public function index()
	{
		$data['title'] = 'Daftar Pengajuan Surat Keterangan nikah';
		$data['permohonan_list'] = $this->M_SK_Nikah->get_all_permohonan();
		$this->load->view('admin/sk_nikah/petugas/index', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Pengajuan Surat Keterangan Nikah';
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk();

		$this->form_validation->set_rules('id_penduduk', 'Penduduk', 'required');
		$this->form_validation->set_rules('nomor', 'Nomor', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/sk_nikah/petugas/tambah', $data);
		} else {
			$permohonan_data = [
				'id_penduduk' => $this->input->post('id_penduduk'),
				'nomor' => $this->input->post('nomor'),
				'tanggal_permohonan' => date('Y-m-d H:i:s'),
				'status' => 'Menunggu'
			];

			if ($this->M_SK_Nikah->tambah_permohonan($permohonan_data)) {
				$this->session->set_flashdata('success', 'Pengajuan berhasil ditambahkan.');
				redirect('sk_nikah');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
				$this->load->view('admin/sk_nikah/petugas/tambah', $data);
			}
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Pengajuan Surat Nikah';
		$data['permohonan'] = $this->M_SK_Nikah->get_permohonan_by_id($id);
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk();

		$this->form_validation->set_rules('id_penduduk', 'Penduduk', 'required');
		$this->form_validation->set_rules('nomor', 'Nomor', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/sk_nikah/petugas/edit', $data);
		} else {
			$permohonan_data = [
				'id_penduduk' => $this->input->post('id_penduduk'),
				'nomor' => $this->input->post('nomor'),
			];

			if ($this->M_SK_Nikah->update_permohonan($id, $permohonan_data)) {
				$this->session->set_flashdata('success', 'Pengajuan berhasil diupdate.');
				redirect('sk_nikah');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
				$this->load->view('admin/sk_nikah/petugas/edit', $data);
			}
		}
	}

	public function hapus($id)
	{
		if ($this->M_SK_Nikah->delete_permohonan($id)) {
			$this->session->set_flashdata('success', 'Pengajuan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
		}
		redirect('sk_nikah');
	}

	public function hapus_admin($id)
	{
		if ($this->M_SK_Nikah->delete_permohonan($id)) {
			$this->session->set_flashdata('success', 'Pengajuan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
		}
		redirect('sk_nikah/admin_list');
	}

	// Fungsi untuk Admin
	public function admin_list()
	{
		$data['title'] = 'Daftar Permohonan Surat Keterangan Usaha';
		$data['permohonan_list'] = $this->M_SK_Nikah->get_all_permohonan();
		$this->load->view('admin/sk_nikah/admin/index', $data);
	}

	public function acc_permohonan($id)
	{
		$data = ['status' => 'Disetujui'];
		$this->M_SK_Nikah->update_permohonan($id, $data);
		$this->session->set_flashdata('success', 'Permohonan berhasil disetujui.');
		redirect('sk_nikah/admin_list');
	}

	public function tolak_permohonan($id)
	{
		$data['title'] = 'Alasan Penolakan';
		$data['permohonan'] = $this->M_SK_Nikah->get_permohonan_by_id($id);

		$this->form_validation->set_rules('alasan_penolakan', 'Alasan Penolakan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/sk_nikah/admin/tolak', $data);
		} else {
			$update_data = [
				'status' => 'Ditolak',
				'alasan_penolakan' => $this->input->post('alasan_penolakan')
			];

			if ($this->M_SK_Nikah->update_permohonan($id, $update_data)) {
				$this->session->set_flashdata('success', 'Permohonan berhasil ditolak.');
				redirect('sk_nikah/admin_list');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan. Coba lagi.');
				$this->load->view('admin/sk_nikah/admin/tolak', $data);
			}
		}
	}

	public function cetak_surat($id)
	{
		$permohonan = $this->M_SK_Nikah->get_permohonan_by_id($id);
		$data['permohonan'] = $permohonan;

		// Tampilkan halaman HTML untuk dicetak
		$this->load->view('admin/sk_nikah/admin/format_sk_nikah', $data);
	}

	public function cancel_permohonan($id)
	{
		// Mengubah status permohonan menjadi 'Menunggu'
		$this->M_SK_Nikah->update_status($id, 'Menunggu');

		// Redirect kembali ke halaman daftar permohonan
		redirect('sk_nikah/admin_list');
	}
}
