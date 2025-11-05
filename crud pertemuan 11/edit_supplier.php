<?php
include('koneksi.php');
$db = new database();
$id_supplier = $_GET['id_supplier'];
$data = $db->tampil_edit_supplier($id_supplier);
?>
<!DOCTYPE html>
<html>
<body>
    <h3>Form Edit Data Supplier</h3>
    <form method="post" action="proses_data.php?type=supplier&action=edit">
        <input type="hidden" name="id_supplier" value="<?php echo $data['id_supplier']; ?>">
        <table>
            <tr><td>ID Supplier</td><td>:</td><td><b><?php echo $data['id_supplier']; ?></b></td></tr>
            <tr><td>Nama</td><td>:</td><td><input type="text" name="nama_supplier" value="<?php echo $data['nama_supplier']; ?>"/></td></tr>
            <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat_supplier" value="<?php echo $data['alamat_supplier']; ?>"/></td></tr>
            <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon_supplier" value="<?php echo $data['telepon_supplier']; ?>"/></td></tr>
            <tr><td>Email</td><td>:</td><td><input type="email" name="email_supplier" value="<?php echo $data['email_supplier']; ?>"/></td></tr>
            <tr><td>Password</td><td>:</td><td><input type="text" name="pass_supplier" value="<?php echo $data['pass_supplier']; ?>"/></td></tr>
            <tr><td></td><td></td><td><input type="submit" value="Ubah"/></td></tr>
        </table>
    </form>
    <a href="tampil_supplier.php">Kembali</a>
</body>
</html>