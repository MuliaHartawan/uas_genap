<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session', 'form_validation']);
		$this->load->helper('url');
		$this->load->model(['autentikasi_model', 'buku_model']);
	}

	public function index()
	{
		$data = array();
		$error = empty($this->session->flashdata('error')) ? '' : $this->session->flashdata('error');
		$data['error'] = $error;

		$this->load->view('login_view', $data);
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//cek user di database melalui model
		$result = $this->autentikasi_model->cek_autentikasi($username, md5($password));

		if ($result['valid_user']) {
			$user = $result['data_user'];

			//menentukan avatar profil sesuai jenis kelamin
			$avatar = base_url('upload/profil/avatar-unsex.png');
			if (!empty($user->jenis_kelamin)) {
				if ($user->jenis_kelamin == 'L') {
					$avatar = base_url('upload/profil/avatar-man.png');
				}
				else if ($user->jenis_kelamin == 'P') {
					$avatar = base_url('upload/profil/avatar-girl.png');
				}
			}
			
			//menentukan avatar profil jika ada foto profil
			if (!empty($user->foto_profil)) {
				$avatar = base_url($user->foto_profil);
			}

			//buat array data user
			$data_session = array(
				'id_autentikasi' => $user->id_autentikasi,
				'username' => $user->username
			);

			//daftarkan array data user ke session
			$this->session->set_userdata($data_session);

			//arahkan user ke beranda
			redirect(base_url('index.php/beranda'));
		}
		else {
			//jika user tidak ditemukan di database
			$this->session->set_flashdata('error', 'User tidak ditemukan');
			redirect(base_url());
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		
		redirect(base_url());
	}

	public function baru()
	{
		$data = array();
		$error = empty($this->session->flashdata('error')) ? '' : $this->session->flashdata('error');
		$data['error'] = $error;

		$this->load->view('registrasi_view', $data);
	}

	public function registrasi()
	{
	$validasi = $this->form_validation;

		// set aturan validasi (field, label, rule, message(optional))
		$validasi->set_rules('judul', 'Judul', 'required');
		$validasi->set_rules('pengarang', 'Pengarang', 'required');

		if ($validasi->run()){
			$judul = $this->input->post('judul');
			$pengarang = $this->input->post('pengarang');
			$url_gambar = $this->input->post('url_gambar');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
	

		//masukan data ke koleksi
		$inserted_id = $this->buku_model->buku_koleksi($judul, $pengarang, $url_gambar);

		//masukan data ke autentikasi
		$this->autentikasi_model->daftar_akun($inserted_id, $username, md5($password));

		$this->session->set_flashdata('success', 'daftar buku berhasil');

		redirect('autentikasi');
		}
		else{
			return $this->baru();
		}
		
	}

	public function uploadFile()
	{
		$config['upload_path']          = './uploads/gambar_anggota/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = 'buku_'.time();
		$config['overwrite']            = true;
		$config['max_size']           	= 1024; //1mb
 
		$this->load->library('upload', $config);
 
		if ($this->upload->do_upload('url_gambar')){
			return '/uploads/gambar_buku/'.$this->upload->data("file_name");
		}
			return ''; //jika tidak ada foto yang terupload
	}

}
