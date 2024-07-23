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
          <a href="<?= base_url('Transaksi/tambah_data_diskon') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> &nbsp; DISKON</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>KODE DISKON</th>
                            <th>DISKON</th>
                            <th>TANGGAL CREATE</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO.</th>
                            <th>KODE DISKON</th>
                            <th>DISKON</th>
                            <th>TANGGAL CREATE</th>
                            <th>AKSI</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                            foreach ($diskon as $key => $value) {
                         ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><button class="btn btn-success" onclick="copyToClipboard('<?= $value->kd_diskon ?>')"><?= $value->kd_diskon ?></button></td>
                            <td><?= $value->diskon ?>%</td>
                            <td><?= tgl_indo($value->tgl_create_diskon) ?></td>
                            <td>
                                <a href="<?= base_url("Transaksi/edit_data_diskon/$value->id_diskon") ?>" title="Edit Diskon" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url("Transaksi/hapus_data_diskon/$value->id_diskon") ?>" title="Hapus Diskon" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data diskon ini?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    function copyToClipboard(text) {
        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Kode diskon telah disalin: ' + text);
    }
</script>