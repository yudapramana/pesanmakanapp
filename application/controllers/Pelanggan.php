<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['PelangganModel' => 'PM']);
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

		$data['pelanggan'] = $this->PM->Datapelanggan();
		$this->render_page('admin/pelanggan/view', $data);
	}

	function member(){
		$data = [
			'judul'	   => 'LIST DATA MEMBER',
			'subjudul' => 'MEMBER',
			'deskripsi'   => ''
		];

		$data['member'] = $this->PM->Datamember();
		$this->render_page('admin/pelanggan/viewmember', $data);
	}

	function tambah_data(){
		$data = [
			'judul'	   => 'FORM PENAMBAHAN DATA MEMBER',
			'subjudul' => 'DATA MEMBER',
			'deskripsi'   => ''
		];

		$this->render_page('admin/pelanggan/add', $data);
	}

	function proses_tambah(){
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$nohp 		= $this->input->post('nohp');
		$jk 		= $this->input->post('jk');
		$tgl 		= date('Y_m-d');

		$length = 10;

	    // Membuat kode acak
	    do {
	        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	        $charactersLength = strlen($characters);
	        $randomCode = '';
	        for ($i = 0; $i < $length; $i++) {
	            $randomCode .= $characters[rand(0, $charactersLength - 1)];
	        }

	        // Mengecek apakah kode sudah ada di database
	        $existingCode = $this->PM->get_code_by_code($randomCode);
	    } while ($existingCode != null);

		$data = array('nm_member' 	=> $nama,
						'alamat' 	=> $alamat,
						'no_hp' 	=> $nohp,
						'jk_member'	=> $jk,
						'tgl_create_member' => $tgl,
						'kd_member' => $randomCode );
		

		$this->PM->insert_member($data);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Penambahan Data Member Berhasil..!</font>
			    </div>');
		redirect('Pelanggan/member');
	}


	function edit_data(){
		$data = [
			'judul'	   => 'FORM PERUBAHAN DATA MEMBER',
			'subjudul' => 'MEMBER',
			'deskripsi'   => ''
		];
		$id = $this->uri->segment('3');
		$data['member'] = $this->PM->DataLamaMember($id);
		$this->render_page('admin/pelanggan/edit', $data);
	}

	function proses_ubah(){
	    $id 		= $this->input->post('id');
	    $nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$nohp 		= $this->input->post('nohp');
		$jk 		= $this->input->post('jk');
		$tgl 		= date('Y_m-d');

		$data = array('nm_member' 	=> $nama,
						'alamat' 	=> $alamat,
						'no_hp' 	=> $nohp,
						'jk_member'	=> $jk,
						'tgl_create_member' => $tgl );

	    $kode = array('id_member' => $id );

	    $this->PM->update_pelanggan($data, $kode);
	    $this->session->set_flashdata('message',
	            '<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	              </button><font color="black">Perubahan Data Member Berhasil..!</font>
	            </div>');
	    redirect('Pelanggan/member');
	}


	function hapus_data(){
		$id = $this->uri->segment('3');
		$kode = array('id_member' => $id );
		$this->PM->hapus_data($kode);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#FF4500">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="white">Penghapusan Data Member Berhasil..!</font>
			    </div>');
		redirect('Pelanggan/member');
	}


}
