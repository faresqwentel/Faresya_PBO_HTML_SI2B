<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php'); // Pastikan ada titik-koma
$koneksi = new database(); 

$action = isset($_GET['action']) ? $_GET['action'] : '';

// -----------------------------------------------------
// PROSES TAMBAH DATA (ADD) - INI PERBAIKANNYA
// -----------------------------------------------------
if($action == "add")
{
    // BENAR: Mengirim $_FILES['gambar_produk'] sebagai array
    // SALAH: Mengirim $_FILES['gambar_produk']['name'] (seperti di PDF )
    $koneksi->tambah_data(
        $_POST['kd_barang'],
        $_POST['nama_barang'],
        $_POST['stok'],
        $_POST['harga_beli'],
        $_POST['harga_jual'],
        $_FILES['gambar_produk'] // <-- INI YANG BENAR
    );
    
    // Kembali ke halaman tampil_barang.php
    header('location:tampil_barang.php');
}
// -----------------------------------------------------
// PROSES EDIT DATA (EDIT) - Ini sudah benar
// -----------------------------------------------------
else if($action == "edit")
{
    $id_barang = $_GET['id_barang'];
    
    // BENAR: Mengirim $_FILES['gambar_produk'] sebagai array
    $koneksi->edit_data(
        $id_barang,
        $_POST['nama_barang'],
        $_POST['stok'],
        $_POST['harga_beli'],
        $_POST['harga_jual'],
        $_FILES['gambar_produk'] // <-- INI YANG BENAR
    );
    
    // Kembali ke halaman tampil_barang.php
    header('location:tampil_barang.php');
}
// -----------------------------------------------------
// PROSES HAPUS DATA (DELETE) - Ini sudah benar
// -----------------------------------------------------
else if($action == "delete")
{
    $id_barang = $_GET['id_barang'];
    $koneksi->delete_data($id_barang);
    
    // Kembali ke halaman tampil_barang.php
    header('location:tampil_barang.php');
}
?>