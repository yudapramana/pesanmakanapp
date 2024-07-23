<?php 
	class PesanModel extends CI_Model
	{
		function Dataproduk() {
			$this->db->select('*');
			$this->db->from('tb_produk_makanan');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function DataLama($id) {
			$this->db->select('*');
			$this->db->from('tb_produk_makanan');
			$this->db->where('id_makanan', $id);
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	    function insert_produk($data){
	    	$this->db->insert('tb_produk_makanan', $data);
	    }

	    function update_produk($data, $kode){
	    	$this->db->update('tb_produk_makanan', $data, $kode);
	    }

	    function hapus_data($kode){
	    	$this->db->delete('tb_produk_makanan', $kode);
	    }
	    function insert_keranjang($data){
	    	$this->db->insert('tb_keranjang', $data);
	    }

	    function keranjang($pl) {
			$this->db->select('*');
			$this->db->from('tb_keranjang tk');
			$this->db->join('tb_produk_makanan tpm','tk.id_makanan=tpm.id_makanan');
			$this->db->where('tk.id_pelanggan', $pl);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function delete_keranjang($kode){
	    	$this->db->delete('tb_keranjang', $kode);
	    }

	    function trx($data1){
	    	$this->db->insert('tb_transaksi', $data1);
	    }
	    function detailtrx($data2){
	    	$this->db->insert('tb_detail_transaksi', $data2);
	    }

	    public function insert_photo($data) {
		    // Masukkan data gambar ke dalam tabel photos
		    $this->db->insert('tb_pelanggan', $data);
		    return $this->db->insert_id();  // Mengembalikan ID dari data yang baru saja dimasukkan
		}

		function DataPesanan() {
			$this->db->select('*');
			$this->db->from('tb_transaksi tt');
			$this->db->join('tb_detail_transaksi tdt','tt.id_trx=tdt.id_transaksi','LEFT');
			$this->db->join('tb_pelanggan tp','tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->group_by('tdt.id_transaksi');
			$this->db->order_by('tt.id_trx', 'DESC');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    
	}