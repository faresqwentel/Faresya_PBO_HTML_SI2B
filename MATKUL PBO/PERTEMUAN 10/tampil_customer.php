<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php');
$db = new database();
$data_customer = $db->tampil_data_customer();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data Customer</title>
</head>
<body>
    <a href="index.php"> &lt;&lt; Kembali ke Menu Utama</a>
    <h3>Data Customer (Pembeli)</h3>
    <a href="tambah_customer.php"><button>Tambah Data Customer</button></a>
    <br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Customer</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php 
        $no = 1;
        if(!empty($data_customer)) {
            foreach($data_customer as $row){
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nik_customer']; ?></td>
                <td><?php echo $row['nama_customer']; ?></td>
                <td><?php echo $row['jenis_kelamin']; ?></td>
                <td><?php echo $row['alamat_customer']; ?></td>
                <td><?php echo $row['telepon_customer']; ?></td>
                <td><?php echo $row['email_customer']; ?></td>
                <td>
                    <a href="edit_customer.php?id=<?php echo $row['id_customer']; ?>">Edit</a>
                    <a href="proses_customer.php?id=<?php echo $row['id_customer']; ?>&action=delete" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php 
            }
        } else {
             echo "<tr><td colspan='8'>Data masih kosong</td></tr>";
        }
        ?>
    </table>
</body>
</html>