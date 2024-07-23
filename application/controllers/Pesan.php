<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['PesanModel' => 'PM']);
		if ($this->session->userdata("id_pelanggan")==null) {
			redirect('CekDataPelanggan');		
		}
	}


	function detailproduk(){
		$id = $this->uri->segment('3');
		$data['produk'] = $this->PM->DataLama($id);
		$this->render_page_user('user/produk/detail_produk', $data);
	}

	function produk(){
		$id 		= $this->input->post('id');
		$pl 		= $this->input->post('pl');
		$jumlah 	= $this->input->post('jumlah');

		$data = array('id_makanan' 	=> $id,
						'jumlah' 	=> $jumlah,
						'id_pelanggan' 	=> $pl );
		

		$this->PM->insert_keranjang($data);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Produk Telah Berada di Keranjang..!</font>
			    </div>');
		redirect('DaftarMenuController');
	}

	function keranjang(){
		$pl   = $this->session->userdata('id_pelanggan');
		$data['keranjang'] = $this->PM->keranjang($pl);
		$this->render_page_user('user/produk/keranjang', $data);
	}

	function hapus_keranjang(){
		$id   = $this->uri->segment('3');
		$kode = array('id_keranjang' => $id );

		$this->PM->delete_keranjang($kode);
		$this->session->set_flashdata('message',
				'<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      	<span aria-hidden="true">&times;</span>
			      </button><font color="black">Produk Telah Dihapus dari Keranjang..!</font>
			    </div>');
		redirect('Pesan/keranjang');
	}

	function cek_out() {
	    $keranjang = $this->db->query("SELECT * FROM tb_keranjang tk LEFT JOIN tb_produk_makanan tpm ON tk.id_makanan=tpm.id_makanan")->result();
	    
	    $total_jumlah = 0;
	    $total_harga = 0;
	    $id_p = 0;

	    foreach ($keranjang as $key => $value) {
	        $id_p = $value->id_pelanggan;
	        $jumlah = $value->jumlah;
	        $harga = $value->harga;
	        $tot_h = $harga * $jumlah;

	        $total_jumlah += $jumlah;
	        $total_harga += $tot_h;
	    }

	    // Insert into transaksi table
	    $data1 = array(
	        'jumlah_pesanan' => $total_jumlah,
	        'tgl_trx' => date('Y-m-d H:i:s'),
	        'id_pelanggan' => $id_p,
	        'total_harga' => $total_harga
	    );

	    $this->PM->trx($data1);
	    $id_transaksi = $this->db->insert_id(); // Mengambil id transaksi yang baru saja dimasukkan

	    // Insert into detail transaksi table for each item in the cart
	    foreach ($keranjang as $key => $value) {
	        $id_m = $value->id_makanan;
	        $jumlah = $value->jumlah;
	        $harga = $value->harga;
	        $tot_h = $harga * $jumlah;

	        $data2 = array(
	            'id_transaksi' => $id_transaksi,
	            'id_makanan' => $id_m,
	            'jumlah' => $jumlah,
	            'total_belanja' => $tot_h,
	            'keterangan' => 'proses'
	        );

	        $this->PM->detailtrx($data2);
	        // Update the stock
        	$this->db->query("UPDATE tb_produk_makanan SET stok = stok - $jumlah WHERE id_makanan = $id_m");
	    }

	    // Hapus semua data dari tabel keranjang setelah transaksi selesai
    	$this->db->query("DELETE FROM tb_keranjang WHERE id_pelanggan = $id_p");

	    $this->session->set_flashdata('message',
	        '<div class="alert alert-white bg-gd-sun alert-dismissible" role="alert" style="background-color:#00FFFF">
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button><font color="black">Produk Telah Pesan..!</font>
	        </div>'
	    );

	    redirect('DaftarMenuController');
	}

	


}
