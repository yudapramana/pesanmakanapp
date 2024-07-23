<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rekap Laporan Pengusulan Penerimaan Bibit</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }
    .kop-surat {
        text-align: center;
        margin-bottom: 10px;
    }
    .kop-surat .garis {
        border-bottom: 5px solid black;
        margin: 10px 0 5px 0; /* Mengatur jarak atas dan bawah garis */
    }
    .kop-surat table {
        width: 100%;
        border: none;
        margin-bottom: 10px;
    }
    .kop-surat td {
        vertical-align: middle;
        padding: 0 10px;
    }
    .kop-surat .logo img {
        width: 120px; /* Sesuaikan ukuran logo */
        height: auto;
    }
    .table, .siswa, .kehadiran {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }

    .table, .table th, .table td {
        border: 1px solid black;
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }
    .table th {
        padding: 8px;
        text-align: center;
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }
    .table td {
        padding: 8px;
        text-align: left;
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }
    .footer {
        width: 100%;
        margin-top: 20px;
        /*border: 1px solid black;*/
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }
    .footer td:nth-child(1) {
        width: 20%;
        text-align: center;
        vertical-align: top;
    }
    .footer td:nth-child(2) {
        width: 30%;
        text-align: center;
        vertical-align: top;
    }
    .footer td:nth-child(3) {
        width: 30%;
        vertical-align: top;
    }
    .footer td:nth-child(4) {
        width: 20%;
        text-align: center;
        vertical-align: top;
    }

    .sikap, textarea {
        width: 100%;
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }
    .sikap td:first-child {
        width: 1%;
        text-align: left;
        vertical-align: top;
    }
    h1, h2, h3, h4 {
        margin: 0;
    }
    h1 {
        font-size: 28px;
    }
    h2 {
        font-size: 15px;
    } 
    h3 {
        font-size: 12px;
    }
    h4 {
        font-size: 9px;
    }
    .no-border td {
        border: none;
    }

    .kehadiran, .kehadiran th, .kehadiran td {
        border: 1px solid black;
        font-size: 11px; /* Ukuran font untuk elemen tabel */
    }
    .kehadiran td:nth-child(4) {
        text-align: right;
    }
    .kehadiran td:nth-child(3) {
        text-align: right;
        width: 10%;
    }

</style>
    <?php 
      $now = date('Y');
      $late = $now - 1;

     ?>
</head>
<body onload="print()">
    <div class="kop-surat">
        <table>
            <tr>
                <td class="logo"><img src="<?= base_url('assets/images/sumbar.png') ?>" alt="Logo"></td>
                <td>
                    <h2>DATA REKAP NAMA PENGUSULAN PENERIMA BANTUAN BIBIT</h2>
                    <h1>NAGARI GURUN PANJANG BARAT</h1>
                    <h3>KECAMATAN BAYANG KABUPATEN PESISIR SELATAN <br>PROVINSI SUMATERA BARAT</h3>
                    
                </td>
                <td class="logo"><img src="<?= base_url('assets/images/logo_pessel.png') ?>" alt="Logo"></td>
            </tr>
            <tr>
              <td colspan="3">
                <h4>Gurun Panjang Barat
					Kecamatan Bayang Kabupaten Pesisir Selatan Provinsi Sumatera Barat
                   Kode Pos : 25652 </h4>
                <h4>Email : -</h4></td>
            </tr>
        </table>
        <div class="garis"></div>
    </div>

    <center><b>LAPORAN NILAI SISWA</center>
    
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
      <tr>
      	<td style="width: 1%;">NO.</td>
        <td>NAMA</td>
        <td>NIK</td>
        <td>NO HANDPHONE</td>
        <td>ALAMAT</td>
        <td>KTP</td>
        <td>SERTIFIKAT</td>
      </tr>
      <?php 
      	foreach ($report as $key => $value) {
       ?>
      <tr style="vertical-align: top;">
        <td><?= $key+1 ?></td>
        <td><?= $value->nama ?></td>
        <td><?= $value->nik ?></td>
        <td><?= $value->no_hp ?></td>
        <td><?= $value->alamat ?></td>
        <td align="center"><img src="<?= base_url("assets/images/ktp/$value->ktp") ?>" style="width: 100px;"></td>
        <td align="center"><img src="<?= base_url("assets/images/sertifikat/$value->sertifikat_sawah") ?>" style="width: 100px;"></td>
      </tr>
  	  <?php } ?>
    </table>

    <?php 
        $wali = $this->db->query("SELECT * FROM tb_wali")->row_array();

     ?>

    <table class="footer" border="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>Nagari Gurun Pajang Barat, <?= tgl_indo(date('Y-m-d')) ?></td>
      </tr>
      <tr>
        <td>Ketua Tani</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>Wali Nagari</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td>(........................................)</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><u><?= $wali['nama_wali'] ?></u> <br>NIP. <?= $wali['nip'] ?></td>
      </tr>
    </table>
</body>
</html>
