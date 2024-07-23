<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php
    // Jika ingin menampilkan nama hari dalam bahasa Indonesia
    $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
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
            <div class="col-md-2">&nbsp;</div>
            <div class=" col-md-8" style="border: 1px solid grey; border-radius: 5px; padding: 10px;">

                <div class="form-group">
                    <label"><center>DETAIL PESANAN</center></label>
                </div>

                <table class="table">
                    <tr>
                        <th style="width: 15%;">PELANGGAN</th>
                        <th>:</th>
                        <td><img src="<?= base_url("assets/images/pelanggan/$plg[foto_wajah]") ?>" style="width: 150px;"></td>
                    </tr>
                  <?php 
                    foreach ($trx as $key => $value) {
                  ?>
                    <tr>
                        <th style="width: 15%;">NAMA MAKANAN</th>
                        <th>:</th>
                        <td><?= $value->nm_makanan ?></td>
                    </tr>
                    <tr>
                        <th style="width: 15%;">&nbsp;</th>
                        <th></th>
                        <td><img src="<?= base_url("assets/images/produk/$value->gambar_produk") ?>" width="40%"></td>
                    </tr>
                    <tr>
                        <th>JUMLAH</th>
                        <th>:</th>
                        <td><?= $value->jumlah ?></td>
                    </tr>
                    <tr>
                        <th>TOTAL BELANJA</th>
                        <th>:</th>
                        <td>Rp. <?= number_format($value->total_belanja,2,',','.') ?></td>
                    </tr>
                    <tr>
                        <th>KETERANGAN</th>
                        <th>:</th>
                        <td><?= $value->keterangan ?></td>
                    </tr>
                <?php } ?>
                </table>


            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</div>
