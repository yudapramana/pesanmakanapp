<?php 
	class PenggunaModel extends CI_Model
	{
		function Datapengguna() {
			$this->db->select('*');
			$this->db->from('tb_user');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function level() {
			$this->db->select('*');
			$this->db->from('tb_level');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function insert_pengguna($data){
	    	$this->db->insert('tb_user', $data);
	    }

	    function hapus_data($kode){
	    	$this->db->delete('tb_user', $kode);
	    }

	    function DataLama($id) {
			$this->db->select('');
			$this->db->from('tb_user');
			$this->db->where('id_user', $id);
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	    function update_pengguna($data, $kode){
	    	$this->db->update('tb_user', $data, $kode);
	    }
	}