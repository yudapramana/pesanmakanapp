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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">FORM PENAMBAHAN DISKON</h6>
        </div>

        <div class="card-body">
          <form class="form-horizontal form-label-left" action="<?= base_url('Transaksi/proses_tambah_diskon') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 text-center">DISKON</label>
              <div class="col-md-2 col-sm-2 input-container">
                <input type="number" class="form-control" name="diskon" placeholder="DISKON MAKANAN">
                <span>%</span>
              </div>
            </div>

            <div class="ln_solid"><hr></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9  offset-md-3">
                <button type="reset" class="btn btn-primary"><i class="fa fa-retweet"></i> &nbsp; Reset</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> &nbsp;SIMPAN</button>
                <a href="<?= base_url('Transaksi/diskon') ?>" class="btn btn-warning float-right"><i class="fa fa-arrow-left"></i> &nbsp; Back</a>
              </div>
            </div>
          </form>
        </div>
    </div>

</div>



<style>
    .input-container {
        display: flex;
        align-items: center;
    }
    .input-container input {
        border-radius: 4px 0 0 4px;
        border-right: none;
    }
    .input-container span {
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        border-radius: 0 4px 4px 0;
        background-color: #e9ecef;
        border-left: none;
    }
</style>