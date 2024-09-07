<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$query = $this->db->get('users');

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return FALSE; // Invalid credentials
		}
	}

	public function get_user($user_id)
	{
		$this->db->where('id', $user_id);
		$query = $this->db->get('users');
		return $query->row();
	}
}
