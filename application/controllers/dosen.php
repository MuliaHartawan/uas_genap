<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dosen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('dosen_model');
		$this->load->library('session');
	}

	public function index()
	{
		// ambil data dosen
		$data_dosen = $this->dosen_model->ambil_semua_dosen(); 

		// masukkan data ke array yang akan dipassing ke view
		$data['dosen'] = $data_dosen;

		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/dosen/data_dosen.php', $data); //content
		$this->load->view('footer_view');
	}

	public function create()
	{
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/dosen/tambah_dosen.php'); //content
		$this->load->view('footer_view');
	}
	
	public function store()
	{
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tanggal_lahir = $this->input->post('tanggal_lahir'); //content
		// foto kita skip

		$result = $this->dosen_model->tambah_dosen($nip, $nama, $alamat, $tanggal_lahir);

		$this->session->set_flashdata('success', 'Tambah data dosen berhasil');

		redirect(base_url('index.php/dosen'));
		

		// $data['message'] = 'Simpan data dosen berhasil.';

	}

	public function show($id = null)
	{
		if (!isset($id)) redirect('dosen');	

		$data['dosen'] = $this->dosen_model->ambil_dosen($id); 
		
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/dosen/tampil_dosen.php', $data); //content
		$this->load->view('footer_view');	
	}
	public function edit($id = null) //handling eorro tanpa id
	{
		//handling error tanpa id
		if (!isset($id)) redirect('dosen');	

		$data['dosen'] = $this->dosen_model->ambil_dosen($id); 
		
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/dosen/edit_dosen.php', $data); //content
		$this->load->view('footer_view');
	}

	public function update($id)
	{
		if (!isset($id)) redirect('dosen');

		$this->dosen_model->update_dosen($id);
		$this->session->set_flashdata('success', "Edit dosen berhasil");

		redirect('dosen');
	}

	public function delete($id)
	{
		$this->dosen_model->hapus_dosen($id);

		redirect(base_url('index.php/dosen'));
	}
}