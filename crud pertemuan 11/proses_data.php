<?php
// proses_data.php
require __DIR__ . '/koneksi.php';

$db      = new Database();
$type    = $_GET['type'] ?? '';   
$action  = $_GET['action'] ?? ''; 

function go(string $url): never {
    header('Location: ' . $url, true, 303);
    exit;
}

switch ($type) {

    case 'barang':
        $redir_url = 'index.php'; 
        switch ($action) {
            case 'add':
                $nama  = trim($_POST['nama_barang'] ?? '');
                $stok  = (int) ($_POST['stok'] ?? 0);
                $beli  = (int) ($_POST['harga_beli'] ?? 0);
                $jual  = (int) ($_POST['harga_jual'] ?? 0);
                $db->tambah_data($nama, $stok, $beli, $jual);
                go($redir_url);
            case 'edit':
                $id    = (int) ($_POST['id_barang'] ?? 0);
                $nama  = trim($_POST['nama_barang'] ?? '');
                $stok  = (int) ($_POST['stok'] ?? 0);
                $beli  = (int) ($_POST['harga_beli'] ?? 0);
                $jual  = (int) ($_POST['harga_jual'] ?? 0);
                $db->edit_data($id, $nama, $stok, $beli, $jual);
                go($redir_url);
            case 'delete':
                $id = (int) ($_GET['id_barang'] ?? 0);
                $db->delete_data($id);
                go($redir_url);
        }
        break; 

    case 'customer':
        $redir_url = 'tampil_customer.php';
        switch ($action) {
            case 'add':
                // PANGGIL FUNGSI ID OTOMATIS
                $id     = $db->get_next_customer_id();
                
                $nik    = trim($_POST['nik_customer'] ?? '');
                $nama   = trim($_POST['nama_customer'] ?? '');
                $jk     = trim($_POST['jenis_kelamin'] ?? '');
                $alamat = trim($_POST['alamat_customer'] ?? '');
                $telp   = trim($_POST['telepon_customer'] ?? '');
                $email  = trim($_POST['email_customer'] ?? '');
                $pass   = trim($_POST['pass_customer'] ?? '');
                $db->tambah_customer($id, $nik, $nama, $jk, $alamat, $telp, $email, $pass);
                go($redir_url);
            case 'edit':
                $id     = trim($_POST['id_customer'] ?? '');
                $nik    = trim($_POST['nik_customer'] ?? '');
                $nama   = trim($_POST['nama_customer'] ?? '');
                $jk     = trim($_POST['jenis_kelamin'] ?? '');
                $alamat = trim($_POST['alamat_customer'] ?? '');
                $telp   = trim($_POST['telepon_customer'] ?? '');
                $email  = trim($_POST['email_customer'] ?? '');
                $pass   = trim($_POST['pass_customer'] ?? '');
                $db->edit_customer($id, $nik, $nama, $jk, $alamat, $telp, $email, $pass);
                go($redir_url);
            case 'delete':
                $id = trim($_GET['id_customer'] ?? '');
                $db->delete_customer($id);
                go($redir_url);
        }
        break; 

    case 'supplier':
        $redir_url = 'tampil_supplier.php'; 
        switch ($action) {
            case 'add':
                // PANGGIL FUNGSI ID OTOMATIS
                $id     = $db->get_next_supplier_id();
                
                $nama   = trim($_POST['nama_supplier'] ?? '');
                $alamat = trim($_POST['alamat_supplier'] ?? '');
                $telp   = trim($_POST['telepon_supplier'] ?? '');
                $email  = trim($_POST['email_supplier'] ?? '');
                $pass   = trim($_POST['pass_supplier'] ?? '');
                $db->tambah_supplier($id, $nama, $alamat, $telp, $email, $pass);
                go($redir_url);
            case 'edit':
                $id     = trim($_POST['id_supplier'] ?? '');
                $nama   = trim($_POST['nama_supplier'] ?? '');
                $alamat = trim($_POST['alamat_supplier'] ?? '');
                $telp   = trim($_POST['telepon_supplier'] ?? '');
                $email  = trim($_POST['email_supplier'] ?? '');
                $pass   = trim($_POST['pass_supplier'] ?? '');
                $db->edit_supplier($id, $nama, $alamat, $telp, $email, $pass);
                go($redir_url);
            case 'delete':
                $id = trim($_GET['id_supplier'] ?? '');
                $db->delete_supplier($id);
                go($redir_url);
        }
        break; 

    default:
        go('index.php');
}