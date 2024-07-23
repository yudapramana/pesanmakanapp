<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<?php
    $id = $this->uri->segment('3');
    // Jika ingin menampilkan nama hari dalam bahasa Indonesia
    $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $stts = $this->db->query("SELECT tdt.keterangan  FROM tb_transaksi tt LEFT JOIN tb_detail_transaksi tdt ON tt.id_trx=tdt.id_transaksi WHERE tdt.id_transaksi=$id GROUP BY tdt.id_transaksi")->row_array();
  ?>

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> -->
    <p class="mb-4"><marquee style="color: red;"><b><i>SELAMAT DATANG DI APLIKASI PEMESANAN MAKANAN INI. HARI INI TANGGAL <?= tgl_indo(date('Y-m-d')) ?> DAN HARI <?= $days[date('w')] ?></i></b></marquee></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">DATA TRANSAKSI PEMESANAN MAKANAN</h6>
        </div>

        <div class="card-body row">
            <div class="col-md-4">&nbsp;</div>
            <div class=" col-md-4" style="border: 1px solid grey; border-radius: 5px; padding: 10px;">
                <h4><label>KETERANGAN SAAT INI :</label> <button class="btn btn-primary btn-sm"> <?= $stts['keterangan'] ?></button><hr></h4>
                <form action="<?= base_url('Transaksi/aksi_proses') ?>" method="POST">
                    <div class="form-group">
                        <label>STATUS PROSES PESANAN</label>
                        <hr>
                        <?php 
                        if ($stts['keterangan']=='PESANAN SELESAI') {
                            echo "<center><button class='btn btn-success btn-sm'>PESANAN TELAH SELESAI. TIDAK ADA TINDAKAN YANG HARUS DI LAKUKAN.</button></center>";
                        }else{


                            if ($this->session->userdata('level_login')=='SUPERADMIN' OR $this->session->userdata('level_login')=='PEMILIK') {
                         ?>
                            <select class="form-control" name="status">
                                <option value="TERIMA PESANAN">1. TERIMA PESANAN</option>
                                <option value="SUDAH BAYAR">2. SUDAH BAYAR</option>
                                <option value="PESANAN SELESAI">3. PESANAN SELESAI</option>
                                <option value="PESANAN SEDANG DI ANTARKAN">4. PESANAN SEDANG DI ANTARKAN</option>
                            </select>
                            <input type="hidden" name="id" value="<?= $id_pelanggan ?>">
                        <?php }else if ( $this->session->userdata('level_login')=='KASIR'){  ?>
                             <select class="form-control" name="status">
                                <option value="TERIMA PESANAN">1. TERIMA PESANAN</option>
                                <option value="SUDAH BAYAR">2. SUDAH BAYAR</option>
                            </select>
                            <input type="hidden" name="id" value="<?= $id_pelanggan ?>">
                        <?php }else if ( $this->session->userdata('level_login')=='WAITER'){ ?>
                             <select class="form-control" name="status">
                                <option value="TERIMA PESANAN">1. TERIMA PESANAN</option>
                                <option value="PESANAN SEDANG DI ANTARKAN">2. PESANAN SEDANG DI ANTARKAN</option>
                            </select>
                            <input type="hidden" name="id" value="<?= $id_pelanggan ?>">
                        <?php }else if ( $this->session->userdata('level_login')=='KOKI'){ ?>
                             <select class="form-control" name="status">
                                <option value="TERIMA PESANAN">1. TERIMA PESANAN</option>
                                <option value="PESANAN SEDANG DIHIDANGKAN">2. PESANAN SEDANG DIHIDANGKAN</option>
                                <option value="PESANAN SIAP DIHIDANGKAN">3. PESANAN SIAP DIHIDANGKAN</option>
                            </select>
                            <input type="hidden" name="id" value="<?= $id_pelanggan ?>">
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" href="">Update</button>
                    </div>

                <?php } ?>

                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

</div>
