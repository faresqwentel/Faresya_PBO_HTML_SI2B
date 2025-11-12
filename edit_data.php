<?php
include('koneksi.php'); [cite: 973]
$db = new database(); [cite: 974]
$id_barang = $_GET['id_barang']; [cite: 975]
$data_edit_barang = $db->tampil_edit_data($id_barang); [cite: 976]
?>
<!DOCTYPE html> [cite: 977]
<html>
<head> [cite: 979]
    <title>Edit Data</title> [cite: 981]
    <style type="text/css"> [cite: 983, 1056]
        /* (Bisa menggunakan CSS yang sama dengan tampil.php) */
        * { font-family: "Trebuchet MS"; } [cite: 1059]
        h3 { text-transform: uppercase; color: #47C6DB; } [cite: 1068, 1071]
        table { width: 40%; margin: 10px auto; } [cite: 1092, 1096]
        .tombol_login { background: #47C6DB; color: white; font-size: 11pt; border: none; padding: 5px 20px; } [cite: 1027, 1028, 1032, 1034, 1036, 1040]
        a { background-color: #47C6DB; color: #fff; padding: 7px; text-decoration: none; font-size: 12px; } [cite: 998, 999, 1000, 1001, 1002]
    </style> [cite: 1003, 1052]
</head>
<body> [cite: 1004]
    <center><h3>Form Edit Data Barang</h3></center> [cite: 1005]
    <hr/> [cite: 1006]
    
    <form method="post" action="proses_barang.php?action=edit" enctype="multipart/form-data"> [cite: 1007]
        <?php
        foreach ($data_edit_barang as $d) { [cite: 1012]
        ?>
        <table width="40%"> [cite: 1019, 1092]
            <tr>
                <td>Kode Barang</td> [cite: 1044]
                <td>:</td> [cite: 1045]
                <td>
                    <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>"> [cite: 1047]
                    <input type="text" name="kd_barang" value="<?php echo $d['kd_barang']; ?>" readonly/> [cite: 1048]
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td> [cite: 1049]
                <td>:</td> [cite: 1038]
                <td><input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>" required/></td> [cite: 1051]
            </tr>
            <tr>
                <td>Stok</td> [cite: 1057]
                <td>:</td> [cite: 1058]
                <td><input type="text" name="stok" value="<?php echo $d['stok']; ?>" required/></td> [cite: 1061]
            </tr>
            <tr>
                <td>Harga Beli</td> [cite: 1069]
                <td>:</td> [cite: 1073]
                <td><input type="text" name="harga_beli" value="<?php echo $d['harga_beli']; ?>" required/></td> [cite: 1077]
            </tr>
            <tr>
                <td>Harga Jual</td> [cite: 1087]
                <td>:</td> [cite: 1090]
                <td><input type="text" name="harga_jual" value="<?php echo $d['harga_jual']; ?>" required/></td> [cite: 1094]
            </tr>
            <tr>
                <td>Gambar Barang</td> [cite: 1104]
                <td>:</td> [cite: 1106]
                <td>
                    <img src="gambar/<?php echo $d['gambar_produk']; ?>" style="width: 120px; float: left; margin-bottom: 5px;"> [cite: 1114]
                    <input type="file" name="gambar_produk"> [cite: 1110]
                    <p style="float: left; font-size: 11px; color: red">Abaikan jika tidak merubah gambar produk</p> [cite: 1117]
                </td>
            </tr>
            <tr>
                <td></td> [cite: 1150]
                <td></td> [cite: 1151]
                <td>
                    <input type="submit" class="tombol_login" name="tombol" value="Ubah"/> [cite: 1152]
                    [cite_start]<a href="tampil.php">Kembali</a> [cite: 1152, 1155]
                [cite_start]</td> [cite: 1154]
            </tr>
        [cite_start]</table> [cite: 1159]
        <?php
        }
        ?>
    [cite_start]</form> [cite: 1165]
[cite_start]</body> [cite: 1167]
[cite_start]</html> [cite: 1169]