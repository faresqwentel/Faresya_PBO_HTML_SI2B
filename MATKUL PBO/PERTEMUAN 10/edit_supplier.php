<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php');
$db = new database();
$id_supplier = $_GET['id'];
$data = $db->tampil_edit_data_supplier($id_supplier);
?>
<!DOCTYPE html>
<html>
<head><title>Edit Data Supplier</title></head>
<body>
    <h3>Form Edit Data Supplier</h3>
    <form method="post" action="proses_supplier.php?action=edit&id=<?php echo $id_supplier; ?>">
    <?php foreach($data as $d) { ?>
	<table>
        <tr><td>ID Supplier</td><td><input type="text" name="id_supplier" value="<?php echo $d['id_supplier']; ?>" readonly/></td></tr>
		<tr><td>Nama Supplier</td><td><input type="text" name="nama_supplier" value="<?php echo $d['nama_supplier']; ?>" required/></td></tr>
		<tr><td>Alamat</td><td><textarea name="alamat_supplier" required><?php echo $d['alamat_supplier']; ?></textarea></td></tr>
		<tr><td>Telepon</td><td><input type="text" name="telepon_supplier" value="<?php echo $d['telepon_supplier']; ?>" required/></td></tr>
		<tr><td>Email</td><td><input type="email" name="email_supplier" value="<?php echo $d['email_supplier']; ?>" required/></td></tr>
        <tr><td>Password</td><td><input type="password" name="pass_supplier" /><br/><i>(Kosongkan jika tidak ingin ganti password)</i></td></tr>
		<tr><td></td><td>
            <input type="submit" value="Update"/>
            <a href="tampil_supplier.php"><input type="button" value="Kembali"/></a>
        </td></tr>
	</table>
    <?php } ?>
	</form>
</body>
</html>