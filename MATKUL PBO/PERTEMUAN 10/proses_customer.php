<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php');
$db = new database();

$action = $_GET['action'];
if($action == "add") {
    $db->tambah_data_customer($_POST['nik_customer'], $_POST['nama_customer'], $_POST['jenis_kelamin'], $_POST['alamat_customer'], $_POST['telepon_customer'], $_POST['email_customer'], $_POST['pass_customer']);
	header('location:tampil_customer.php');
} 
elseif($action == "edit") {
    $id = $_GET['id'];
    $db->edit_data_customer($id, $_POST['nik_customer'], $_POST['nama_customer'], $_POST['jenis_kelamin'], $_POST['alamat_customer'], $_POST['telepon_customer'], $_POST['email_customer'], $_POST['pass_customer']);
    header('location:tampil_customer.php');
} 
elseif($action == "delete") {
    $id = $_GET['id'];
    $db->delete_data_customer($id);
    header('location:tampil_customer.php');
}
?>