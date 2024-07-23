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
          <h6 class="m-0 font-weight-bold text-primary">FORM PENAMBAHAN MEMBER</h6>
        </div>

        <div class="card-body">
          <form class="form-horizontal form-label-left" action="<?= base_url('pelanggan/proses_ubah') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">NAMA LENGKAP</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="hidden" class="form-control" name="id" placeholder="NAMA LENGKAP" value="<?= $member['id_member'] ?>">
                <input type="text" class="form-control" name="nama" placeholder="NAMA LENGKAP" value="<?= $member['nm_member'] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">ALAMAT</label>
              <div class="col-md-9 col-sm-9 ">
                <textarea type="text" class="form-control" name="alamat" placeholder="ALAMAT" rows="5"><?=  $member['alamat'] ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3">NOMOR HANDPHONE</label>
              <div class="col-md-3 col-sm-3">
                  <input type="number" class="form-control" name="nohp" placeholder="0812xxxxxx" value="<?=  $member['no_hp'] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3">JENIS KELAMIN</label>
              <div class="col-md-3 col-sm-3">
                <?php 
                  if ($member['jk_member']=='Laki-Laki') { ?>
                    <input type="radio" name="jk" value="Laki-Laki" checked=""> LAKI-LAKI &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="jk" value="Perempuan"> PEREMPUAN
                <?php  }else if ($member['jk_member']=='Perempuan') { ?>
                    <input type="radio" name="jk" value="Laki-Laki"> LAKI-LAKI &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="jk" value="Perempuan" checked=""> PEREMPUAN
                <?php  }

                 ?>
                  
              </div>
            </div>

            <div class="ln_solid"><hr></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9  offset-md-3">
                <button type="reset" class="btn btn-primary"><i class="fa fa-retweet"></i> &nbsp; Reset</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> &nbsp;UPDATE</button>
                <a href="<?= base_url('Pelanggan/member') ?>" class="btn btn-warning float-right"><i class="fa fa-arrow-left"></i> &nbsp; Back</a>
              </div>
            </div>
          </form>
        </div>
    </div>

</div>