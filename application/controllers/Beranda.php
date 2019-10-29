<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		// echo '<p>Anda berada di Beranda.</p>';
		// echo '<a href="'.base_url('index.php/autentikasi/logout').'">Logout</a>';
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('content/dashboard_view'); //content
		$this->load->view('footer_view');
	}

}