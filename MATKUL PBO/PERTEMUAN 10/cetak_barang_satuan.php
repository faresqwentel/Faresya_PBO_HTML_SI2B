<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php');
$db = new database();

$id_barang = $_GET['id_barang'];
if(empty($id_barang)){
    echo "ID Barang tidak ditemukan."; exit;
}
$data_barang = $db->tampil_edit_data($id_barang);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Barang</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; font-size: 14px; }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Detail Data Barang</h2>
    <hr/>
    <?php foreach($data_barang as $d) { ?>
        <table>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td><strong><?php echo $d['kd_barang']; ?></strong></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><strong><?php echo $d['nama_barang']; ?></strong></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><?php echo $d['stok']; ?> Pcs</td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td>Rp. <?php echo number_format($d['harga_beli']); ?></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td>Rp. <?php echo number_format($d['harga_jual']); ?></td>
            </tr>
            <tr>
                <td>Keuntungan</td>
                <td>:</td>
                <td>Rp. <?php echo number_format($d['harga_jual'] - $d['harga_beli']); ?></td>
            </tr>
        </table>
    <?php } ?>
</body>
</html>