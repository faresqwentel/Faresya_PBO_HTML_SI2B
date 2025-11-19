<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php'); // <-- Pastikan ada titik-koma
$db = new database();

// Ambil ID dari URL
$id_barang = $_GET['id_barang'];
if(empty($id_barang)){
    header('location:tampil_barang.php');
}

// Ambil data barang yang mau diedit
$data_edit_barang = $db->tampil_edit_data($id_barang);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
</head>
<body>
    <h3>Form Edit Data Barang</h3>

    <form method="post" action="proses_barang.php?action=edit&id_barang=<?php echo $id_barang; ?>" enctype="multipart/form-data">
        <table>
            <?php foreach ($data_edit_barang as $d) { ?>
                <tr>
                    <td>Kode Barang</td>
                    <td>
                        <input type="text" name="kd_barang" value="<?php echo $d['kd_barang']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td><input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>"></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="text" name="stok" value="<?php echo $d['stok']; ?>"></td>
                </tr>
                <tr>
                    <td>Harga Beli</td>
                    <td><input type="text" name="harga_beli" value="<?php echo $d['harga_beli']; ?>"></td>
                </tr>
                <tr>
                    <td>Harga Jual</td>
                    <td><input type="text" name="harga_jual" value="<?php echo $d['harga_jual']; ?>"></td>
                </tr>
                <tr>
                    <td>Gambar Produk</td>
                    <td>
                        <?php if(!empty($d['gambar_produk']) && file_exists('gambar/'.$d['gambar_produk'])) { ?>
                            <img src="gambar/<?php echo $d['gambar_produk']; ?>" width="100"> <br>
                        <?php } else { echo "Tidak ada gambar.<br>"; } ?>
                        
                        <input type="file" name="gambar_produk" />
                        <small style="color:red">Abaikan jika tidak ingin mengubah gambar</small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Ubah">
                        <a href="tampil_barang.php"><button type="button">Kembali</button></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </form>
</body>
</html>