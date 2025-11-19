<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php'); // <-- Pastikan ada titik-koma
$db = new database();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang</title>
    <style>
        /* CSS Sederhana untuk print */
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        img { max-width: 80px; max-height: 80px; }
    </style>
</head>
<body onload="window.print()"> 
    <h2>LAPORAN DATA BARANG</h2>
    <table width="100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode Barang</th>
                <th width="20%">Barang</th>
                <th width="5%">Stok</th>
                <th width="15%">Harga Beli</th>
                <th width="15%">Harga Jual</th>
                <th width="10%">Keuntungan</th>
                <th width="15%">Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data_barang = $db->tampil_data();
            $no = 1; 
            foreach ($data_barang as $row) {
                $keuntungan = $row['harga_jual'] - $row['harga_beli'];
            ?>
                <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td><?php echo $row['kd_barang']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td style="text-align: center;"><?php echo $row['stok']; ?></td>
                    <td style="text-align: right;">Rp. <?php echo number_format($row['harga_beli']); ?></td>
                    <td style="text-align: right;">Rp. <?php echo number_format($row['harga_jual']); ?></td>
                    <td style="text-align: right;">Rp. <?php echo number_format($keuntungan); ?></td>
                    <td style="text-align: center;">
                        <?php if(!empty($row['gambar_produk']) && file_exists('gambar/'.$row['gambar_produk'])){ ?>
                            <img src="gambar/<?php echo $row['gambar_produk']; ?>" alt="Gambar">
                        <?php } else { echo 'N/A'; } ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>