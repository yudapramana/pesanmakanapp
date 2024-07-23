<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 5px 0;
        }
        .table-container {
            margin: 20px auto;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }
        .table-container th {
            background-color: #f2f2f2;
        }
        .table-container td img {
            max-width: 80px;
            border-radius: 50%;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p>Tanggal: <?= date('d F Y') ?></p>
        <!-- Tambahkan informasi lain seperti nama toko, alamat, dll sesuai kebutuhan -->
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>PELANGGAN</th>
                    <th>MAKANAN</th>
                    <th>HARGA</th>
                    <th>JUMLAH</th>
                    <th>TOTAL HARGA</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$th='0'; $tj='0'; $tt='0';
                	foreach ($trx as $key => $value) { 
	                	$th += $value->harga;
	                	$tj += $value->jumlah;
	                	$tt += $value->total_belanja;

                	?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><img src="<?= base_url("assets/images/pelanggan/$value->foto_wajah") ?>" width='100px'></td>
                        <td><?= $value->nm_makanan ?></td>
                        <td>Rp. <?= number_format($value->harga,2,',','.') ?></td>
                        <td><?= $value->jumlah ?></td>
                        <td>Rp. <?= number_format($value->total_belanja,2,',','.') ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
            	<tr>
            		<td colspan="3">TOTAL</td>
            		<td>Rp. <?= number_format($th,2,',','.') ?></td>
            		<td><?= $tj ?></td>
            		<td>Rp. <?= number_format($tt,2,',','.') ?></td>
            	</tr>
            </tfoot>
        </table>
    </div>

    <div class="signature">
        <p>Disetujui oleh,</p>
        <br><br><br>
        <p>Nama Penanggung Jawab</p>
    </div>
</body>
</html>
