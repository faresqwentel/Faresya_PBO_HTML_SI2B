<?php
include('koneksi.php');
$db = new database();
$id_customer = $_GET['id_customer'];
$data = $db->tampil_edit_customer($id_customer);
?>
<!DOCTYPE html>
<html>
<body>
    <h3>Form Edit Data Customer</h3>
    <hr>
    <form method="post" action="proses_data.php?type=customer&action=edit">
        <input type="hidden" name="id_customer" value="<?php echo $data['id_customer']; ?>">
        <table>
            <tr><td>ID Customer</td><td>:</td><td><b><?php echo $data['id_customer']; ?></b></td></tr>
            <tr><td>NIK</td><td>:</td><td><input type="text" name="nik_customer" value="<?php echo $data['nik_customer']; ?>"/></td></tr>
            <tr><td>Nama</td><td>:</td><td><input type="text" name="nama_customer" value="<?php echo $data['nama_customer']; ?>"/></td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td>
                <td>
                    <select name="jenis_kelamin">
                        <option value="Laki-laki" <?php echo $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat_customer" value="<?php echo $data['alamat_customer']; ?>"/></td></tr>
            <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon_customer" value="<?php echo $data['telepon_customer']; ?>"/></td></tr>
            <tr><td>Email</td><td>:</td><td><input type="email" name="email_customer" value="<?php echo $data['email_customer']; ?>"/></td></tr>
            <tr><td>Password</td><td>:</td><td><input type="text" name="pass_customer" value="<?php echo $data['pass_customer']; ?>"/></td></tr>
            <tr><td></td><td></td><td><input type="submit" value="Ubah"/></td></tr>
        </table>
    </form>
    <br>
    <a href="tampil_customer.php">Kembali</a>
</body>
</html>