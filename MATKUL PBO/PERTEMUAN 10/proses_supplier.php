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
    $db->tambah_data_supplier($_POST['id_supplier'], $_POST['nama_supplier'], $_POST['alamat_supplier'], $_POST['telepon_supplier'], $_POST['email_supplier'], $_POST['pass_supplier']);
	header('location:tampil_supplier.php');
} 
elseif($action == "edit") {
    $id = $_GET['id'];
    $db->edit_data_supplier($id, $_POST['nama_supplier'], $_POST['alamat_supplier'], $_POST['telepon_supplier'], $_POST['email_supplier'], $_POST['pass_supplier']);
    header('location:tampil_supplier.php');
} 
elseif($action == "delete") {
    $id = $_GET['id'];
    $db->delete_data_supplier($id);
    header('location:tampil_supplier.php');
}
?>