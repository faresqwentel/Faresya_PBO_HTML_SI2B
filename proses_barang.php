<?php
include('koneksi.php');

$koneksi = new database();

// Pastikan 'action' ada di URL sebelum mengaksesnya
if (isset($_GET['action'])) {
    
    $action = $_GET['action'];

    if ($action == "add") {
        $koneksi->tambah_data(
            $_POST['kd_barang'],
            $_POST['nama_barang'],
            $_POST['stok'],
            $_POST['harga_beli'],
            $_POST['harga_jual'],
            $_FILES['gambar_produk']['name']
        );
        header('location:tampil.php');

    } else if ($action == "edit") {
        $koneksi->edit_data(
            $_POST['id_barang'],
            $_POST['nama_barang'],
            $_POST['stok'],
            $_POST['harga_beli'],
            $_POST['harga_jual'],
            $_FILES['gambar_produk']['name']
        );
        header('location:tampil.php');

    } else if ($action == "delete") {
        $id_barang = $_GET['id_barang'];
        $koneksi->delete_data($id_barang);
        header('location:tampil.php');

    } else if ($action == "login") {
        // Fungsi login() di koneksi.php Anda yang akan menangani ini
        $koneksi->login($_POST['username'], $_POST['password']);
        
    } else if ($action == "logout") {
        // Fungsi logout() di koneksi.php Anda
        $koneksi->logout();
    }
} else {
    echo "Aksi tidak ditemukan.";
}
?>