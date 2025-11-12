<?php
include('koneksi.php');
$db = new database();

// Wajib ada session_start() di file yang menggunakan session
// (termasuk untuk mengecek login atau menampilkan data berdasarkan user)
session_start();

// Cek apakah user sudah login, jika belum, lempar ke index.php
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tampil Data</title>
    <style type="text/css">
        * { font-family: "Trebuchet MS"; }
        body { background-color: #f0f0f0; }
        h1 { text-transform: uppercase; color: #47C6DB; }
        table { 
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336868;
            padding: 10px;
            text-align: left;
        }
        table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
        }
        a {
            background-color: #47C6DB;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
            border-radius: 3px;
        }
        a.tombol_hapus { background-color: #E74C3C; }
        a.tombol_print { background-color: #2ECC71; }
        a.tombol_logout { background-color: #F39C12; }
        
        .tombol_login { background: #47C6DB; color: white; font-size: 11pt; border: none; padding: 5px 20px; border-radius: 3px; cursor: pointer; }
        .posisi_tombol { margin: 20px 0 20px 15%; }
        .form_cari { margin: 20px 0 20px 15%; }
    </style>
</head>
<body>
    <div class="form_cari">
        <form id="background_border" method="get">
            Cari berdasarkan:
            <select name="kriteria">
                <option value="kd_barang">Kode Barang</option>
                <option value="nama_barang">Nama Barang</option>
            </select>
            <input type="text" name="cari" placeholder="Cari Data">
            <input type="submit" class="tombol_login" value="Cari">
        </form>
    </div>

    <div class="posisi_tombol">
        <a href="tambah_data.php">+ Tambah Data</a>&nbsp; &nbsp;
        <a href="cetak.php" target="_BLANK" class="tombol_print">Print Data Barang</a>
        <a href="proses_barang.php?action=logout" class="tombol_logout">Keluar Aplikasi (<?php echo $_SESSION['username']; ?>)</a>
    </div>

    <center><h1>Data Barang</h1></center>
    
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar Produk</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Logika untuk pencarian
            if (isset($_GET['cari']) && $_GET['cari'] != '') {
                $cari = $_GET['cari'];
                $kriteria = $_GET['kriteria'];
                echo "<center><b>Hasil pencarian untuk: " . $cari . "</b></center>";
                $data_barang = $db->cari_data($cari, $kriteria);
            } else {
                // Jika tidak mencari, tampilkan semua data
                $data_barang = $db->tampil_data();
            }
            
            $no = 1;
            // Cek jika data_barang tidak kosong
            if (!empty($data_barang)) {
                foreach ($data_barang as $row) {
                    // Format harga ke Rupiah
                    $rupiah_harga_beli = "Rp " . number_format($row['harga_beli'], 0, ',', '.');
                    $rupiah_harga_jual = "Rp " . number_format($row['harga_jual'], 0, ',', '.');
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['kd_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $rupiah_harga_beli; ?></td>
                <td><?php echo $rupiah_harga_jual; ?></td>
                <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
                <td>
                    <a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>&action=edit">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete" class="tombol_hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
                } // akhir foreach
            } else { // Jika data kosong
                echo '<tr><td colspan="8" style="text-align: center;">Data tidak ditemukan.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>