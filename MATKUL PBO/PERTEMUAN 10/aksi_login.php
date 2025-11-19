<?php 
// Memulai session PHP
session_start();

// Memanggil file koneksi.php
include 'koneksi.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Inisiasi koneksi database (tanpa OOP, cukup koneksi biasa)
$conn = mysqli_connect("localhost","root","","belajar_oop");

// Query untuk mencari user
$data = mysqli_query($conn,"select * from user where username='$username' and password='$password'");

// Hitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
    // Ambil data user
    $user_data = mysqli_fetch_assoc($data);
    
    // Buat session
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";

    // Arahkan ke halaman utama aplikasi (index.php)
    header("location:index.php");
}else{
    // Jika gagal, kembali ke halaman login
    header("location:login.php?pesan=gagal");
}
?>