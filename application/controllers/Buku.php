<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'session');
		$this->load->model('buku_model');
		$this->load->library(array('session', 'form_validation'));

		if ($this->session->userdata('status_login')) {
			$this->session->set_flashdata('error', "Anda Harus Login Terlebih Dahulu !");
			redirect(base_url());	
		}
	}

	public function index()
	{
		// ambil data koleksi
		$data_buku = $this->buku_model->ambil_semua_buku(); 

		// masukkan data ke array yang akan dipassing ke view
		$data['buku'] = $data_buku;

		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/buku/data_buku.php', $data); //content
		$this->load->view('footer_view');
	}

	public function create()
	{
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/buku/tambah_buku.php'); //content
		$this->load->view('footer_view');
	}
	
	public function store()
	{
		
		$validasi = $this->form_validation;

		// set aturan validasi (field, label, rule, message(optional))
		$validasi->set_rules([
			['field' => 'judul', 'label' => 'Judul', 'rules' => 'required', 'errors' => array('required' =>'kolom %s harus diisi.')],
			['field' => 'pengarang', 'label' => 'Pengarang', 'rules' => 'required'],
		]);

		if ($validasi->run()){

			
		$result = $this->buku_model->tambah_buku();

		$this->session->set_flashdata('success', 'Tambah Buku berhasil');

		redirect('buku');
		}
		else{
			return $this->create();
		}
		
		

		// $data['message'] = 'Simpan data koleksi berhasil.';

	}

	public function show($id = null)
	{
		if (!isset($id)) redirect('buku');	

		$data['buku'] = $this->buku_model->ambil_buku($id); 
		
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/buku/tampil_buku.php', $data); //content
		$this->load->view('footer_view');	
	}
	public function edit($id = null) //handling eorro tanpa id
	{
		//handling error tanpa id
		if (!isset($id)) redirect('buku');	

		$data['buku'] = $this->buku_model->ambil_buku($id); 
		
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/buku/edit_buku.php', $data); //content
		$this->load->view('footer_view');
	}

	public function update($id)
	{
		if (!isset($id)) redirect('buku');

		$this->buku_model->update_buku($id);
		$this->session->set_flashdata('success', "Edit buku berhasil");

		redirect('buku');
	}

	public function delete($id)
	{
		$this->buku_model->hapus_buku($id);

		redirect(base_url('index.php/buku'));
	}
	
	
}