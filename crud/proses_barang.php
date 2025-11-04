<?php
// proses_barang.php
declare(strict_types=1);

require __DIR__ . '/koneksi.php';

$db      = new Database();
$action  = $_GET['action'] ?? '';

// helper redirect
function go(string $url, string $msg = ''): never {
    if ($msg !== '') $url .= (str_contains($url, '?') ? '&' : '?') . 'msg=' . urlencode($msg);
    header('Location: ' . $url, true, 303);
    exit;
}

switch ($action) {

    case 'add':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') go('index.php', 'Metode salah');
        $nama  = trim($_POST['nama_barang'] ?? '');
        $stok  = (int) ($_POST['stok'] ?? 0);
        $beli  = (int) ($_POST['harga_beli'] ?? 0);
        $jual  = (int) ($_POST['harga_jual'] ?? 0);

        // validasi sederhana
        if ($nama === '' || $stok < 0 || $beli < 0 || $jual < 0) {
            go('index.php', 'Data tidak valid');
        }

        $ok = $db->tambah_data($nama, $stok, $beli, $jual);
        go('index.php', $ok ? 'Tambah berhasil' : 'Tambah gagal');
        // no break

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') go('index.php', 'Metode salah');
        $id    = (int) ($_POST['id_barang'] ?? 0);
        $nama  = trim($_POST['nama_barang'] ?? '');
        $stok  = (int) ($_POST['stok'] ?? 0);
        $beli  = (int) ($_POST['harga_beli'] ?? 0);
        $jual  = (int) ($_POST['harga_jual'] ?? 0);

        if ($id <= 0 || $nama === '') {
            go('index.php', 'ID/Nama tidak valid');
        }

        $ok = $db->edit_data($id, $nama, $stok, $beli, $jual);
        go('index.php', $ok ? 'Edit berhasil' : 'Edit gagal');
        // no break

    case 'delete':
        $id = (int) ($_GET['id_barang'] ?? 0);
        if ($id <= 0) go('index.php', 'ID tidak valid');
        $ok = $db->delete_data($id);
        go('index.php', $ok ? 'Hapus berhasil' : 'Hapus gagal');
        // no break

    case 'search':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') go('index.php', 'Metode salah');
        $q = trim($_POST['nama_barang'] ?? '');
        // arahkan ke halaman hasil cari dengan query string ?q=
        go('cari_data.php?q=' . urlencode($q));
        // no break

    default:
        go('index.php', 'Aksi tidak dikenali');
}
