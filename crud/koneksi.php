<?php
// koneksi.php — versi rapi & aman (MySQLi + prepared statements)
class database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "belajar_oop";
    public  $koneksi; // mysqli

    function __construct(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->koneksi = new mysqli($this->host, $this->username, $this->password, $this->database);
        $this->koneksi->set_charset('utf8mb4');
    }

    // 1) Tampil semua
    function tampil_data(){
        $hasil = [];
        $sql = "SELECT id_barang, nama_barang, stok, harga_beli, harga_jual FROM tb_barang ORDER BY id_barang";
        $res = $this->koneksi->query($sql);
        if ($res) $hasil = $res->fetch_all(MYSQLI_ASSOC);
        return $hasil;
    }

    // 2) Tambah (id_barang AUTO_INCREMENT — tidak disertakan)
    function tambah_data($nama_barang, $stok, $harga_beli, $harga_jual){
        $stmt = $this->koneksi->prepare(
            "INSERT INTO tb_barang (nama_barang, stok, harga_beli, harga_jual) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("siii", $nama_barang, $stok, $harga_beli, $harga_jual);
        return $stmt->execute();
    }

    // 3) Ambil satu untuk form edit
    function tampil_edit_data($id_barang){
        $stmt = $this->koneksi->prepare(
            "SELECT id_barang, nama_barang, stok, harga_beli, harga_jual FROM tb_barang WHERE id_barang = ?"
        );
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }

    // 4) Update
    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        $stmt = $this->koneksi->prepare(
            "UPDATE tb_barang
             SET nama_barang = ?, stok = ?, harga_beli = ?, harga_jual = ?
             WHERE id_barang = ?"
        );
        $stmt->bind_param("siiii", $nama_barang, $stok, $harga_beli, $harga_jual, $id_barang);
        return $stmt->execute();
    }

    // 5) Hapus
    function delete_data($id_barang){
        $stmt = $this->koneksi->prepare("DELETE FROM tb_barang WHERE id_barang = ?");
        $stmt->bind_param("i", $id_barang);
        return $stmt->execute();
    }

    // 6) Cari by nama (LIKE)
    function cari_data($keyword){
        $hasil = [];
        $like = "%{$keyword}%";
        $stmt = $this->koneksi->prepare(
            "SELECT id_barang, nama_barang, stok, harga_beli, harga_jual
             FROM tb_barang
             WHERE nama_barang LIKE ?
             ORDER BY id_barang"
        );
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $hasil;
    }

    // 7) Fungsi baru untuk cek login (SUDAH DIPERBAIKI)
    function cek_login($username) {
        $stmt = $this->koneksi->prepare(
            "SELECT * FROM user WHERE username = ?" // <-- PERUBAHAN DI SINI
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Kembalikan data user jika ditemukan, atau null jika tidak
        return $result->fetch_assoc(); 
    }
} // <-- Penutup class database
?>