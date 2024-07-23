<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['TransaksiModel' => 'TM']);
		if ($this->session->userdata("user_login")==null) {
			redirect('Login');		
		}
		
	}

	function index(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];

		$data['trx'] = $this->TM->Datatransaksi();
		$this->render_page('admin/transaksi/view', $data);
	}

	function proses(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'id_pelanggan' => $this->uri->segment('3')
		];

		$this->render_page('admin/transaksi/proses_trx', $data);
	}

	function aksi_proses(){
		$id 		= $this->input->post('id');
		$ket 		= $this->input->post('status');

		$data = array('keterangan' 	=> $ket);
		$id_trx = array('id_transaksi' => $id );

		$this->TM->update_proses($data, $id_trx);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Produk Pesanan Telah Di Update..!</font>
			    </div>');
		redirect('Transaksi');
	}

	function bayar(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'id_trx'   => $this->uri->segment('3')
		];


		$id_trx = $this->uri->segment('3');
		$data['trx'] = $this->TM->Datatransaksi_old($id_trx);
		$data['member'] = $this->TM->Datatmember();		
		$data['diskon'] = $this->TM->Datadiskon();
		$this->render_page('admin/transaksi/bayar_pesanan', $data);
	}

	function proses_bayar(){
		$id 		= $this->input->post('id');
		$belanja 	= $this->input->post('stlahdiskon');
		$bayar 		= $this->input->post('bayar');
		$kembalian 	= $this->input->post('kembalian');
		$member 	= $this->input->post('member');
		$idm 		= $this->input->post('idm');
		$diskon 	= $this->input->post('diskon');
		$tgl 		= date('Y-m-d H:i:s');

		if ($member=="") {
			$data = array('id_transaksi' 	=> $id, 'total_pesanan' 	=> $belanja, 'uang_bayar' 	=> $bayar, 'kembalian' 	=> $kembalian, 'tgl_bayar' => $tgl);
		}else if ($member!="" AND $diskon=="") {
		    if (empty($idm)) {
		        // $idm kosong, beri alert dan redirect kembali ke halaman bayar
		        $this->session->set_flashdata('message',
		            '<div class="alert alert-danger" role="alert">
		                Data member tidak boleh kosong!
		            </div>');
		        redirect('Transaksi/bayar/'.$id); // Sesuaikan dengan URL halaman bayar Anda
		    } else {
		        // $idm tidak kosong, proses seperti biasa
		        $data = array(
		            'id_transaksi' => $id,
		            'total_pesanan' => $belanja,
		            'uang_bayar' => $bayar,
		            'kembalian' => $kembalian,
		            'id_member' => $idm,
		            'tgl_bayar' => $tgl
		        );
		    }
		} else if ($member!="" AND $diskon!="") {
		    if (empty($idm)) {
		        // $idm kosong, beri alert dan redirect kembali ke halaman bayar
		        $this->session->set_flashdata('message',
		            '<div class="alert alert-danger" role="alert">
		                Data member tidak boleh kosong!
		            </div>');
		        redirect('Transaksi/bayar/'.$id); // Sesuaikan dengan URL halaman bayar Anda
		    } else {
		        // $idm tidak kosong, proses seperti biasa
		        $data = array(
		            'id_transaksi' => $id,
		            'total_pesanan' => $belanja,
		            'uang_bayar' => $bayar,
		            'kembalian' => $kembalian,
		            'id_member' => $idm,
		            'kd_diskon' => $diskon,
		            'tgl_bayar' => $tgl
		        );
		    }
		}
		

		$data2 = array('keterangan' => 'SUDAH BAYAR' );
		$id_trx = array('id_transaksi' => $id );
		$this->TM->insert_bayar($data);
		$this->TM->update_proses($data2, $id_trx);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Pesanan Telah Melakukan Pembayaran..!</font>
			    </div>');
		redirect('Transaksi');
	}

	function laporan(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];

		$this->render_page('admin/transaksi/laporan', $data);
	}

	function report(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => $this->input->post('awal')
		];
		$t_a = $this->input->post('awal');
		$t_s = $this->input->post('sampai');
		$data['trx'] = $this->TM->Report_trx($t_a, $t_s);
		$this->load->view('admin/transaksi/cetak', $data);
	}

	function report_pembayaran(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => $this->input->post('awal')
		];
		$t_a = $this->input->post('awal');
		$t_s = $this->input->post('sampai');
		$data['trx'] = $this->TM->Report_pembayaran($t_a, $t_s);
		$this->load->view('admin/transaksi/pembayaran', $data);
	}

	function detail(){
		$data = [
			'judul'	   => 'LIST TRANSAKSI PEMESANAN MAKANAN',
			'subjudul' => 'PRODUK MAKANAN',
			'deskripsi'   => ''
		];
		$id = $this->uri->segment('3');
		$data['plg'] = $this->TM->plgtrx($id);
		$data['trx'] = $this->TM->Detailtransaksi($id);
		$this->render_page('admin/transaksi/viewdetail', $data);
	}

	function diskon(){
		$data = [
			'judul'	   => 'LIST DATA DISKON',
			'subjudul' => 'DATA DISKON',
			'deskripsi'   => ''
		];

		$data['diskon'] = $this->TM->Datadiskon();
		$this->render_page('admin/diskon/view', $data);
	}

	function tambah_data_diskon(){
		$data = [
			'judul'	   => 'FORM INPUT DATA DISKON',
			'subjudul' => 'DATA DISKON',
			'deskripsi'   => ''
		];

		$this->render_page('admin/diskon/add', $data);
	}

	function proses_tambah_diskon(){
	    $diskon = $this->input->post('diskon');
	    $tgl    = date('Y-m-d');
	    $length = 8;

	    // Membuat kode acak
	    do {
	        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	        $charactersLength = strlen($characters);
	        $randomCode = '';
	        for ($i = 0; $i < $length; $i++) {
	            $randomCode .= $characters[rand(0, $charactersLength - 1)];
	        }

	        // Mengecek apakah kode sudah ada di database
	        $existingCode = $this->TM->get_diskon_by_code($randomCode);
	    } while ($existingCode != null);

	    // Data yang akan dimasukkan ke database
	    $data = array(
	        'kd_diskon'         => $randomCode,
	        'diskon'            => $diskon,
	        'tgl_create_diskon' => $tgl
	    );

	    // Memasukkan data ke database
	    $this->TM->insert_diskon($data);

	    // Menampilkan pesan sukses
	    $this->session->set_flashdata('message',
	        '<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	            <font color="black">Data diskon telah berhasil ditambahkan..!</font>
	        </div>'
	    );

	    // Mengarahkan kembali ke halaman diskon
	    redirect('Transaksi/diskon');
	}


	function edit_data_diskon(){
		$data = [
			'judul'	   => 'FORM EDIT DATA DISKON',
			'subjudul' => 'DATA DISKON',
			'deskripsi'   => ''
		];

		$id = $this->uri->segment('3');
		$data['diskon'] = $this->TM->Datadiskonlama($id);
		$this->render_page('admin/diskon/edit', $data);
	}

	function proses_edit_diskon(){
	    $id =  $this->input->post('id');
	    $diskon = $this->input->post('diskon');

	    // Data yang akan dimasukkan ke database
	    $data = array('diskon'    => $diskon);
	    $kode = array('id_diskon' => $id );
	    // Memasukkan data ke database
	    $this->TM->update_diskon($data, $kode);

	    // Menampilkan pesan sukses
	    $this->session->set_flashdata('message',
	        '<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	            <font color="black">Data diskon telah berhasil di ubah..!</font>
	        </div>'
	    );

	    // Mengarahkan kembali ke halaman diskon
	    redirect('Transaksi/diskon');
	}


	function hapus_data_diskon(){
		$id = $this->uri->segment('3');
		$kode = array('id_diskon' => $id );
		$this->TM->delete_diskon($kode);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#FF4500">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="white">Penghapusan Data Diskon Berhasil..!</font>
			    </div>');
		redirect('Transaksi/diskon');
	}


}