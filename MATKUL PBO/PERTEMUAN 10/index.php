<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}
include 'koneksi.php';
$db = new database();

// Menghitung jumlah data untuk dashboard
$jumlah_barang = $db->hitung_data_barang();
$jumlah_customer = $db->hitung_data_customer();
$jumlah_supplier = $db->hitung_data_supplier();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Aplikasi CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .header h1 { margin: 0; }
        .header span { font-size: 14px; color: #333; }
        .header a { color: #dc3545; text-decoration: none; font-weight: bold; }
        .menu-container { margin-top: 30px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .menu-button { padding: 20px; text-align: center; font-size: 16px; color: white; background-color: #007BFF; border-radius: 5px; text-decoration: none; transition: background-color 0.3s; display: flex; flex-direction: column; justify-content: space-between; min-height: 80px; }
        .menu-button:hover { background-color: #0056b3; }
        .menu-button.supplier { background-color: #28a745; }
        .menu-button.supplier:hover { background-color: #218838; }
        .menu-button.customer { background-color: #ffc107; color: #333; }
        .menu-button.customer:hover { background-color: #e0a800; }
        .menu-button span.count { display: block; font-size: 32px; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Dashboard Aplikasi</h1>
                <span>Selamat datang, <strong><?php echo $_SESSION['username']; ?></strong>!</span>
            </div>
            <a href="logout.php" onclick="return confirm('Anda yakin ingin keluar?')">Keluar Aplikasi</a>
        </div>
        
        <p style="margin-top: 20px;">Silakan pilih menu yang ingin Anda kelola:</p>
        
        <div class="menu-container">
            <a href="tampil_barang.php" class="menu-button">
                Kelola Data Barang Elektronik
                <span class="count"><?php echo $jumlah_barang; ?></span>
            </a>
            <a href="tampil_customer.php" class="menu-button customer">
                Kelola Data Pembeli
                <span class="count"><?php echo $jumlah_customer; ?></span>
            </a>
            <a href="tampil_supplier.php" class="menu-button supplier">
                Kelola Data Supplier
                <span class="count"><?php echo $jumlah_supplier; ?></span>
            </a>
        </div>
    </div>
</body>
</html>