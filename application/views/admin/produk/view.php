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
          <h6 class="m-0 font-weight-bold text-primary">DATA MAKANAN</h6>
          <a href="<?= base_url('Produk/tambah_data') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> MAKANAN</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>NAMA MAKANAN</th>
                            <th>KETERANGAN</th>
                            <th>STOK</th>
                            <th>HARGA</th>
                            <th>GAMBAR</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO.</th>
                            <th>NAMA MAKANAN</th>
                            <th>KETERANGAN</th>
                            <th>STOK</th>
                            <th>HARGA</th>
                            <th>GAMBAR</th>
                            <th>AKSI</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                            foreach ($produk as $key => $value) {
                         ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value->nm_makanan ?>
                                <?php 
                                    if ($value->best_seller=='aktif') { ?>
                                <img src="<?= base_url("assets/images/best.png") ?>" width="70px">
                            <?php } ?>
                            </td>
                            <td><?= $value->ket ?></td>
                            <td><?= $value->stok ?></td>
                            <td>Rp. <?= number_format($value->harga,2,',','.') ?></td>
                            <td><img src="<?= base_url("assets/images/produk/$value->gambar_produk ") ?>" width="150px"></td>
                            <td>
                                <a href="<?= base_url("Produk/edit_data/$value->id_makanan") ?>" title="Edit Makanan" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url("Produk/hapus_data/$value->id_makanan") ?>" title="Hapus Makanan" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="fa fa-trash"></i></a>
                                <?php 
                                    if ($value->best_seller=='aktif') { ?>
                                        <a href="<?= base_url("Produk/hapus_best_seller/$value->id_makanan") ?>" title="Hapus Makanan" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin menjadikan produk ini BEST SELLER?')"><i class="fa fa-arrow-right"></i> BEST SELLER</a>
                                <?php }else if ($value->best_seller=='') { ?>
                                        <a href="<?= base_url("Produk/best_seller/$value->id_makanan") ?>" title="Hapus Makanan" class="btn btn-primary btn-sm" onclick="return confirm('Apakah Anda yakin ingin menjadikan produk ini BEST SELLER?')"><i class="fa fa-arrow-right"></i> BEST SELLER</a>
                                <?php } ?>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
