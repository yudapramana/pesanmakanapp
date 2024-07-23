<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['PesanModel' => 'PM']);

	}

	function index(){
		$data['pesanan'] = $this->PM->DataPesanan();
		$this->render_page_user('user/produk/pesanan', $data);
	}
}