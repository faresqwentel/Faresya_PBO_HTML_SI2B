<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php');
$db = new database();
$id_customer = $_GET['id'];
$data = $db->tampil_edit_data_customer($id_customer);
?>
<!DOCTYPE html>
<html>
<head><title>Edit Data Customer</title></head>
<body>
    <h3>Form Edit Data Customer</h3>
    <form method="post" action="proses_customer.php?action=edit&id=<?php echo $id_customer; ?>">
    <?php foreach($data as $d) { ?>
	<table>
		<tr><td>NIK</td><td><input type="text" name="nik_customer" value="<?php echo $d['nik_customer']; ?>" required/></td></tr>
		<tr><td>Nama</td><td><input type="text" name="nama_customer" value="<?php echo $d['nama_customer']; ?>" required/></td></tr>
        <tr><td>Jenis Kelamin</td><td>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki" <?php if($d['jenis_kelamin']=='Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if($d['jenis_kelamin']=='Perempuan') echo 'selected'; ?>>Perempuan</option>
            </select>
        </td></tr>
		<tr><td>Alamat</td><td><textarea name="alamat_customer" required><?php echo $d['alamat_customer']; ?></textarea></td></tr>
		<tr><td>Telepon</td><td><input type="text" name="telepon_customer" value="<?php echo $d['telepon_customer']; ?>" required/></td></tr>
		<tr><td>Email</td><td><input type="email" name="email_customer" value="<?php echo $d['email_customer']; ?>" required/></td></tr>
        <tr><td>Password</td><td><input type="password" name="pass_customer" /><br/><i>(Kosongkan jika tidak ingin ganti password)</i></td></tr>
		<tr><td></td><td>
            <input type="submit" value="Update"/>
            <a href="tampil_customer.php"><input type="button" value="Kembali"/></a>
        </td></tr>
	</table>
    <?php } ?>
	</form>
</body>
</html>