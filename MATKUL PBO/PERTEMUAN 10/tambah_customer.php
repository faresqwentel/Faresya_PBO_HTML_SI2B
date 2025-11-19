<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Data Customer</title></head>
<body>
    <h3>Form Tambah Data Customer</h3>
	<form method="post" action="proses_customer.php?action=add">
	<table>
		<tr><td>NIK</td><td><input type="text" name="nik_customer" required/></td></tr>
		<tr><td>Nama</td><td><input type="text" name="nama_customer" required/></td></tr>
        <tr><td>Jenis Kelamin</td><td>
            <select name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </td></tr>
		<tr><td>Alamat</td><td><textarea name="alamat_customer" required></textarea></td></tr>
		<tr><td>Telepon</td><td><input type="text" name="telepon_customer" required/></td></tr>
		<tr><td>Email</td><td><input type="email" name="email_customer" required/></td></tr>
        <tr><td>Password</td><td><input type="password" name="pass_customer" required/></td></tr>
		<tr><td></td><td>
            <input type="submit" value="Simpan"/>
            <a href="tampil_customer.php"><input type="button" value="Kembali"/></a>
        </td></tr>
	</table>
	</form>
</body>
</html>