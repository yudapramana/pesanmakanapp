<!-- Begin Page Content -->
<div class="container-fluid">
<?php
// Jika ingin menampilkan nama hari dalam bahasa Indonesia
$days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
?>
<!-- Page Heading -->
<p class="mb-4"><marquee style="color: red;"><b><i>SELAMAT DATANG DI APLIKASI PEMESANAN MAKANAN INI. HARI INI TANGGAL <?= tgl_indo(date('Y-m-d')) ?> DAN HARI <?= $days[date('w')] ?></i></b></marquee></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <?= $this->session->flashdata('message'); ?>
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">DATA PELANGGAN</h6>
      
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>KODE PELANGGAN</th>
                        <th>GAMBAR</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>KODE PELANGGAN</th>
                        <th>GAMBAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        foreach ($pelanggan as $key => $value) {
                     ?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td>PLSC00G<?= $value->id_pelanggan ?></td>
                        <td><img src="<?= base_url("assets/images/pelanggan/$value->foto_wajah ") ?>" width="150px"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
