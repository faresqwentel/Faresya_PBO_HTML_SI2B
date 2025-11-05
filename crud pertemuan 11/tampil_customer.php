<?php
session_start();
include('koneksi.php');
$db = new database();
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';

if (!$is_logged_in) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head><title>Data Customer</title></head>
<body>
    <?php include('navigasi.php'); ?>
    <h1>Data Customer</h1>
    <?php $data_customer = $db->tampil_customer(); ?>

    <div>
        <a href="tambah_customer.php">Tambah Data Customer</a>
        <br><br>
        <form action="cari_data.php" method="get" style="display:inline;">
            <input type="hidden" name="type" value="customer">
            <input type="text" name="cari" placeholder="Cari Nama Customer">
            <input type="submit" value="Cari">
        </form>
        <br><br>
        <button onclick="window.print()">Print Tabel</button>
    </div>
    <br>
    
    <table border="1">
        <tr>
            <th>ID</th><th>NIK</th><th>Nama</th><th>JK</th><th>Alamat</th>
            <th>Telepon</th><th>Email</th><th>Pass</th><th>Action</th>
        </tr>
        <?php
        foreach($data_customer as $row){
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_customer']); ?></td>
            <td><?php echo htmlspecialchars($row['nik_customer']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_customer']); ?></td>
            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat_customer']); ?></td>
            <td><?php echo htmlspecialchars($row['telepon_customer']); ?></td>
            <td><?php echo htmlspecialchars($row['email_customer']); ?></td>
            <td><?php echo htmlspecialchars($row['pass_customer']); ?></td>
            <td>
                <a href="edit_customer.php?id_customer=<?php echo $row['id_customer'];?>">Edit</a> |
                <a href="proses_data.php?type=customer&action=delete&id_customer=<?php echo $row['id_customer'];?>" onclick="return confirm('Yakin hapus?');">Hapus</a> |
                <a href="print_satuan.php?type=customer&id=<?php echo $row['id_customer']; ?>" target="_blank">Print</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>