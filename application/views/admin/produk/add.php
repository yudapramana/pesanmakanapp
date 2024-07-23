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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">DATA MAKANAN</h6>
        </div>

        <div class="card-body">
          <form class="form-horizontal form-label-left" action="<?= base_url('Produk/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">NAMA MAKANAN</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" name="nama" placeholder="Input Nama Makanan">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3">HARGA</label>
              <div class="col-md-3 col-sm-3">
                  <input class="form-control" id="harga" name="harga" placeholder="Harga Makanan" maxlength="14" 
                         oninput="formatRupiah(this)">
                  <small class="form-text text-muted">Maksimal 9 karakter wajib angka</small>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">KETERANGAN</label>
              <div class="col-md-9 col-sm-9 ">
                <textarea type="text" class="form-control" name="ket" placeholder="Keterangan" rows="5"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">STOK</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="text" name="stok" class="form-control col-md-10" placeholder="Stok Makanan" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5)">
                <small class="form-text text-muted">Maksimal 5 karakter wajib angka</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">GAMBAR MAKANAN</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="file" name="gambar" class="form-control">
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9  offset-md-3">
                <button type="reset" class="btn btn-primary"><i class="fa fa-retweet"></i> &nbsp; Reset</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> &nbsp;SIMPAN</button>
                <a href="<?= base_url('Produk') ?>" class="btn btn-warning float-right"><i class="fa fa-arrow-left"></i> &nbsp; Back</a>
              </div>
            </div>
          </form>
        </div>
    </div>

</div>


<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '').slice(0, 14); // Hanya angka dan maksimal 8 karakter
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
        input.value = value ? formatted.replace('IDR', '').trim() : ''; // Menghilangkan 'IDR' agar tetap angka saja
    }
</script>