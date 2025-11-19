<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php');
$db = new database();
$data_supplier = $db->tampil_data_supplier();
?>
<!DOCTYPE html>
<html>
<head><title>Kelola Data Supplier</title></head>
<body>
    <a href="index.php"> &lt;&lt; Kembali ke Menu Utama</a>
    <h3>Data Supplier</h3>
    <a href="tambah_supplier.php"><button>Tambah Data Supplier</button></a>
    <br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php 
        $no = 1;
        if(!empty($data_supplier)) {
            foreach($data_supplier as $row){
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['id_supplier']; ?></td>
                <td><?php echo $row['nama_supplier']; ?></td>
                <td><?php echo $row['alamat_supplier']; ?></td>
                <td><?php echo $row['telepon_supplier']; ?></td>
                <td><?php echo $row['email_supplier']; ?></td>
                <td>
                    <a href="edit_supplier.php?id=<?php echo $row['id_supplier']; ?>">Edit</a>
                    <a href="proses_supplier.php?id=<?php echo $row['id_supplier']; ?>&action=delete" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php 
            }
        } else {
             echo "<tr><td colspan='7'>Data masih kosong</td></tr>";
        }
        ?>
    </table>
</body>
</html>