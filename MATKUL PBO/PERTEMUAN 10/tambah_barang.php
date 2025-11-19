<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}
include('koneksi.php'); // <-- Pastikan ada titik-koma
$db = new database();

// Logika untuk membuat kode barang otomatis
$kode_data = $db->kode_barang();
$kode_barang_terakhir = $kode_data[0]['kd_barang'] ?? null;
$kode_barangbaru = 'BRG001';

if($kode_barang_terakhir){
    $nomor_urut = (int) substr($kode_barang_terakhir, 3, 3);
    $nomor_urut++;
    $kode_barangbaru = "BRG".str_pad($nomor_urut, 3, "0", STR_PAD_LEFT);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
</head>
<body>
    <center><h3>Form Tambah Data Barang</h3></center>
    
    <form method="post" action="proses_barang.php?action=add" enctype="multipart/form-data">
        <table align="center" width="40%">
            <tr>
                <td>Kode Barang</td>
                <td><input type="text" name="kd_barang" value="<?php echo $kode_barangbaru; ?>" readonly/></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td><input type="text" name="nama_barang" placeholder="Nama Barang" required/></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="number" name="stok" placeholder="Stok" required/></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td><input type="number" name="harga_beli" placeholder="Harga Beli" required/></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td><input type="number" name="harga_jual" placeholder="Harga Jual" required/></td>
            </tr>
            <tr>
                <td>Gambar Produk</td>
                <td>
                    <input type="file" name="gambar_produk" required="required"/>
                    <p style="color: red; font-size: 11px;">Ekstensi yang diperbolehkan .png | .jpg | .jpeg</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Simpan"/>
                    <a href="tampil_barang.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>