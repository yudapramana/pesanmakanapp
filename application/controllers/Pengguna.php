<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['PenggunaModel' => 'PM']);
		if ($this->session->userdata("user_login")==null) {
			redirect('Login');		
		}
		
	}

	function index(){
		$data = [
			'judul'	   => 'LIST DATA PELANGGAN',
			'subjudul' => 'PELANGGAN',
			'deskripsi'   => ''
		];

		$data['pengguna'] = $this->PM->Datapengguna();
		$this->render_page('admin/user/view', $data);
	}

	function tambah_data(){
		$data = [
			'judul'	   => 'FORM PENAMBAHAN PENGGUNA APLIKASI',
			'subjudul' => 'PENGGUNA APLIKASI',
			'deskripsi'   => ''
		];
		$data['level'] = $this->PM->level();
		$this->render_page('admin/user/add', $data);
	}

	function proses_tambah(){
		$nama 		= $this->input->post('nama');
		$username 	= $this->input->post('username');
		$password 	= md5($this->input->post('password'));
		$level 		= $this->input->post('level');
		$tgl 		= date('Y_m-d');

		$data = array('nm_user' 	=> $nama,
						'username' 	=> $username,
						'password' 	=> $password,
						'level'		=> $level,
						'create_at' => $tgl );
		

		$this->PM->insert_pengguna($data);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Penambahan Data Pengguna Berhasil..!</font>
			    </div>');
		redirect('Pengguna');
	}


	function edit_data(){
		$data = [
			'judul'	   => 'FORM PERUBAHAN DATA PRODUK APLIKASI',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];
		$id = $this->uri->segment('3');
		$data['pengguna'] = $this->PM->DataLama($id);
		$data['level'] = $this->PM->level();
		$this->render_page('admin/user/edit', $data);
	}

	function proses_ubah(){
	    $id 		= $this->input->post('id');
	    $nama 		= $this->input->post('nama');
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('pass');
		$level 		= $this->input->post('level');
		$tgl 		= date('Y_m-d');
		if ($password=='') {
			$data = array('nm_user' 	=> $nama,
						'username' 	=> $username,
						'level'		=> $level,
						'create_at' => $tgl );
		}else{
			$pass = md5($password);
			$data = array('nm_user' 	=> $nama,
						'username' 	=> $username,
						'password' 	=> $pass,
						'level'		=> $level,
						'create_at' => $tgl );
		}
		

	    $kode = array('id_user' => $id );

	    $this->PM->update_pengguna($data, $kode);
	    $this->session->set_flashdata('message',
	            '<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	              </button><font color="black">Perubahan Data Pengguna Berhasil..!</font>
	            </div>');
	    redirect('Pengguna');
	}


	function hapus_data(){
		$id = $this->uri->segment('3');
		$kode = array('id_user' => $id );
		$this->PM->hapus_data($kode);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#FF4500">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="white">Penghapusan Data Pengguna Berhasil..!</font>
			    </div>');
		redirect('Pengguna');
	}


}
