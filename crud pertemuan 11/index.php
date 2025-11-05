<?php
session_start();
include('koneksi.php');
$db = new database();
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Inventori</title>
</head>
<body>

<?php 
if ($is_logged_in): 
    // JIKA SUDAH LOGIN
    include('navigasi.php'); 
?>
    <h1>Data Barang</h1>
    
    <?php $data_barang = $db->tampil_data(); ?>
    
    <div>
        <a href="tambah_data.php">Tambah Data Barang</a>
        <br><br>
        <form action="cari_data.php" method="get" style="display:inline;">
            <input type="hidden" name="type" value="barang">
            <input type="text" name="cari" placeholder="Cari Nama Barang">
            <input type="submit" value="Cari">
        </form>
        <br><br>
        <button onclick="window.print()">Print Tabel</button>
    </div>
    <br>
    
    <table border="1">
        <tr>
            <th>ID Barang</th> <th>Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Action</th>
        </tr>
        <?php
        // $no=1; kita tidak pakai lagi
        foreach($data_barang as $row){
        ?>
        <tr>
            <td><?php echo $row['id_barang']; ?></td> <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
            <td><?php echo htmlspecialchars($row['stok']); ?></td>
            <td><?php echo htmlspecialchars($row['harga_beli']); ?></td>
            <td><?php echo htmlspecialchars($row['harga_jual']); ?></td>
            <td>
                <a href="edit_data.php?id_barang=<?php echo $row['id_barang'];?>">Edit</a> |
                <a href="proses_data.php?type=barang&action=delete&id_barang=<?php echo $row['id_barang'];?>" onclick="return confirm('Yakin hapus?');">Hapus</a> |
                <a href="print_satuan.php?type=barang&id=<?php echo $row['id_barang']; ?>" target="_blank">Print</a>
            </td>
        </tr>
        <?php 
        } // akhir foreach
        ?>
    </table>

<?php 
else: 
    // JIKA BELUM LOGIN
?>
    <h1>Sistem Inventori</h1>
    <strong>Silakan Login</strong>
    <form action="proses_login.php" method="POST">
        <?php if(isset($_GET['error'])): ?>
            <p style="color:red;">Username atau Password salah!</p>
        <?php endif; ?>
        <p>Username: <input type="text" name="username" required></p>
        <p>Password: <input type="password" name="password" required></p>
        <p><input type="submit" value="Login"></p>
    </form>
<?php 
endif; // Penutup 'if ($is_logged_in)'
?>

</body>
</html>