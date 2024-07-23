
  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="heading_container heading_center">
        <h2>
          Antrian Pesanan
        </h2>
        <hr>
      </div>
        <div class="row">
          
          <div class="table-responsive">
            <form action="<?= base_url("Pesan/cek_out") ?>" method="POST">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th>NO.</th>
                      <th>GAMBAR</th>
                      <th>JUMLAH</th>
                      <th>MAKANAN</th>
                      <th>KETERANGAN</th>
                      <th>WAKTU</th>
                    </tr>
                    <?php 
                      foreach ($pesanan as $key => $value) {
                        $id_p = $value->id_trx;
                        $produk = $this->db->query("SELECT
                           * FROM tb_detail_transaksi tbt LEFT JOIN tb_produk_makanan tpm ON tbt.id_makanan=tpm.id_makanan WHERE tbt.id_transaksi=$id_p")->result();
                     ?>
                    <tr>
                      <td><?= $key+1; ?></td>
                      <td><img src="<?= base_url("assets/images/pelanggan/$value->foto_wajah") ?>" width='100px'></td>
                      <td><?= $value->jumlah_pesanan ?></td>
                      <td>
                        <?php 
                          foreach ($produk as $key => $m) {
                            echo $m->nm_makanan.'<br>';
                          }
                         ?>

                      </td>
                      <td><?= $value->keterangan ?></td>
                      <td><?= indo($value->tgl_trx) ?></td>
                    </tr>
                  <?php } ?>
                  </table>
                </form>
                
              </div>
        </div>

        <div class="btn-box">
          <a href="<?= base_url("DaftarMenuController") ?>" class="btn btn-success btn-sm col-sm-3"><i class="fa fa-shopping-cart"></i>
            Lihat Makanan
          </a>
        </div>
      </div>
    </div>
  </section>
<?php
  function indo($tanggal) {
      // Memisahkan tanggal dan waktu
      $tanggal_waktu = explode(' ', $tanggal);
      if (count($tanggal_waktu) != 2) {
          return $tanggal; // Jika format tidak sesuai, kembalikan nilai asli
      }

      $tanggal_saja = $tanggal_waktu[0];
      $waktu_saja = $tanggal_waktu[1];

      // Memisahkan komponen tanggal
      $tgl = explode('-', $tanggal_saja);
      if (count($tgl) != 3) {
          return $tanggal; // Jika format tidak sesuai, kembalikan nilai asli
      }

      $tahun = $tgl[0];
      $bulan = $tgl[1];
      $hari = $tgl[2];

      // Daftar nama bulan dalam bahasa Indonesia
      $nama_bulan = array(
          '01' => 'Januari',
          '02' => 'Februari',
          '03' => 'Maret',
          '04' => 'April',
          '05' => 'Mei',
          '06' => 'Juni',
          '07' => 'Juli',
          '08' => 'Agustus',
          '09' => 'September',
          '10' => 'Oktober',
          '11' => 'November',
          '12' => 'Desember'
      );

      // Menggabungkan komponen tanggal dalam format Indonesia
      $tanggal_indo = $hari . ' ' . $nama_bulan[$bulan] . ' ' . $tahun;

      // Menggabungkan kembali tanggal dan waktu
      return $tanggal_indo . ' - ' . $waktu_saja;
  }
?>

