<?php

/**
 * kelas ini digunakan untuk model autentikasi...
 */
class Buku_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function ambil_semua_buku()
	{	

		return $this->db->get('buku')->result();
		
	}


	public function ambil_buku($id)
	{
		return $this->db->get_where('buku', ['id' => $id])->row();
		// select * from buku where id=$id
	}
		
	public function tambah_buku()
	{
		$judul = $this->input->post('judul');
		$pengarang = $this->input->post('pengarang');
		$url_gambar = $this->uploadFile();

		$this->judul = $judul;
		$this->pengarang = $pengarang;
		$this->url_gambar = $url_gambar;

		$this->db->insert('buku', $this);
		
		return $this->db->insert_id();
	}

	public function update_buku($id)
	{
		// ambil inputan
		$judul = $this->input->post('judul');
		$pengarang = $this->input->post('pengarang');
		// $kelas = $this->input->post('kelas'); //content

		$this->judul = $judul;
		$this->pengarang = $pengarang;
		$this->url_gambar = '';

		$this->db->update('buku', $this, ['id' => $id]);

	}

	public function hapus_buku($id)
	{
		$this->db->delete('buku', array('id' => $id ));
	}

	public function uploadFile()
	{
		$config['upload_path']          = './uploads/gambar_buku/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = 'anggota_'.time();
		$config['overwrite']            = true;
		$config['max_size']           	= 1024; //1mb
 
		$this->load->library('upload', $config);
 
		if ($this->upload->do_upload('url_gambar')){
			return $this->upload->data("file_name");
		}else{
			return ''; //jika tidak ada foto yang terupload
		}
	}
}
