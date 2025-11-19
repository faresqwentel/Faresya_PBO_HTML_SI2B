<?php 
session_start();
include 'koneksi.php';
$db = new database();

$username = $_POST['username'];
$password = $_POST['password'];

$login_berhasil = $db->cek_login($username, $password);

if($login_berhasil){
    $data_user = $login_berhasil[0];
	$_SESSION['username'] = $username;
	$_SESSION['nama_lengkap'] = $data_user['nama_lengkap'];
	$_SESSION['status'] = "login";
	header("location:index.php");
} else {
	header("location:login.php?pesan=gagal");
}
?>