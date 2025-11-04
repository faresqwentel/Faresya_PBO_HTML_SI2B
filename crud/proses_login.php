<?php
session_start();
include('koneksi.php'); // Pastikan file ini ada

$db = new database();

$username = $_POST['username'];
$password = $_POST['password'];

$user_data = $db->cek_login($username);

if ($user_data && $password === $user_data['password']) {
    
    // Login sukses
    $_SESSION['id_user'] = $user_data['id_user'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['tipe_user'] = $user_data['tipe_user']; // Ini akan menyimpan 'Administrator' atau 'Petugas'

    // Arahkan kembali ke index.php (tempat tabel barang)
    header("Location: index.php");
    exit;

} else {
    header("Location: index.php?error=1");
    exit;
}
?>