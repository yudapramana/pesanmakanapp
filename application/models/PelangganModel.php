<?php 
	class PelangganModel extends CI_Model
	{
		function Datapelanggan() {
			$this->db->select('*');
			$this->db->from('tb_pelanggan');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function DataLama($id) {
			$this->db->select('*');
			$this->db->from('tb_pelanggan');
			$this->db->where('id_pelanggan', $id);
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	    function Datamember() {
			$this->db->select('*');
			$this->db->from('tb_member');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function insert_member($data){
	    	$this->db->insert('tb_member', $data);
	    }

	    function DataLamaMember($id){
	    	$this->db->select('*');
			$this->db->from('tb_member');
			$this->db->where('id_member', $id);
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	    function update_pelanggan($data, $kode){
	    	$this->db->update('tb_member', $data, $kode);
	    }

	    function hapus_data($kode){
	    	$this->db->delete('tb_member', $kode);
	    }

	    function get_code_by_code($code) {
	        $this->db->where('kd_member', $code);
	        $query = $this->db->get('tb_member'); // Gantilah 'table_diskon' dengan nama tabel yang sesuai
	        return $query->row();
	    }

	}