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
      <a href="<?= base_url('Pelanggan/tambah_data') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> &nbsp; MEMBER</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>NOMOR HANDPHONE</th>
                        <th>JENIS KELAMIN</th>
                        <th>TANGGAL CREATE</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NO.</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>NOMOR HANDPHONE</th>
                        <th>JENIS KELAMIN</th>
                        <th>TANGGAL CREATE</th>
                        <th>AKSI</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        foreach ($member as $key => $value) {
                     ?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= $value->nm_member ?></td>
                        <td><?= $value->alamat ?></td>
                        <td><?= $value->no_hp ?></td>
                        <td><?= $value->jk_member ?></td>
                        <td><?= tgl_indo($value->tgl_create_member) ?></td>
                        <td>
                            <a href="<?= base_url("Pelanggan/edit_data/$value->id_member") ?>" title="Edit Member" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url("Pelanggan/hapus_data/$value->id_member") ?>" title="Hapus Member" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
