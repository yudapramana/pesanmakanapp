
  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="heading_container heading_center">
        <h2>
          Pesanan
        </h2>
        <hr>
      </div>
        <div class="row">
          
          <div class="table-responsive">
            <form action="<?= base_url("Pesan/cek_out") ?>" method="POST">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th>NO.</th>
                      <th>NAMA MAKANAN</th>
                      <th>GAMBAR</th>
                      <th>JUMLAH</th>
                      <th>HARGA</th>
                      <th>TOTAL HARGA</th>
                      <th>AKSI</th>
                    </tr>
                    <?php 
                      $tot_p ='0'; $tot_h ='0'; $tot_ht ='0';
                      foreach ($keranjang as $key => $value) {
                        $totalharga = $value->harga * $value->jumlah;
                        $tot_p += $value->jumlah;
                        $tot_h += $value->harga;
                        $tot_ht += $totalharga;
                     ?>
                    <tr>
                      <td><?= $key+1; ?></td>
                      <td><?= $value->nm_makanan ?></td>
                      <td><img src="<?= base_url("assets/images/produk/$value->gambar_produk") ?>" width='100px'></td>
                      <td><?= $value->jumlah ?></td>
                      <td>Rp. <?= number_format($value->harga,2,',','.') ?></td>
                      <td>Rp. <?= number_format($totalharga,2,',','.') ?></td>
                      <td><a href="<?= base_url("Pesan/hapus_keranjang/$value->id_keranjang") ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin mengapus belanja ini..?');"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="3">Total Belanja</td>
                    <td><?= $tot_p ?></td>
                    <td>Rp. <?= number_format($tot_h,2,',','.') ?></td>
                    <td>Rp. <?= number_format($tot_ht,2,',','.') ?></td>
                    <td><button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</button></td>
                  </tr>
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
