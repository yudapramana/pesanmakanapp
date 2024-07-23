<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarMenuController extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['ProdukModel' => 'PM']);
		if ($this->session->userdata("id_pelanggan")==null) {
			redirect('CekDataPelanggan');		
		}
	}

	function index(){
		$data['produk'] = $this->PM->Dataproduk();
		$data['best'] = $this->PM->bestseller();
		$this->render_page_user('user/home', $data);
	}


}
