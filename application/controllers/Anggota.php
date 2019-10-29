<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'session');
		$this->load->model('anggota_model');
		$this->load->library(array('session', 'form_validation'));

		// if ($this->session->userdata('status_login') != true) {
		// 	$this->session->set_flashdata('error', "Anda Harus Login Terlebih Dahulu !");
		// 	redirect(base_url());	
		// }
	}

	public function index()
	{
		// ambil data anggota
		$data_anggota = $this->anggota_model->ambil_semua_anggota(); 

		// masukkan data ke array yang akan dipassing ke view
		$data['anggota'] = $data_anggota;

		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/anggota/data_anggota.php', $data); //content
		$this->load->view('footer_view');
	}

	public function create()
	{
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/anggota/tambah_anggota.php'); //content
		$this->load->view('footer_view');
	}
	
	public function store()
	{
		
		$validasi = $this->form_validation;

		// set aturan validasi (field, label, rule, message(optional))
		$validasi->set_rules([
			['field' => 'nama', 'label' => 'Nama', 'rules' => 'required', 'errors' => array('required' =>'kolom %s harus diisi.')],
			['field' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'rules' => 'required'],
		]);

		if ($validasi->run()){

			
		$result = $this->anggota_model->tambah_anggota();

		$this->session->set_flashdata('success', 'Tambah anggota berhasil');

		redirect('anggota');
		}
		else{
			return $this->create();
		}
		
		

		// $data['message'] = 'Simpan data anggota berhasil.';

	}

	public function show($id = null)
	{
		if (!isset($id)) redirect('anggota');	

		$data['anggota'] = $this->anggota_model->ambil_anggota($id); 
		
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/anggota/tampil_anggota.php', $data); //content
		$this->load->view('footer_view');	
	}
	public function edit($id = null) //handling eorro tanpa id
	{
		//handling error tanpa id
		if (!isset($id)) redirect('anggota');	

		$data['anggota'] = $this->anggota_model->ambil_anggota($id); 
		
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/anggota/edit_anggota.php', $data); //content
		$this->load->view('footer_view');
	}

	public function update($id)
	{
		if (!isset($id)) redirect('anggota');

		$this->anggota_model->update_anggota($id);
		$this->session->set_flashdata('success', "Edit anggota berhasil");

		redirect('anggota');
	}

	public function delete($id)
	{
		$this->anggota_model->hapus_anggota($id);

		redirect(base_url('index.php/anggota'));
	}
	
	
}