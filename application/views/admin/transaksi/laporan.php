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
            <div class=" col-md-6" style="border: 1px solid grey; border-radius: 5px; padding: 10px;">

                <form action="<?= base_url('Transaksi/report') ?>" method="POST">
                    <div class="form-group">
                        <label>LAPORAN TRANSAKSI PESANAN</label>
                        <hr>
                        <div class="date-container">
                            <input type="date" name="awal" class="form-control">
                            <input type="date" name="sampai" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Print</button>
                    </div>

                </form>
            </div>
            <div class=" col-md-6" style="border: 1px solid grey; border-radius: 5px; padding: 10px;">

                <form action="<?= base_url('Transaksi/report_pembayaran') ?>" method="POST">
                    <div class="form-group">
                        <label>LAPORAN TRANSAKSI PEMBAYARAN</label>
                        <hr>
                        <div class="date-container">
                            <input type="date" name="awal" class="form-control">
                            <input type="date" name="sampai" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit"><i class="fa fa-print"></i> Print</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
<style>
    .date-container {
        display: flex;
        justify-content: space-between;
    }
    .date-container input {
        width: 48%;
    }
</style>