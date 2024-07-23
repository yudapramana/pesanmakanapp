<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php
    // Jika ingin menampilkan nama hari dalam bahasa Indonesia
    $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
  ?>

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> -->
    <p class="mb-4"><marquee style="color: red;"><b><i>SELAMAT DATANG DI APLIKASI INI. HARI INI TANGGAL <?= tgl_indo(date('Y-m-d')) ?> DAN HARI <?= $days[date('w')] ?></i></b></marquee></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">DATA PENGGUNA APLIKASI</h6>
          <a href="<?= base_url('Pengguna/tambah_data') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> PENGGUNA</a>
          
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>LEVEL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO.</th>
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>LEVEL</th>
                            <th>AKSI</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                            foreach ($pengguna as $key => $value) {
                         ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value->nm_user ?></td>
                            <td><?= $value->username ?></td>
                            <td><?= $value->password ?></td>
                            <td><?= $value->level ?></td>
                            <td>
                                <a href="<?= base_url("Pengguna/edit_data/$value->id_user") ?>" title="Edit Produk" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url("Pengguna/hapus_data/$value->id_user") ?>" title="Hapus Produk" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
