<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['ProdukModel' => 'PM']);
		$this->load->model(['TransaksiModel' => 'TM']);
		if ($this->session->userdata("user_login")==null) {
			redirect('Login');		
		}
	}

	function index(){
		$data['produk'] = $this->PM->total_produk();
		$data['pelanggan'] = $this->PM->total_pelanggan();
		$data['transaksi'] = $this->TM->total_trx();
		$data['omset'] = $this->TM->total_omset();
		$data['user'] = $this->PM->total_user();
		$this->render_page('admin/home', $data);
	}

	function logout(){
		$this->session->sess_destroy();
		redirect("Login");
	}

}
