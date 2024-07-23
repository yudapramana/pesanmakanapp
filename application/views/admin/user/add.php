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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">DATA PENGGUNA APLIKASI</h6>
        </div>

        <div class="card-body">
          <form class="form-horizontal form-label-left" action="<?= base_url('Pengguna/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">NAMA</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" name="nama" placeholder="NAMA PENGGUNA">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3">USERNAME</label>
              <div class="col-md-3 col-sm-3">
                  <input class="form-control" name="username" placeholder="USERNAME">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">PASSWORD</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="password" class="form-control" name="pass" placeholder="PASSWORD">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">LEVEL</label>
              <div class="col-md-3 col-sm-3 ">
                <select type="text" name="level" class="form-control col-md-10">
                  <option value="">--PILIH LEVEL--</option>
                  <?php 
                    $no=1;
                    foreach ($level as $key => $level) {
                      echo"<option value='$level->nm_level'>".$no.'. '."$level->nm_level</option>";
                      $no++;
                    }
                   ?>
                </select>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9  offset-md-3">
                <button type="reset" class="btn btn-primary"><i class="fa fa-retweet"></i> &nbsp; Reset</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> &nbsp;SIMPAN</button>
                <a href="<?= base_url('Pengguna') ?>" class="btn btn-warning float-right"><i class="fa fa-arrow-left"></i> &nbsp; Back</a>
              </div>
            </div>
          </form>
        </div>
    </div>

</div>
