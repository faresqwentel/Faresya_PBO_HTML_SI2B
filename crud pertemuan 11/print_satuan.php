<?php
include('koneksi.php');
$db = new database();

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';
$data = null;
$judul = "Laporan Detail";

if($id === '') die("ID tidak boleh kosong");

switch($type) {
    case 'barang':
        $data = $db->tampil_edit_data((int)$id);
        $judul = "Laporan Detail Data Barang";
        break;
    case 'customer':
        $data = $db->tampil_edit_customer((string)$id);
        $judul = "Laporan Detail Data Customer";
        break;
    case 'supplier':
        $data = $db->tampil_edit_supplier((string)$id);
        $judul = "Laporan Detail Data Supplier";
        break;
    default:
        die("Tipe data tidak valid");
}

if ($data === null) die("Data tidak ditemukan.");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $judul; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        h1 { font-size: 18pt; border-bottom: 2px solid #000; padding-bottom: 5px; }
        table { margin-top: 15px; font-size: 12pt; }
        td { padding: 5px 8px; }
        td:first-child { font-weight: bold; width: 150px; vertical-align: top; }
        td:nth-child(2) { width: 10px; vertical-align: top; }
        td:last-child { vertical-align: top; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">

    <h1><?php echo $judul; ?></h1>
    
    <table>
    <?php if ($type == 'barang'): ?>
        <tr>
            <td>ID Barang</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['id_barang']); ?></td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['nama_barang']); ?></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['stok']); ?></td>
        </tr>
        <tr>
            <td>Harga Beli</td>
            <td>:</td>
            <td>Rp <?php echo number_format($data['harga_beli'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Harga Jual</td>
            <td>:</td>
            <td>Rp <?php echo number_format($data['harga_jual'], 0, ',', '.'); ?></td>
        </tr>
        
    <?php elseif ($type == 'customer'): ?>
        <tr>
            <td>ID Customer</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['id_customer']); ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['nik_customer']); ?></td>
        </tr>
        <tr>
            <td>Nama Customer</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['nama_customer']); ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['jenis_kelamin']); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['alamat_customer']); ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['telepon_customer']); ?></td>
        </tr>
        
    <?php elseif ($type == 'supplier'): ?>
         <tr>
            <td>ID Supplier</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['id_supplier']); ?></td>
        </tr>
        <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['nama_supplier']); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['alamat_supplier']); ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['telepon_supplier']); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['email_supplier']); ?></td>
        </tr>
    <?php endif; ?>
    </table>
    
    <br>
    <button class="no-print" onclick="window.close()">Tutup Jendela</button>

</body>
</html>