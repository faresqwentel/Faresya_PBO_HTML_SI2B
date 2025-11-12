<?php
include('koneksi.php'); [cite: 1177]
$db = new database(); [cite: 1179]
?>
<!DOCTYPE html> [cite: 1186]
<html>
<head> [cite: 1188]
    <title>Cetak Laporan</title> [cite: 1189]
</head>
<body> [cite: 1202]
    <h2>LAPORAN DATA BARANG CV JAYA</h2> [cite: 1205]
    <table width="667" border="1"> [cite: 1206]
        <tr> [cite: 1207]
            <th width="21">No</th> [cite: 1208]
            <th width="122">Kode Barang</th> [cite: 1209]
            <th width="158">Barang</th> [cite: 1216]
            <th width="47">Stok</th> [cite: 1218]
            <th width="76">Harga Beli</th> [cite: 1220]
            <th width="83">Harga Jual</th> [cite: 1222]
            <th width="114">Keuntungan</th> [cite: 1224]
        </tr> [cite: 1226]
        
        <?php
        $data_barang = $db->tampil_data(); [cite: 1233, 1236]
        $no = 1; [cite: 1234]
        foreach ($data_barang as $row) { [cite: 1235]
        ?>
        <tr> [cite: 1240]
            <td><?php echo $no++; ?></td> [cite: 1242]
            <td><?php echo $row['kd_barang']; ?></td> [cite: 1248]
            <td><?php echo $row['nama_barang']; ?></td> [cite: 1249]
            <td><?php echo $row['stok']; ?></td> [cite: 1250]
            <td><?php echo $row['harga_beli']; ?></td> [cite: 1251]
            <td><?php echo $row['harga_jual']; ?></td> [cite: 1252]
            <td><?php echo ($row['harga_jual'] - $row['harga_beli']); ?></td> [cite: 1255]
        </tr> [cite: 1257]
        <?php
        }
        ?>
    </table> [cite: 1265]
    
    <script>
        window.print(); [cite: 1269]
    </script> [cite: 1271]
</body> [cite: 1273]
</html> [cite: 1275]