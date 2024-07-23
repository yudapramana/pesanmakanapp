<?php 
	if (! defined('BASEPATH')) exit('No direct script access allowed');

	class MY_Controller extends CI_Controller {
		
		function __construct(){
            parent::__construct();
        	
         }

		function render_page($content, $data = NULL){

			$data['headernya'] = $this->load->view('admin/header', $data, TRUE);
			$data['contentnya']= $this->load->view($content, $data, TRUE);
			$data['menunya']   = $this->load->view('admin/menu', $data, TRUE);
			$data['footernya'] = $this->load->view('admin/footer', $data, TRUE);

			$this->load->view('admin/index', $data);
		}

		function render_page_user($content, $data = NULL){

			$data['headernya'] = $this->load->view('user/header', $data, TRUE);
			// $data['menunya']   = $this->load->view('admin/menu', $data, TRUE);
			$data['contentnya']= $this->load->view($content, $data, TRUE);
			$data['footernya'] = $this->load->view('user/footer', $data, TRUE);

			$this->load->view('user/index', $data);
		}

	 //    protected function check_session() {
		//     $idPelanggan = $this->session->userdata('id_pelanggan');
		//     if (empty($idPelanggan)) {
		//         redirect('CekDataPelanggan'); // Arahkan ke halaman login atau pesan kesalahan sesuai kebutuhan
		//     }
		// }
		
	}
 ?>