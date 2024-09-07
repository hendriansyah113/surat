<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Surat_Tugas extends CI_Model
{
	public function tambah_permohonan($data)
	{
		return $this->db->insert('permohonan_cetak_surat', $data);
	}

	public function get_all_permohonan()
	{
		$this->db->select('permohonan_cetak_surat.*, penduduk.nama, penduduk.alamat'); // Memilih kolom yang ingin diambil
		$this->db->from('permohonan_cetak_surat');
		$this->db->join('penduduk', 'penduduk.id_penduduk = permohonan_cetak_surat.id_penduduk'); // Melakukan join dengan tabel penduduk
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result(); // Mengembalikan hasil query
	}


	public function get_permohonan_by_id($id)
	{
		$this->db->select('permohonan_cetak_surat.*, penduduk.*');
		$this->db->from('permohonan_cetak_surat');
		$this->db->join('penduduk', 'permohonan_cetak_surat.id_penduduk = penduduk.id_penduduk');
		$this->db->where('permohonan_cetak_surat.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_permohonan($id, $data)
	{
		return $this->db->where('id', $id)->update('permohonan_cetak_surat', $data);
	}

	public function delete_permohonan($id)
	{
		return $this->db->delete('permohonan_cetak_surat', ['id' => $id]);
	}

	public function update_status($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update('permohonan_cetak_surat', ['status' => $status]);
	}
}