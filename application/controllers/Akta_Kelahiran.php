<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akta_Kelahiran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}

		$this->load->model('M_Akta_Kelahiran');
		$this->load->model('M_Penduduk');
	}

	public function index()
	{
		$data = [
			'username' => $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row(),
			'title' => 'Daftar Akta Kelahiran',
			'data_akta_kelahiran' => $this->M_Akta_Kelahiran->get_all_akta()
		];
		$this->load->view('admin/akta_kelahiran/index', $data);
	}

	// Method untuk menampilkan form tambah kartu keluarga dan menyimpan data
	public function tambah()
	{
		// Judul halaman
		$data['title'] = 'Tambah Akta Kelahiran';
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk();

		// Aturan validasi input
		$this->form_validation->set_rules('id_penduduk', 'Nama Penduduk', 'required|is_unique[akta_kelahiran.id_penduduk]');
		$this->form_validation->set_rules('no_akta', 'No. Akta Kelahiran', 'required|numeric');

		// Cek apakah validasi berhasil
		if ($this->form_validation->run()) {
			// Konfigurasi untuk upload file
			$config['upload_path'] = './uploads/akta/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['max_size'] = 2048; // 2MB
			$config['file_name'] = 'akta_' . time();

			// Load library upload dengan konfigurasi
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file_akta')) {
				// Jika upload berhasil
				$upload_data = $this->upload->data();
				$file_name = $upload_data['file_name'];

				// Data untuk disimpan ke database
				$akta_data = array(
					'id_penduduk' => $this->input->post('id_penduduk'),
					'no_akta' => $this->input->post('no_akta'),
					'file_akta' => $file_name,
				);

				// Simpan data ke database
				$this->M_Akta_Kelahiran->insert_akta($akta_data);

				// Set pesan sukses dan redirect ke halaman daftar akta
				$this->session->set_flashdata('success', 'Data Akta Kelahiran berhasil disimpan.');
				redirect('akta_kelahiran');
			} else {
				// Jika upload gagal, tangkap error
				$data['error'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
			}
		} else {
			$data['error'] = validation_errors('<p class="text-danger">', '</p>');
		}

		// Tampilkan form dengan data error jika ada
		$this->load->view('admin/akta_kelahiran/tambah_akta', $data);
	}

	public function edit($id_akta)
	{
		// Judul halaman
		$data['title'] = 'Edit Akta Kelahiran';
		$data['penduduk_list'] = $this->M_Penduduk->get_all_penduduk(); // Pastikan ada model untuk penduduk

		// Ambil data kartu keluarga berdasarkan ID
		$data['akta'] = $this->M_Akta_Kelahiran->get_akta_by_id($id_akta);

		// Periksa apakah data ditemukan
		if (!$data['akta']) {
			// Jika tidak ditemukan, beri pesan kesalahan
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			return redirect('akta_kelahiran');
		}

		// Aturan validasi input
		$this->form_validation->set_rules('id_penduduk', 'Nama Penduduk', 'required');
		$this->form_validation->set_rules('no_akta', 'No. Akta Kelahiran', 'required|numeric');

		// Cek apakah validasi berhasil
		if ($this->form_validation->run()) {
			$akta_data = array(
				'id_penduduk' => $this->input->post('id_penduduk'),
				'no_akta' => $this->input->post('no_akta')
			);

			// Upload file jika ada file baru yang diunggah
			if (!empty($_FILES['file_akta']['name'])) {
				$config['upload_path'] = './uploads/akta/';
				$config['allowed_types'] = 'pdf|jpg|jpeg|png';
				$config['max_size'] = 2048;
				$config['file_name'] = 'Akta_' . time();

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_akta')) {
					$upload_data = $this->upload->data();
					$akta_data['file_akta'] = $upload_data['file_name'];
				} else {
					$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
					return redirect('akta_kelahiran/edit/' . $id_akta);
				}
			}

			// Simpan perubahan ke database
			$this->M_Akta_Kelahiran->update_akta($id_akta, $akta_data);

			// Set pesan sukses dan redirect ke halaman daftar akta
			$this->session->set_flashdata('success', 'Data Akta Kelahiran berhasil diperbarui.');
			return redirect('akta_kelahiran');
		} else {
		}

		// Jika validasi gagal atau pertama kali masuk, tampilkan form
		$this->load->view('admin/akta_kelahiran/edit-akta', $data);
	}


	public function hapus($id_akta)
	{
		if (!isset($id_akta)) redirect('Akta_kelahiran');

		if ($this->M_Akta_Kelahiran->delete($id_akta)) {
			$this->session->set_flashdata('success', 'Data Akta Kelahiran Berhasil Dihapus');
			redirect(site_url('akta_kelahiran'));
		}
	}
}