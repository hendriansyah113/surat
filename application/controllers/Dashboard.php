<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Cek apakah pengguna sudah login
		if (!$this->session->userdata('is_login')) {
			// Jika belum login, arahkan ke halaman login
			redirect('user');
		}
	}

	public function index()
	{
		// Ambil jumlah data dari tabel yang diperlukan
		$jumlah_penduduk = $this->db->count_all('penduduk');
		$jumlah_kartu_keluarga = $this->db->count_all('kartu_keluarga');
		$jumlah_sk_domisili = $this->db->count_all('sk_domisili');
		$jumlah_sk_nikah = $this->db->count_all('sk_nikah');
		$jumlah_sk_penghasilan = $this->db->count_all('sk_penghasilan');
		$jumlah_surat_tugas = $this->db->count_all('permohonan_cetak_surat');
		$jumlah_surat_usaha = $this->db->count_all('sk_usaha');
		$jumlah_tidak_mampu = $this->db->count_all('sk_tidak_mampu');

		// Ambil jumlah data yang disetujui
		$this->db->where('status', 'Disetujui');
		$jumlah_sk_domisili_disetujui = $this->db->count_all_results('sk_domisili');

		$this->db->where('status', 'Disetujui');
		$jumlah_sk_nikah_disetujui = $this->db->count_all_results('sk_nikah');

		$this->db->where('status', 'Disetujui');
		$jumlah_sk_penghasilan_disetujui = $this->db->count_all_results('sk_penghasilan');

		$this->db->where('status', 'Disetujui');
		$jumlah_surat_tugas_disetujui = $this->db->count_all_results('permohonan_cetak_surat');

		$this->db->where('status', 'Disetujui');
		$jumlah_surat_usaha_disetujui = $this->db->count_all_results('sk_usaha');

		$this->db->where('status', 'Disetujui');
		$jumlah_tidak_mampu_disetujui = $this->db->count_all_results('sk_tidak_mampu');

		// Cek apakah ada pengajuan yang memerlukan persetujuan
		// Tabel sk_domisili
		$this->db->where('status', 'Menunggu');
		$ada_pengajuan_domisili = $this->db->count_all_results('sk_domisili') > 0;

		// Tabel permohonan_cetak_surat
		$this->db->where('status', 'Menunggu');
		$ada_pengajuan_tugas = $this->db->count_all_results('permohonan_cetak_surat') > 0;

		// Tabel sk_penghasilan
		$this->db->where('status', 'Menunggu');
		$ada_pengajuan_penghasilan = $this->db->count_all_results('sk_penghasilan') > 0;

		// Tabel sk_tidak_mampu
		$this->db->where('status', 'Menunggu');
		$ada_pengajuan_tidak_mampu = $this->db->count_all_results('sk_tidak_mampu') > 0;

		// Tabel sk_usaha
		$this->db->where('status', 'Menunggu');
		$ada_pengajuan_usaha = $this->db->count_all_results('sk_usaha') > 0;

		// Tabel sk_nikah
		$this->db->where('status', 'Menunggu');
		$ada_pengajuan_nikah = $this->db->count_all_results('sk_nikah') > 0;

		$data = [
			'title' => 'Dashboard',
			'username' => $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row(),
			'jumlah_penduduk' => $jumlah_penduduk,
			'jumlah_sk_domisili' => $jumlah_sk_domisili,
			'jumlah_sk_nikah' => $jumlah_sk_nikah,
			'jumlah_sk_penghasilan' => $jumlah_sk_penghasilan,
			'kartu_keluarga' => $jumlah_kartu_keluarga,
			'surat_tugas' => $jumlah_surat_tugas,
			'surat_usaha' => $jumlah_surat_usaha,
			'tidak_mampu' => $jumlah_tidak_mampu,
			'sk_domisili_disetujui' => $jumlah_sk_domisili_disetujui,
			'sk_nikah_disetujui' => $jumlah_sk_nikah_disetujui,
			'sk_penghasilan_disetujui' => $jumlah_sk_penghasilan_disetujui,
			'surat_tugas_disetujui' => $jumlah_surat_tugas_disetujui,
			'surat_usaha_disetujui' => $jumlah_surat_usaha_disetujui,
			'tidak_mampu_disetujui' => $jumlah_tidak_mampu_disetujui,
			'ada_pengajuan_domisili' => $ada_pengajuan_domisili,
			'ada_pengajuan_tugas' => $ada_pengajuan_tugas,
			'ada_pengajuan_penghasilan' => $ada_pengajuan_penghasilan,
			'ada_pengajuan_tidak_mampu' => $ada_pengajuan_tidak_mampu,
			'ada_pengajuan_usaha' => $ada_pengajuan_usaha,
			'ada_pengajuan_nikah' => $ada_pengajuan_nikah,
		];

		$this->load->view('admin/dashboard/index.php', $data);
	}
}
