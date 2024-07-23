<?php 
	class ProdukModel extends CI_Model
	{
		function Dataproduk() {
			$this->db->select('*');
			$this->db->from('tb_produk_makanan');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function bestseller() {
			$this->db->select('*');
			$this->db->from('tb_produk_makanan');
			$this->db->where('best_seller','aktif');
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

	    function total_produk(){
	    	$this->db->select('*');
			$this->db->from('tb_produk_makanan');
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function total_pelanggan(){
	    	$this->db->select('*');
			$this->db->from('tb_pelanggan');
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function total_user(){
	    	$this->db->select('*');
			$this->db->from('tb_user');
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function update_best_seller($best, $kode){
	    	$this->db->update('tb_produk_makanan', $best, $kode);
	    }
	}