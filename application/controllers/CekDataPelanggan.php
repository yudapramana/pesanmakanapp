<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekDataPelanggan extends MY_Controller {

	function __construct(){
		parent::__construct();
		
		if ($this->session->userdata("id_pelanggan")!=null) {
			redirect('DaftarMenuController');		
		}
	}

	function index(){
		$this->load->view('user/akses_awal');
	}
}