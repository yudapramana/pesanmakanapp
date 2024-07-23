
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();

		if ($this->session->userdata("user_login")!=null) {
			redirect('Dashboard');		
		}
	}
	

	function index(){
		$this->load->view('admin/login');
	}

	function aksilogin(){
		$username = $this->input->post('username');
		$pass     = md5($this->input->post('pass'));
		//cek user
		$ada_user = $this->db->get_where('tb_user', ['username' => $username, 'password' => $pass])->num_rows(); // get_where adalah builder bawaan ci, pengganti select * from
		//mengambil data yang login
		$user 	  = $this->db->get_where('tb_user', ['username' => $username, 'password' => $pass])->row(); // get_where adalah builder bawaan ci, pengganti select * from

		if ($ada_user>0) {
				$session_data = array(
	                'id_login'   => $user->id_user,
	                'user_nama'  => $user->nama_user,
	                'user_login' => $user->username,
	                'level_login'=> $user->level,
	            );


            //set session userdata
            $this->session->set_userdata($session_data);
			echo"<script>
					window.alert('Anda Berhasil Login.!');
				</script>";

	        redirect('Dashboard');
	        // print_r($this->session->flashdata('sweet_alert'));

                
		} else {
			
			$this->session->set_flashdata('message', 
                '<div class="alert alert-success">
                    <h4>Login Gagal </h4>
                    <p>Uername / password yang anda inputkan tidak terdaftar <i>'.$username.'</i>.</p>
                    <p> Silahkan Coba Kembali </p>
                </div>'); 

	        redirect('Login');		
		
		}
	}




}
