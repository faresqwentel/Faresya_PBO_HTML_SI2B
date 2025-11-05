<!DOCTYPE html>
<html>
<body>
    <h3>Form Tambah Data Supplier</h3>
    <hr>
    <form method="post" action="proses_data.php?type=supplier&action=add">
        <table>
            <tr><td>Nama</td><td>:</td><td><input type="text" name="nama_supplier"/></td></tr>
            <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat_supplier"/></td></tr>
            <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon_supplier"/></td></tr>
            <tr><td>Email</td><td>:</td><td><input type="email" name="email_supplier"/></td></tr>
            <tr><td>Password</td><td>:</td><td><input type="text" name="pass_supplier"/></td></tr>
            <tr><td></td><td></td><td><input type="submit" value="Simpan"/></td></tr>
        </table>
    </form>
    <br>
    <a href="tampil_supplier.php">Kembali</a>
</body>
</html>