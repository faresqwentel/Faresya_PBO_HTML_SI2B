<?php
// edit_data.php (Nama file diganti agar sesuai konteks, aslinya edit_barang.php)

// 1. Menghubungkan ke file koneksi database
include('koneksi.php');

// 2. Membuat instance objek database
$db = new database();

// 3. Mengambil id_barang dari URL
$id_barang = $_GET['id_barang'];

// 4. Mengambil data barang yang akan diedit dari database
$data_edit_barang = $db->tampil_edit_data($id_barang);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
        <style type="text/css">
        form{
            /* background-border: 1px solid #47C0DB; (properti ini tidak valid, saya nonaktifkan) */
            margin: 0px 500px;
            color:black;
        }
        form#print_satuan{
            margin: 0px 250px;
            color:white;
        }
        .postdat_tombol{
            margin: 0px 200px;
        }
        .tombol_login{
            background: #47C0DB;
            color: white;
            font-size: 11pt;
            border: none;
            padding: 5px 20px;
        }
    </style>
    <style type="text/css">
        body {
            font-family: "Trebuchet MS";
        }
        h1, h3 { /* Menambahkan h3 agar konsisten */
            text-transform: uppercase;
            color: #47C0DB;
        }
        table {
            border: 1px solid #DEE5E7;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%; 
            margin: 10px auto 10px auto;
        }
        /* Style dari gambar untuk thead (meskipun tidak ada di form ini) */
        table thead th {
            background-color: #DDEFEF;
            border: 1px solid #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
            text-decoration: none;
        }
        table tbody td {
            border: 1px solid #DEE5E7;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
        a { 
            background-color: #47C0DB;
            color: #FFF;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
        }
    </style>
</head>
<body>
        <center><h3>Form Edit Data Barang</h3></center>

        <form method="post" action="proses_barang.php?action=edit&id_barang=<?php echo $id_barang; ?>" enctype="multipart/form-data">
        <table align="center">             <?php foreach ($data_edit_barang as $d) { ?>
                <tr>
                    <td>Kode Barang</td>
                    <td>
                        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
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
                        <img src="gambar/<?php echo $d['gambar_produk']; ?>" style="width:120px; float:left; margin-bottom:5px;">
                        <input type="file" name="gambar_produk" />
                        <p style="color:red; font-size:11px;">Abaikan jika tidak merubah gambar produk</p>
                    </td>
                </tr>
                                <tr>
                    <td></td>
                    <td>
                                                <input type="submit" name="tombol" value="Ubah" class="tombol_login">
                                                <a href="tampil.php">Kembali</a>
                    </td>
                </tr>
s          <?php } ?>
        </table>
    </form>
</body>
</html>