<?php 
	class TransaksiModel extends CI_Model
	{
		function Datatransaksi() {
			$this->db->select('*');
			$this->db->from('tb_transaksi tt');
			$this->db->join('tb_detail_transaksi tdt', 'tt.id_trx=tdt.id_transaksi', 'LEFT');
			$this->db->join('tb_pelanggan tp', 'tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->group_by('tdt.id_transaksi');
			$this->db->order_by('tt.id_trx','DESC');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function update_proses($data, $id_trx){
	    	$this->db->update('tb_detail_transaksi', $data, $id_trx);
	    }

	    function Datatransaksi_old($id_trx){
	    	$this->db->select('*');
			$this->db->from('tb_transaksi tt');
			$this->db->join('tb_detail_transaksi tdt', 'tt.id_trx=tdt.id_transaksi', 'LEFT');
			$this->db->join('tb_pelanggan tp', 'tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->where('tt.id_trx', $id_trx);
			$this->db->group_by('tdt.id_transaksi');
			$this->db->order_by('tt.id_trx','DESC');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function insert_bayar($data){
	    	$this->db->insert('tb_bayar', $data);
	    }

	    function Report_trx($t_a, $t_s){
	    	$this->db->select('*');
			$this->db->from('tb_transaksi tt');
			$this->db->join('tb_detail_transaksi tdt', 'tt.id_trx=tdt.id_transaksi', 'LEFT');
			$this->db->join('tb_pelanggan tp', 'tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->join('tb_produk_makanan tpm', 'tdt.id_makanan=tpm.id_makanan', 'LEFT');
			$this->db->where('tt.tgl_trx >=', $t_a);
			$this->db->where('tt.tgl_trx <=', $t_s);
			$this->db->order_by('tt.id_trx','DESC');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function Report_pembayaran($t_a, $t_s){
	    	$this->db->select('*');
			$this->db->from('tb_bayar tb');
			$this->db->join('tb_transaksi tt', 'tb.id_transaksi=tt.id_trx', 'LEFT');
			$this->db->join('tb_diskon td', 'tb.kd_diskon=td.diskon', 'LEFT');
			$this->db->join('tb_detail_transaksi tdt', 'tt.id_trx=tdt.id_transaksi', 'LEFT');
			$this->db->join('tb_pelanggan tp', 'tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->join('tb_produk_makanan tpm', 'tdt.id_makanan=tpm.id_makanan', 'LEFT');
			$this->db->where('tb.tgl_bayar >=', $t_a);
			$this->db->where('tb.tgl_bayar <=', $t_s);
			$this->db->order_by('tb.tgl_bayar','DESC');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function total_trx(){
	    	$this->db->select('*');
			$this->db->from('tb_transaksi');
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function total_omset(){
	    	 $this->db->select_sum('total_harga');
			$this->db->from('tb_transaksi');
	        $query = $this->db->get();
	        return $query->row()->total_harga;
	    }

	    function Detailtransaksi($id) {
			$this->db->select('*');
			$this->db->from('tb_transaksi tt');
			$this->db->join('tb_detail_transaksi tdt', 'tt.id_trx=tdt.id_transaksi', 'LEFT');
			$this->db->join('tb_pelanggan tp', 'tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->join('tb_produk_makanan tpm', 'tdt.id_makanan=tpm.id_makanan');
			$this->db->where('tt.id_trx', $id);
			$this->db->order_by('tt.id_trx','DESC');
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function plgtrx($id) {
			$this->db->select('*');
			$this->db->from('tb_transaksi tt');
			$this->db->join('tb_pelanggan tp', 'tt.id_pelanggan=tp.id_pelanggan', 'LEFT');
			$this->db->where('tt.id_trx', $id);
			$this->db->order_by('tt.id_trx','DESC');
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	    function Datadiskon(){
	    	$this->db->select('*');
	    	$this->db->from('tb_diskon');
	    	$query = $this->db->get();
	    	return $query->result();
	    }

	    function get_diskon_by_code($code) {
	        $this->db->where('kd_diskon', $code);
	        $query = $this->db->get('tb_diskon'); // Gantilah 'table_diskon' dengan nama tabel yang sesuai
	        return $query->row();
	    }

	    function insert_diskon($data){
	    	$this->db->insert('tb_diskon', $data);
	    }

	    function Datadiskonlama($id){
	    	$this->db->select('*');
	    	$this->db->from('tb_diskon');
	    	$this->db->where('id_diskon', $id);
	    	$query = $this->db->get();
	    	return $query->row_array();
	    }

	    function update_diskon($data, $kode){
	    	$this->db->update('tb_diskon', $data, $kode);
	    }
	    function delete_diskon($kode){
	    	$this->db->delete('tb_diskon', $kode);
	    }

	    function Datatmember(){
	    	$this->db->select('*');
	    	$this->db->from('tb_member');
	    	$query = $this->db->get();
	    	return $query->result();
	    }

	}