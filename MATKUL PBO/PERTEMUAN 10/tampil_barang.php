<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include('koneksi.php'); 
$db = new database(); 

// ============================================================
// LOGIKA PAGINATION
// ============================================================
$batas = 5; 
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// ============================================================
// LOGIKA PENGAMBILAN DATA (+ PERBAIKAN PENCARIAN DISINI)
// ============================================================

// Siapkan variabel default
$kategori_pilih = "nama"; 
$keyword = "";

if(isset($_GET['Cari']) && !empty($_GET['Cari'])){
    $keyword = $_GET['Cari'];
    
    // Tangkap kategori dari URL, jika tidak ada anggap cari berdasarkan 'nama'
    $kategori_pilih = isset($_GET['kategori']) ? $_GET['kategori'] : 'nama';
    
    // PERBAIKAN: Mengirimkan 2 argumen ($keyword DAN $kategori_pilih)
    $semua_data = $db->cari_data_barang($keyword, $kategori_pilih);

} else {
    // Jika tidak mencari, tampilkan semua
    $semua_data = $db->tampil_data();
}

// Hitung total data dan total halaman
$jumlah_data = count($semua_data);
$total_halaman = ceil($jumlah_data / $batas);

// Ambil data yang ditampilkan saja (Slice array)
$data_barang = array_slice($semua_data, $halaman_awal, $batas);

// Nomor urut tabel
$nomor = $halaman_awal + 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data Barang</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f7f6; }
        
        /* === NAVIGATION BAR === */
        .navbar {
            background-color: #17a2b8; 
            overflow: hidden;
            padding: 15px 20px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar a {
            float: left;
            color: white;
            text-align: center;
            padding: 0 15px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            line-height: 25px;
        }
        .navbar a:hover { text-decoration: underline; }
        
        /* === CONTAINER === */
        .container { width: 90%; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        
        h3 { color: #17a2b8; text-transform: uppercase; text-align: center; margin-bottom: 30px; letter-spacing: 1px; }

        /* === TOOLBAR === */
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; }
        .toolbar-left { display: flex; gap: 10px; }
        .toolbar-right form { display: flex; gap: 5px; align-items: center; }
        
        /* === TOMBOL === */
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; border: none; cursor: pointer; transition: 0.3s; }
        .btn-tambah { background-color: #17a2b8; } 
        .btn-print { background-color: #17a2b8; }
        .btn-edit { background-color: #17a2b8; }
        .btn-hapus { background-color: #17a2b8; }
        .btn-cari { background-color: #17a2b8; color: white; border: 1px solid #17a2b8;}
        .btn:hover { opacity: 0.8; }

        /* === TABEL === */
        table { border-collapse: collapse; width: 100%; margin-top: 10px; font-size: 14px; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; vertical-align: middle; }
        th { background-color: #fff; color: #555; font-weight: bold; border-bottom: 2px solid #ddd; }
        tr:nth-child(even) { background-color: #fcfcfc; }
        tr:hover { background-color: #f1f1f1; }
        
        img { max-width: 60px; max-height: 60px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
        .action-cell { width: 150px; text-align: center; }
        .image-cell { width: 80px; text-align: center; }

        /* === PAGINATION === */
        .pagination { display: flex; justify-content: center; margin-top: 20px; margin-bottom: 20px; }
        .page-link { 
            color: #333; padding: 8px 16px; text-decoration: none; 
            border: 1px solid #ddd; margin: 0 4px; transition: background-color .3s; 
            background-color: #e9ecef;
        }
        .page-link.active { background-color: #17a2b8; color: white; border: 1px solid #17a2b8; }
        .page-link:hover:not(.active) { background-color: #ddd; }
        
        .print-satuan-area { margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px; display: flex; gap: 10px; align-items: center; }
        input[type="text"], select { padding: 6px; border: 1px solid #ccc; border-radius: 4px; }

    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="tampil_barang.php">Kelola Data</a>
        <a href="proses_barang.php?action=logout" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>

    <div class="container">
        
        <div class="toolbar">
            <div class="toolbar-left">
                <a href="tambah_barang.php" class="btn btn-tambah">+ Tambah Data</a>
                <a href="cetak_barang.php" target="_blank" class="btn btn-print">Print Data Barang</a>
            </div>
            
            <div class="toolbar-right">
                <form method="get" action="tampil_barang.php">
                    <span style="margin-right: 5px; font-size: 14px;">Cari berdasarkan :</span>
                    
                    <select name="kategori" style="margin-right: 5px;">
                        <option value="nama" <?php if($kategori_pilih == "nama") echo "selected"; ?>>Nama Barang</option>
                        <option value="kode" <?php if($kategori_pilih == "kode") echo "selected"; ?>>Kode Barang</option>
                    </select>

                    <input type="text" name="Cari" placeholder="Cari Data" value="<?php echo $keyword; ?>">
                    <button type="submit" class="btn btn-cari">Cari</button>
                </form>
            </div>
        </div>

        <h3 style="margin-top: 0;">DATA BARANG</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Barang</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th class="image-cell">Gambar</th>
                    <th class="action-cell">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($data_barang)) {
                    foreach($data_barang as $row){
                        $harga_beli_formatted = "Rp " . number_format($row['harga_beli'], 2, ',', '.');
                        $harga_jual_formatted = "Rp " . number_format($row['harga_jual'], 2, ',', '.');
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row['kd_barang']; ?></td>
                        <td><?php echo $row['nama_barang']; ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td><?php echo $harga_beli_formatted; ?></td>
                        <td><?php echo $harga_jual_formatted; ?></td>
                        <td class="image-cell">
                            <?php 
                            if(!empty($row['gambar_produk']) && file_exists('gambar/'.$row['gambar_produk'])){
                                echo '<img src="gambar/' . $row['gambar_produk'] . '" alt="Produk">';
                            } else {
                                echo '<span style="font-size:10px; color:red;">No Image</span>';
                            }
                            ?>
                        </td>
                        <td class="action-cell">
                            <a href="edit_barang.php?id_barang=<?php echo $row['id_barang']; ?>" class="btn btn-edit">Edit</a>
                            <a href="proses_barang.php?action=delete&id_barang=<?php echo $row['id_barang']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center; padding: 20px;'>Data tidak ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if($halaman > 1): ?>
                <a class="page-link" href="?halaman=<?php echo $halaman - 1; ?>&Cari=<?php echo $keyword; ?>&kategori=<?php echo $kategori_pilih; ?>">Previous</a>
            <?php endif; ?>

            <?php for($x = 1; $x <= $total_halaman; $x++): ?>
                <?php if($x == $halaman): ?>
                    <a class="page-link active" href="?halaman=<?php echo $x; ?>&Cari=<?php echo $keyword; ?>&kategori=<?php echo $kategori_pilih; ?>"><?php echo $x; ?></a>
                <?php else: ?>
                    <a class="page-link" href="?halaman=<?php echo $x; ?>&Cari=<?php echo $keyword; ?>&kategori=<?php echo $kategori_pilih; ?>"><?php echo $x; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($halaman < $total_halaman): ?>
                <a class="page-link" href="?halaman=<?php echo $halaman + 1; ?>&Cari=<?php echo $keyword; ?>&kategori=<?php echo $kategori_pilih; ?>">Next</a>
            <?php endif; ?>
        </div>
        
        <div class="print-satuan-area">
            <form action="proses_barang.php?action=print_satuan" method="post">
                <input type="text" name="nama_barang" placeholder="Ketik Nama Barang..." required>
                <input type="submit" class="btn btn-print" value="Print Satuan Barang">
            </form>
        </div>

    </div>
</body>
</html>