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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>PELANGGAN</th>
                            <th>JUMLAH PESANAN</th>
                            <th>TOTAL BELANJA</th>
                            <th>TANGGAL</th>
                            <th>KETERANGAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                            $tt='0';
                            foreach ($trx as $key => $value) {
                                $tt += $value->total_harga;
                         ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><img src="<?= base_url("assets/images/pelanggan/$value->foto_wajah ") ?>" width="150px"></td>
                            <td><?= $value->jumlah_pesanan ?></td>
                            <td>Rp. <?= number_format($value->total_harga,2,',','.') ?></td>
                            <td><?= tgl_indo($value->tgl_trx) ?></td>
                            <td><?= $value->keterangan ?></td>
                            <td>
                                <a href="<?= base_url("Transaksi/detail/$value->id_trx") ?>" title="Edit Makanan" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                <?php if ($value->keterangan=='PESANAN SELESAI') {
                                    # code...
                                }else{ ?>
                                <a class="btn btn-success btn-sm" href="<?= base_url("Transaksi/proses/$value->id_trx") ?>" title="PROSES MAKNAN"><i class="fa fa-arrow-right"></i> Proses
                                </a>
                                <?php }

                                if ($value->keterangan=='SUDAH BAYAR' OR $value->keterangan=='PESANAN SELESAI') {
                                    # code...
                                }else{ 
                                    if ($this->session->userdata('level_login')=='KASIR'){ 
                                    ?>
                                    <a class="btn btn-info btn-sm" href="<?= base_url("Transaksi/bayar/$value->id_trx") ?>"><i class="fa fa-credit-card"></i> PEMBAYARAN</a>
                                <?php } } ?>

                            </td>
                        </tr>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <th colspan="3">TOTAL</th>
                                <th colspan="4">Rp. <?= number_format($tt,2,',','.') ?></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>