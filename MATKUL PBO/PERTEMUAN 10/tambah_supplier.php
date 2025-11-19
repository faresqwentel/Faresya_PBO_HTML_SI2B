<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Data Supplier</title></head>
<body>
    <h3>Form Tambah Data Supplier</h3>
	<form method="post" action="proses_supplier.php?action=add">
	<table>
        <tr><td>ID Supplier</td><td><input type="text" name="id_supplier" placeholder="Contoh: SUPP001" required/></td></tr>
		<tr><td>Nama Supplier</td><td><input type="text" name="nama_supplier" required/></td></tr>
		<tr><td>Alamat</td><td><textarea name="alamat_supplier" required></textarea></td></tr>
		<tr><td>Telepon</td><td><input type="text" name="telepon_supplier" required/></td></tr>
		<tr><td>Email</td><td><input type="email" name="email_supplier" required/></td></tr>
        <tr><td>Password</td><td><input type="password" name="pass_supplier" required/></td></tr>
		<tr><td></td><td>
            <input type="submit" value="Simpan"/>
            <a href="tampil_supplier.php"><input type="button" value="Kembali"/></a>
        </td></tr>
	</table>
	</form>
</body>
</html>