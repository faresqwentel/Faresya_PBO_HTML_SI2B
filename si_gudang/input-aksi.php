<?php 

ini_set(option: 'display_errors', value: 1);
error_reporting(error_level: E_ALL);
mysqli_report(flags: MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include 'koneksi.php';
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerjaan = $_POST['pekerjaan'];

mysqli_query(mysql: $koneksi, query: "INSERT INTO user (nama, alamat, pekerjaan) VALUES ('$nama','$alamat','$pekerjaan')");

header(header: "location:index.php?pesan=input");

?>