<?php
session_start();
include('koneksi.php');
$db = new database();
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';

if (!$is_logged_in) { header("Location: index.php"); exit; }

$type = $_GET['type'] ?? 'barang';
$cari = $_GET['cari'] ?? '';

$data_hasil = [];
$kembali_link = "index.php";
$judul = "Hasil Cari Barang";
$placeholder_cari = "Cari Nama Barang";

switch($type) {
    case 'barang':
        $data_hasil = $db->cari_data($cari);
        $kembali_link = "index.php";
        $judul = "Hasil Cari Barang";
        $placeholder_cari = "Cari Nama Barang";
        break;
    case 'customer':
        $data_hasil = $db->cari_customer($cari);
        $kembali_link = "tampil_customer.php";
        $judul = "Hasil Cari Customer";
        $placeholder_cari = "Cari Nama Customer";
        break;
    case 'supplier':
        $data_hasil = $db->cari_supplier($cari);
        $kembali_link = "tampil_supplier.php";
        $judul = "Hasil Cari Supplier";
        $placeholder_cari = "Cari Nama Supplier";
        break;
}
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $judul; ?></title></head>
<body>
    <?php include('navigasi.php'); ?>
    <h1><?php echo $judul; ?></h1>
    
    <form action="cari_data.php" method="get" style="display:inline;">
        <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
        <input type="text" name="cari" placeholder="<?php echo $placeholder_cari; ?>" value="<?php echo htmlspecialchars($cari); ?>">
        <input type="submit" value="Cari Lagi">
    </form>
    <br><br>
    <button onclick="window.print()">Print Hasil Ini</button>
    <br><br>
    
    <p>Hasil pencarian untuk: <b><?php echo htmlspecialchars($cari); ?></b></p>
    <a href="<?php echo $kembali_link; ?>">Kembali ke daftar</a>
    <br><br>
    
    <?php if (empty($data_hasil)): ?>
        <p>Data tidak ditemukan.</p>
        
    <?php else: ?>
        <table border="1">
            
        <?php if ($type == 'barang'): ?>
            <tr><th>ID</th><th>Barang</th><th>Stok</th><th>Harga Beli</th><th>Harga Jual</th></tr>
            <?php foreach($data_hasil as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_barang']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($row['stok']); ?></td>
                <td><?php echo htmlspecialchars($row['harga_beli']); ?></td>
                <td><?php echo htmlspecialchars($row['harga_jual']); ?></td>
            </tr>
            <?php endforeach; ?>
            
        <?php elseif ($type == 'customer'): ?>
            <tr><th>ID</th><th>NIK</th><th>Nama</th><th>JK</th><th>Alamat</th><th>Telepon</th></tr>
            <?php foreach($data_hasil as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_customer']); ?></td>
                <td><?php echo htmlspecialchars($row['nik_customer']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_customer']); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                <td><?php echo htmlspecialchars($row['alamat_customer']); ?></td>
                <td><?php echo htmlspecialchars($row['telepon_customer']); ?></td>
            </tr>
            <?php endforeach; ?>
            
        <?php elseif ($type == 'supplier'): ?>
            <tr><th>ID</th><th>Nama Supplier</th><th>Alamat</th><th>Telepon</th><th>Email</th></tr>
             <?php foreach($data_hasil as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_supplier']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                <td><?php echo htmlspecialchars($row['alamat_supplier']); ?></td>
                <td><?php echo htmlspecialchars($row['telepon_supplier']); ?></td>
                <td><?php echo htmlspecialchars($row['email_supplier']); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        
        </table>
    <?php endif; ?>

</body>
</html>