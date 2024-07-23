<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php
    // Jika ingin menampilkan nama hari dalam bahasa Indonesia
    $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    ?>

    <p class="mb-4">
        <marquee style="color: red;">
            <b><i>SELAMAT DATANG DI APLIKASI PEMESANAN MAKANAN INI. HARI INI TANGGAL <?= tgl_indo(date('Y-m-d')) ?> DAN HARI <?= $days[date('w')] ?></i></b>
        </marquee>
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">DATA TRANSAKSI PEMESANAN MAKANAN</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <form action="<?= base_url('Transaksi/proses_bayar') ?>" method="POST">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>PELANGGAN</th>
                                <th>JUMLAH PESANAN</th>
                                <th>TOTAL BELANJA</th>
                                <th>TANGGAL</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $tt='0';
                            foreach ($trx as $key => $value) {
                                $tt += $value->total_harga;
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><img src="<?= base_url("assets/images/pelanggan/$value->foto_wajah ") ?>" width="150px"></td>
                                <td><?= $value->jumlah_pesanan ?></td>
                                <td>Rp. <?= number_format($value->total_harga,2,',','.') ?></td>
                                <td><?= tgl_indo($value->tgl_trx) ?></td>
                                <td><?= $value->keterangan ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="3">TOTAL BELANJA</th>
                                <th colspan="3">Rp. <?= number_format($tt,2,',','.') ?>
                                    <input type="hidden" name="belanja" class="form-control" value="<?= $tt?>">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="6">
                                    <input type="checkbox" name="member" id="memberCheckbox" value="member"> Member
                                </th>
                            </tr>
                            <tr id="memberRow" class="hidden">
                                <th>MEMBER</th>
                                <th colspan="3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-arrow-right"></i> PILIH MEMBER
                                    </button>
                                    <span id="selectedMemberName" style="margin-left: 10px; font-weight: bold;"></span>
                                    <input type="hidden" id="selectedMemberId" name="idm" class="form-control" style="margin-left: 10px; display: inline-block; width: auto;">
                                </th>
                                <th>DISKON</th>
                                <th colspan="1">
                                    <select class="form-control" name="diskon" id="selectDiskon">
                                        <option value="">--PILIH DISKON--</option>
                                        <?php foreach ($diskon as $key => $value) { ?>
                                            <option value="<?= $value->diskon ?>"><?= $value->kd_diskon . ' | ' . $value->diskon . '%' ?></option>
                                        <?php } ?>
                                    </select>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="3">TOTAL BELANJA AKHIR</th>
                                <th id="nilaiSetelahDiskon">Rp. <?= number_format($tt,2,',','.') ?></th>
                                <th><input type="number" name="bayar" class="form-control" placeholder="0" id="bayar" oninput="hitungKembalian()"></th>
                                <th><input type="number" name="kembalian" class="form-control" placeholder="0" id="kembalian" readonly>
                                    <input type="hidden" name="id" class="form-control" value="<?= $id_trx ?>">
                                    <input type="hidden" id="inputNilaiSetelahDiskon" name="stlahdiskon" class="form-control"></th>
                            </tr>
                            <tr>
                                <th colspan="5">PROSES PEMBAYARAN</th>
                                <th><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> PEMBAYARAN</button></th>
                            </tr>
                        </tfoot>
                    </table>
                </form><input type="hidden" id="selected_member" class="form-control">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MEMBER LIST</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>DATA MEMBER</label>
            <select class="form-control" id="memberSelect">
                <option value="">--NAMA / NO HP / KODE--</option>
                <?php 
                    foreach ($member as $key => $value) {
                        echo"<option value='$value->id_member' data-name='$value->nm_member'>$value->nm_member".' | '. $value->no_hp. ' | '. $value->kd_member."</option>";
                    }
                 ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="selectMemberBtn"><i class="fa fa-check"></i> Pilih Member</button>
      </div>
    </div>
  </div>
</div>

<style>
    .hidden {
        display: none;
    }
</style>

<script>
    function hitungKembalian() {
        // Ambil nilai total belanja dari PHP dan ubah menjadi angka
        let totalBelanja = document.getElementById('inputNilaiSetelahDiskon').value;
        
        // Ambil nilai bayar dari input
        let bayar = document.getElementById('bayar').value;

        // Hitung kembalian
        let kembalian = bayar - totalBelanja;

        // Tampilkan kembalian di input kembalian
        document.getElementById('kembalian').value = kembalian;
    }

    document.getElementById('memberCheckbox').addEventListener('change', function() {
        var memberRow = document.getElementById('memberRow');
        if (this.checked) {
            memberRow.classList.remove('hidden');
        } else {
            memberRow.classList.add('hidden');
        }
    });

    document.getElementById('selectMemberBtn').addEventListener('click', function() {
        var memberSelect = document.getElementById('memberSelect');
        var selectedMember = memberSelect.value;
        var selectedMemberName = memberSelect.options[memberSelect.selectedIndex].getAttribute('data-name');
        
        document.getElementById('selected_member').value = selectedMember;
        document.getElementById('selectedMemberName').textContent = selectedMemberName;
        document.getElementById('selectedMemberId').value = selectedMember; // Set ID member to input
        $('#exampleModal').modal('hide');
    });


// NILAI DISKON
    var selectDiskon = document.getElementById('selectDiskon');
    var inputNilaiSetelahDiskon = document.getElementById('inputNilaiSetelahDiskon');
    var nilaiSetelahDiskonElem = document.getElementById('nilaiSetelahDiskon'); // Elemen untuk menampilkan nilai setelah diskon

    var totalBelanja = <?= $tt ?>;

    selectDiskon.addEventListener('change', function() {
        var diskon = parseFloat(this.value); // Konversi nilai diskon ke float
        if (!isNaN(diskon)) { // Periksa apakah diskon adalah angka yang valid
            var nilaiSetelahDiskon = totalBelanja * (1 - diskon / 100);
            // Bulatkan nilai setelah diskon ke bilangan bulat terdekat
            nilaiSetelahDiskon = Math.round(nilaiSetelahDiskon);

            // Tampilkan nilai setelah diskon dalam format rupiah di elemen <th>
            nilaiSetelahDiskonElem.textContent = formatRupiah(nilaiSetelahDiskon);

            // Set nilai input jika diperlukan
            inputNilaiSetelahDiskon.value = nilaiSetelahDiskon;
        } else {
            console.error("Nilai diskon tidak valid.");
        }
    });

    // Fungsi untuk mengubah angka menjadi format rupiah
    function formatRupiah(angka) {
        var bilangan = angka.toString().replace(/[^,\d]/g, '');
        var reverse = bilangan.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + ribuan + ',00';
    }
</script>