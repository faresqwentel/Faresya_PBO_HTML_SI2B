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
<head><title>Data Supplier</title></head>
<body>
    <?php include('navigasi.php'); ?>
    <h1>Data Supplier</h1>
    <?php $data_supplier = $db->tampil_supplier(); ?>

    <div>
        <a href="tambah_supplier.php">Tambah Data Supplier</a>
        <br><br>
        <form action="cari_data.php" method="get" style="display:inline;">
            <input type="hidden" name="type" value="supplier">
            <input type="text" name="cari" placeholder="Cari Nama Supplier">
            <input type="submit" value="Cari">
        </form>
        <br><br>
        <button onclick="window.print()">Print Tabel</button>
    </div>
    <br>
    
    <table border="1">
        <tr>
            <th>ID</th><th>Nama Supplier</th><th>Alamat</th>
            <th>Telepon</th><th>Email</th><th>Pass</th><th>Action</th>
        </tr>
        <?php
        foreach($data_supplier as $row){
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_supplier']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat_supplier']); ?></td>
            <td><?php echo htmlspecialchars($row['telepon_supplier']); ?></td>
            <td><?php echo htmlspecialchars($row['email_supplier']); ?></td>
            <td><?php echo htmlspecialchars($row['pass_supplier']); ?></td>
            <td>
                <a href="edit_supplier.php?id_supplier=<?php echo $row['id_supplier'];?>">Edit</a> |
                <a href="proses_data.php?type=supplier&action=delete&id_supplier=<?php echo $row['id_supplier'];?>" onclick="return confirm('Yakin hapus?');">Hapus</a> |
                <a href="print_satuan.php?type=supplier&id=<?php echo $row['id_supplier']; ?>" target="_blank">Print</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>