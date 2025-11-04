<?php
// SELALU MULAI SESSION DI PALING ATAS
session_start();

include('koneksi.php');
$db = new database();

// Cek apakah user sudah login
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';

// Logika pencarian
if(isset($_GET['cari']) && !empty($_GET['cari'])){
    $cari = $_GET['cari'];
    $data_barang = $db->cari_data($cari);
} else {
    $data_barang = $db->tampil_data();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Inventori</title>
</head>
<body>

<h1>Daftar Barang</h1>

<div class="login-box">
    <?php if ($is_logged_in): ?>
        <p>Halo, <strong><?php echo htmlspecialchars($username); ?>!</strong></p>
        <a href="logout.php">Logout</a>

    <?php else: ?>
        <strong>Silakan Login untuk Edit/Hapus</strong>
        <form action="proses_login.php" method="POST">
            <?php if(isset($_GET['error'])): ?>
                <div class="error-login">Username atau Password salah!</div>
            <?php endif; ?>
            <p>
                Username: <input type="text" name="username" required>
            </p>
            <p>
                Password: <input type="password" name="password" required>
            </p>
            <input type="submit" value="Login">
        </form>
    <?php endif; ?>
</div>


<?php
// Tampilkan link "Tambah Data" HANYA jika sudah login
if ($is_logged_in) {
?>
    <a href="tambah_data.php">Tambah Data</a>
<?php
}
?>

<form method="get" style="margin-top: 15px;">
    <input type="text" name="cari" placeholder="Cari Nama Barang" value="<?php echo isset($cari) ? htmlspecialchars($cari) : ''; ?>">
    <input type="submit" value="Cari">
</form>

<?php
if(isset($cari)){
    echo "<p><b>Hasil pencarian : ".htmlspecialchars($cari)."</b></p>";
}
?>

<table>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Stok</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Action</th>
    </tr>
    <?php
    $no = 1;
    foreach($data_barang as $row){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
        <td><?php echo htmlspecialchars($row['stok']); ?></td>
        <td><?php echo htmlspecialchars($row['harga_beli']); ?></td>
        <td><?php echo htmlspecialchars($row['harga_jual']); ?></td>
        <td>
            <?php
            // Tampilkan link "Edit" dan "Hapus" HANYA jika sudah login
            if ($is_logged_in) {
            ?>
                <a href="edit_data.php?id_barang=<?php echo $row['id_barang'];?>&action=edit">Edit</a>
                <a href="proses_barang.php?id_barang=<?php echo $row['id_barang'];?>&action=delete">Hapus</a>
            <?php
            } else {
                // Jika belum login, tampilkan pesan ini
                echo '<span class="disabled-action">Login</span>';
            }
            ?>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

</body>
</html>