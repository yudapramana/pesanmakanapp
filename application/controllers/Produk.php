<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['ProdukModel' => 'PM']);
		if ($this->session->userdata("user_login")==null) {
			redirect('Login');		
		}
		
	}

	function index(){
		$data = [
			'judul'	   => 'LIST DATA PRODUK MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];

		$data['produk'] = $this->PM->Dataproduk();
		$this->render_page('admin/produk/view', $data);
	}

	function tambah_data(){
		$data = [
			'judul'	   => 'FORM PENAMBAHAN PRODUK MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];

		$this->render_page('admin/produk/add', $data);
	}

	function proses_tambah(){
		$nama 		= $this->input->post('nama');
		$harga 		= $this->input->post('harga');
		$ket 		= $this->input->post('ket');
		$stok 		= $this->input->post('stok');
		$tgl 		= date('Y_m-d');

		// Hilangkan karakter "Rp", titik, dan spasi dalam angka
		$angka = preg_replace("/[^0-9]/", "", $harga);

		// Trim untuk menghilangkan spasi di awal dan akhir
		$angka = (int)$angka;

		// var_dump($angka);

		// PRODUK Upload Configuration
	    $config_ktp = array(
	        'file_name' 	=> 'Produk-' . $nama . '-' . random_string('alnum', 10),
	        'upload_path' 	=> './assets/images/produk',
	        'allowed_types' => 'jpg|jpeg|png|svg',
	        'max_size' 		=> '9999999999'
	    );
	    $this->upload->initialize($config_ktp);

	    // Upload KTP
	    if (!$this->upload->do_upload('gambar')) {
	        $error = array('error' => $this->upload->display_errors());
	        echo 'Error uploading produk file: ' . $error['error'];
	        return;
	    } else {
	        $gambar_file = $this->upload->data('file_name');
	    }

		$data = array('nm_makanan' 	=> $nama,
						'harga' 	=> $angka,
						'ket' 		=> $ket,
						'stok'		=> $stok,
						'gambar_produk' => $gambar_file,
						'upload_date' 	=> $tgl );
		

		$this->PM->insert_produk($data);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Penambahan Data Produk Berhasil..!</font>
			    </div>');
		redirect('Produk');
	}


	function edit_data(){
		$data = [
			'judul'	   => 'FORM PERUBAHAN DATA PRODUK APLIKASI',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];
		$id = $this->uri->segment('3');
		$data['produk'] = $this->PM->DataLama($id);
		$this->render_page('admin/produk/edit', $data);
	}

	function proses_ubah(){
	    // var_dump($_FILES);
	    $id         = $this->input->post('id');
	    $nama       = $this->input->post('nama');
	    $harga      = $this->input->post('harga');
	    $ket        = $this->input->post('ket');
	    $stok       = $this->input->post('stok');
	    $gambar     = $this->input->post('gambar');
	    $gambar_lama= $this->input->post('gambar_lama');
	    $tgl        = date('Y_m-d');

	    // Hilangkan karakter "Rp", titik, dan spasi dalam angka
	    $angka = preg_replace("/[^0-9]/", "", $harga);

	    // Trim untuk menghilangkan spasi di awal dan akhir
	    $angka = (int)$angka;

	    if (empty($_FILES['gambar']['name'])) {
	        $data = array('nm_makanan'    => $nama,
	                      'harga'         => $angka,
	                      'ket'           => $ket,
	                      'stok'          => $stok,
	                      'upload_date'   => $tgl );
	    } else {
	        // PRODUK Upload Configuration
	        $config_ktp = array(
	            'file_name'     => 'Produk-' . $nama . '-' . random_string('alnum', 10),
	            'upload_path'   => './assets/images/produk',
	            'allowed_types' => 'jpg|jpeg|png|svg',
	            'max_size'      => '9999999999'
	        );
	        $this->upload->initialize($config_ktp);

	        // Upload KTP
	        if (!$this->upload->do_upload('gambar')) {
	            $error = array('error' => $this->upload->display_errors());
	            echo 'Error uploading produk file: ' . $error['error'];
	            return;
	        } else {
	            $gambar_file = $this->upload->data('file_name');
	        }

	        $data = array('nm_makanan'    => $nama,
	                      'harga'         => $angka,
	                      'ket'           => $ket,
	                      'stok'          => $stok,
	                      'gambar_produk' => $gambar_file,
	                      'upload_date'   => $tgl );

	        unlink('./assets/images/produk/' . $gambar_lama);
	    }

	    $kode = array('id_makanan' => $id );

	    $this->PM->update_produk($data, $kode);
	    $this->session->set_flashdata('message',
	            '<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	              </button><font color="black">Perubahan Data Produk Berhasil..!</font>
	            </div>');
	    redirect('Produk');
	}


	function hapus_data(){
		$id = $this->uri->segment('3');
		$cek_file = $this->db->query("SELECT gambar_produk FROM tb_produk_makanan WHERE id_makanan=$id")->row_array();
		$kode = array('id_makanan' => $id );
		$this->PM->hapus_data($kode);
		unlink('./assets/images/produk/' . $cek_file['gambar_produk']);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#FF4500">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="white">Penghapusan Data Produk Berhasil..!</font>
			    </div>');
		redirect('Produk');
	}

	function best_seller(){
		$id = $this->uri->segment('3');
		$best = array('best_seller' => 'aktif' );
		$kode = array('id_makanan' => $id );
		$this->PM->update_best_seller($best, $kode);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#FF4500">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="white">Data Di Jadikan BEST SELLER..!</font>
			    </div>');
		redirect('Produk');
	}

	function hapus_best_seller(){
		$id = $this->uri->segment('3');
		$best = array('best_seller' => '' );
		$kode = array('id_makanan' => $id );
		$this->PM->update_best_seller($best, $kode);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#FF4500">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="white">Data Di Copot Dari Status BEST SELLER..!</font>
			    </div>');
		redirect('Produk');
	}


}
