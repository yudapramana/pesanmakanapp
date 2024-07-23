  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Menu Kami
        </h2>
      </div>
      <form action="<?= base_url('Pesan/Produk') ?>" method="POST">
        <div class="filters-content">
          <div class="row grid">

            <div class="col-sm-12 col-lg-12 all pizza">
              <div class="box">
                <div>
                  <div class="img-box">
                    <img src="<?= base_url("assets/images/produk/$produk[gambar_produk]") ?>" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      <?= $produk['nm_makanan'] ?>
                    </h5>
                    <p>
                      <?= $produk['ket'] ?>
                    </p>
                    <div class="options">
                      <h6>
                        Rp. <?= number_format($produk['harga'],2,',','.') ?>
                      </h6>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
        </div>
        <div class="btn-box">
          <div class="col-md-2 col-sm-8">
            <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="0" required="">
            <input type="hidden" name="id" class="form-control" value="<?= $produk['id_makanan'] ?>">
            <input type="hidden" name="pl" class="form-control" value="<?= $this->session->userdata('id_pelanggan') ?>">
          </div>
          <button type="submit" class="btn btn-warning btn-sm col-sm-3"><i class="fa fa-shopping-cart"></i>
            PESAN
          </button>
        </div>

      </form>
    </div>
  </section>

  <!-- end food section -->
<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var jumlahInput = document.getElementById('jumlah').value;
        if (jumlahInput == 0) {
            event.preventDefault();
            alert('Nilai tidak boleh 0');
        }
    });
</script>