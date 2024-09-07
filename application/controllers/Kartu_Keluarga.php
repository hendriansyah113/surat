<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kartu_Keluarga extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}

		$this->load->model('M_Kartu_Keluarga');
		$this->load->model('M_Penduduk');
	}

	public function index()
	{
		$data = [
			'title' => 'Daftar Kartu Keluarga',
			'data_kartu_keluarga' => $this->M_Kartu_Keluarga->get_all_kk()
		];
		$this->load->view('admin/kartu_keluarga/index', $data);
	}

	// Method untuk menampilkan form tambah kartu keluarga dan menyimpan data
	public function tambah()
	{
		// Judul halaman
		$data['title'] = 'Tambah Kartu Keluarga';
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk();

		// Aturan validasi input
		$this->form_validation->set_rules('id_penduduk', 'Nama Penduduk', 'required');
		$this->form_validation->set_rules('kk', 'No. Kartu Keluarga', 'required|numeric|exact_length[16]');

		// Cek apakah validasi berhasil
		if ($this->form_validation->run()) {
			// Konfigurasi untuk upload file
			$config['upload_path'] = './uploads/kk/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['max_size'] = 2048; // 2MB
			$config['file_name'] = 'kk_' . time();

			// Load library upload dengan konfigurasi
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file_kk')) {
				// Jika upload berhasil
				$upload_data = $this->upload->data();
				$file_name = $upload_data['file_name'];

				// Data untuk disimpan ke database
				$kk_data = array(
					'id_penduduk' => $this->input->post('id_penduduk'),
					'no_kk' => $this->input->post('kk'),
					'file_kk' => $file_name,
				);

				// Simpan data ke database
				$this->M_Kartu_Keluarga->insert_kk($kk_data);

				// Set pesan sukses dan redirect ke halaman daftar kk
				$this->session->set_flashdata('success', 'Data Kartu Keluarga berhasil disimpan.');
				redirect('kartu_keluarga');
			} else {
				// Jika upload gagal, tangkap error
				$data['error'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
			}
		} else {
			$data['error'] = validation_errors('<p class="text-danger">', '</p>');
		}

		// Tampilkan form dengan data error jika ada
		$this->load->view('admin/kartu_keluarga/tambah_kk', $data);
	}

	public function edit($id_kk)
	{
		// Judul halaman
		$data['title'] = 'Edit Kartu Keluarga';
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk(); // Pastikan ada model untuk penduduk

		// Ambil data kartu keluarga berdasarkan ID
		$data['kk'] = $this->M_Kartu_Keluarga->get_kk_by_id($id_kk);

		// Periksa apakah data ditemukan
		if (!$data['kk']) {
			// Jika tidak ditemukan, beri pesan kesalahan
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			return redirect('kartu_keluarga');
		}

		// Aturan validasi input
		$this->form_validation->set_rules('id_penduduk', 'Nama Penduduk', 'required');
		$this->form_validation->set_rules('kk', 'No. Kartu Keluarga', 'required|numeric|exact_length[16]');

		// Cek apakah validasi berhasil
		if ($this->form_validation->run()) {
			$kk_data = array(
				'id_penduduk' => $this->input->post('id_penduduk'),
				'no_kk' => $this->input->post('kk')
			);

			// Upload file jika ada file baru yang diunggah
			if (!empty($_FILES['file_kk']['name'])) {
				$config['upload_path'] = './uploads/kk/';
				$config['allowed_types'] = 'pdf|jpg|jpeg|png';
				$config['max_size'] = 2048;
				$config['file_name'] = 'KK_' . time();

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_kk')) {
					$upload_data = $this->upload->data();
					$kk_data['file_kk'] = $upload_data['file_name'];
				} else {
					$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
					return redirect('kartu_keluarga/edit/' . $id_kk);
				}
			}

			// Simpan perubahan ke database
			$this->M_Kartu_Keluarga->update_kk($id_kk, $kk_data);

			// Set pesan sukses dan redirect ke halaman daftar kk
			$this->session->set_flashdata('success', 'Data Kartu Keluarga berhasil diperbarui.');
			return redirect('kartu_keluarga');
		}

		// Jika validasi gagal atau pertama kali masuk, tampilkan form
		$this->load->view('admin/kartu_keluarga/edit-kk', $data);
	}

	public function hapus($id_kk)
	{
		if (!isset($id_kk)) redirect('kartu_keluarga');

		if ($this->M_Kartu_Keluarga->delete($id_kk)) {
			$this->session->set_flashdata('success', 'Data Kartu Keluarga Berhasil Dihapus');
			redirect(site_url('kartu_keluarga'));
		}
	}
}
