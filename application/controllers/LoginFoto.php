
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginFoto extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model(['PesanModel' => 'PM']);
	}
	
	public function upload_photo() {
	    // Ambil data gambar dari form
	    $imageData = $this->input->post('cameraInput');

	    // Simpan file gambar di direktori
	    $imageData = str_replace('data:image/png;base64,', '', $imageData);
	    $imageData = base64_decode($imageData);
	    $fileName = 'uploaded_image_' . uniqid() . '.png';  // Nama file unik
	    $filePath = './assets/images/pelanggan/' . $fileName; // Sesuaikan dengan path yang benar

	    // Simpan file menggunakan file_put_contents
	    if (file_put_contents($filePath, $imageData)) {
	        // Simpan data gambar ke database jika diperlukan
	        $insertData = array(
	            'foto_wajah' => $fileName,  // Simpan nama file atau path file ke database
	            // Tambahkan kolom-kolom lain jika diperlukan
	        );
	        // $this->PM->insert_photo($insertData);

	        $insertedId = $this->PM->insert_photo($insertData); // Ambil ID yang baru saja dimasukkan


	        //cek user
			$ada_user = $this->db->get_where('tb_pelanggan', array('id_pelanggan' => $insertedId))->num_rows();
$user = $this->db->get_where('tb_pelanggan', array('id_pelanggan' => $insertedId))->row();

            // Simpan data ke session

            if ($ada_user>0) {
					$session_data = array(
		                'id_pelanggan'   => $user->id_pelanggan
		            );


	            //set session userdata
	            $this->session->set_userdata($session_data);
				echo"<script>
						window.alert('Anda Berhasil Login.!');
					</script>";

		        redirect('DaftarMenuController');
		        // print_r($this->session->flashdata('sweet_alert'));

	                
			}
	    } else {
	        // Handle error jika gagal menyimpan file
	        echo "Gagal menyimpan file.";
	    }
	}



}
