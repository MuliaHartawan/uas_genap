<?php

/**
 * kelas ini digunakan untuk model autentikasi...
 */
class Autentikasi_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_autentikasi($username, $password)
	{
		$result = array();

		//siapkan query builder
		$this->db->select('
			autentikasi.id_autentikasi,
			autentikasi.username');
		$this->db->from('autentikasi');
		// $this->db->join('anggota', 'anggota.id_anggota = autentikasi.id_anggota');
		$this->db->where('autentikasi.username', $username);
		$this->db->where('autentikasi.password', $password);

		//eksekusi query
		$query = $this->db->get();

		//cek hasil query
		if ($query->num_rows() > 0) {
			$result['valid_user'] = true;
			$result['data_user'] = $query->row();
		}
		else {
			$result['valid_user'] = false;
			$result['data_user'] = array();
		}

		return $result;
	}
	
	// public function daftar_akun($id_anggota, $username, $password)
	// {
	// 	$this->id_anggota = $id_anggota;
	// 	$this->username = $username;
	// 	$this->password = $password;

	// 	$this->db->insert('autentikasi', $this);
	// }
}