<!DOCTYPE html>
<html>
<body>
    <h3>Form Tambah Data Barang</h3>
    <hr>
    <form method="post" action="proses_data.php?type=barang&action=add">
        <table>
            <tr><td>Nama Barang</td><td>:</td><td><input type="text" name="nama_barang"/></td></tr>
            <tr><td>Stok</td><td>:</td><td><input type="text" name="stok"/></td></tr>
            <tr><td>Harga Beli</td><td>:</td><td><input type="text" name="harga_beli"/></td></tr>
            <tr><td>Harga Jual</td><td>:</td><td><input type="text" name="harga_jual"/></td></tr>
            <tr><td></td><td></td><td><input type="submit" value="Simpan"/></td></tr>
        </table>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>