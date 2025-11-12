<?php
include('koneksi.php'); [cite: 773]
$db = new database(); [cite: 774, 776]

// Logika untuk auto-generating Kode Barang [cite: 785-799]
$kode_barang_data = $db->kode_barang(); [cite: 786]
$kode_barang_baru = 'BRG001'; // Default jika tabel kosong
if($kode_barang_data){
    foreach ($kode_barang_data as $row) { [cite: 789]
        $kode_max = $row['kd_barang']; [cite: 792]
        if ($kode_max) {
            $urutan = (int) substr($kode_max, 3, 3);
            $urutan++;
            $huruf = "BRG";
            $kode_barang_baru = $huruf . sprintf("%03s", $urutan);
        }
    }
}
?>
<!DOCTYPE html> [cite: 777]
<html>
<head> [cite: 787]
    <title>Tambah Data</title> [cite: 791]
    <style type="text/css"> [cite: 793, 857, 970]
        /* (Bisa menggunakan CSS yang sama dengan tampil.php) */
        * { font-family: "Trebuchet MS"; } [cite: 859]
        h3 { text-transform: uppercase; color: #47C6DB; } [cite: 868, 870]
        table { width: 40%; margin: 10px auto; } [cite: 887, 889]
        .tombol_login { background: #47C6DB; color: white; font-size: 11pt; border: none; padding: 5px 20px; } [cite: 828, 831, 835, 839, 842, 845]
        a { background-color: #47C6DB; color: #fff; padding: 7px; text-decoration: none; font-size: 12px; } [cite: 961, 964, 965, 966, 969]
    </style>
</head>
<body> [cite: 781]
    <h3><center>Form Tambah Data Barang</center></h3> [cite: 783]
    <hr/> [cite: 784]
    <form method="post" action="proses_barang.php?action=add" enctype="multipart/form-data"> [cite: 913]
        <table width="40%"> [cite: 806, 887]
            <tr>
                <td width="40%">Kode Barang</td> [cite: 914]
                <td width="2%">:</td> [cite: 915]
                <td width="58%"><input type="text" name="kd_barang" value="<?php echo $kode_barang_baru; ?>" readonly/></td> [cite: 916]
            </tr>
            <tr>
                <td>Nama Barang</td> [cite: 917]
                <td>:</td> [cite: 918]
                <td><input type="text" name="nama_barang" placeholder="Nama Barang" required/></td> [cite: 919]
            </tr>
            <tr>
                <td>Stok</td> [cite: 920]
                <td>:</td> [cite: 921]
                <td><input type="text" name="stok" placeholder="Stok" required/></td> [cite: 922]
            </tr>
            <tr>
                <td>Harga Beli</td> [cite: 923]
                <td>:</td> [cite: 924]
                <td><input type="text" name="harga_beli" placeholder="Harga Beli" required/></td> [cite: 925]
            </tr>
            <tr>
                <td>Harga Jual</td> [cite: 926]
                <td>:</td> [cite: 927]
                <td><input type="text" name="harga_jual" placeholder="Harga Jual" required/></td> [cite: 928]
            </tr>
            <tr>
                <td>Gambar Barang</td> [cite: 929]
                <td>:</td> [cite: 930]
                <td>
                    <input type="file" name="gambar_produk" required="required"> [cite: 931]
                    <p style="color: red">Ekstensi yang diperbolehkan .png .jpg .jpeg</p> [cite: 932]
                </td>
            </tr>
            <tr>
                <td height="47"></td> [cite: 933]
                <td></td> [cite: 934]
                <td>
                    <input type="submit" class="tombol_login" name="tombol" value="Simpan"/> [cite: 936]
                    [cite_start]<a href="tampil.php">Kembali</a> [cite: 937]
                [cite_start]</td> [cite: 939]
            </tr>
        [cite_start]</table> [cite: 946]
    [cite_start]</form> [cite: 949]
[cite_start]</body> [cite: 952]
[cite_start]</html> [cite: 956]