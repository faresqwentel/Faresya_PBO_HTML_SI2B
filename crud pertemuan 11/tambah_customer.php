<!DOCTYPE html>
<html>
<body>
    <h3>Form Tambah Data Customer</h3>
    <hr>
    <form method="post" action="proses_data.php?type=customer&action=add">
        <table>
            <tr><td>NIK</td><td>:</td><td><input type="text" name="nik_customer"/></td></tr>
            <tr><td>Nama</td><td>:</td><td><input type="text" name="nama_customer"/></td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td>
                <td>
                    <select name="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat_customer"/></td></tr>
            <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon_customer"/></td></tr>
            <tr><td>Email</td><td>:</td><td><input type="email" name="email_customer"/></td></tr>
            <tr><td>Password</td><td>:</td><td><input type="text" name="pass_customer"/></td></tr>
            <tr><td></td><td></td><td><input type="submit" value="Simpan"/></td></tr>
        </table>
    </form>
    <br>
    <a href="tampil_customer.php">Kembali</a>
</body>
</html>