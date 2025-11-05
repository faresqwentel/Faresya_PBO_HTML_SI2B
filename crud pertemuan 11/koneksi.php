<?php
// koneksi.php — VERSI FINAL
class database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "belajar_oop";
    public  $koneksi; 

    function __construct(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->koneksi = new mysqli($this->host, $this->username, $this->password, $this->database);
        $this->koneksi->set_charset('utf8mb4');
    }

    // ===========================================
    // --- FUNGSI LOGIN ---
    // ===========================================
    function cek_login($username) {
        $stmt = $this->koneksi->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }

    // ===========================================
    // --- FUNGSI CRUD BARANG ---
    // ===========================================
    function tampil_data(){
        $hasil = [];
        $sql = "SELECT * FROM tb_barang ORDER BY id_barang";
        $res = $this->koneksi->query($sql);
        if ($res) $hasil = $res->fetch_all(MYSQLI_ASSOC);
        return $hasil;
    }
    function tambah_data($nama_barang, $stok, $harga_beli, $harga_jual){
        $stmt = $this->koneksi->prepare("INSERT INTO tb_barang (nama_barang, stok, harga_beli, harga_jual) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $nama_barang, $stok, $harga_beli, $harga_jual);
        return $stmt->execute();
    }
    function tampil_edit_data($id_barang){
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_barang WHERE id_barang = ?");
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }
    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        $stmt = $this->koneksi->prepare("UPDATE tb_barang SET nama_barang = ?, stok = ?, harga_beli = ?, harga_jual = ? WHERE id_barang = ?");
        $stmt->bind_param("siiii", $nama_barang, $stok, $harga_beli, $harga_jual, $id_barang);
        return $stmt->execute();
    }
    function delete_data($id_barang){
        $stmt = $this->koneksi->prepare("DELETE FROM tb_barang WHERE id_barang = ?");
        $stmt->bind_param("i", $id_barang);
        return $stmt->execute();
    }
    function cari_data($keyword){
        $hasil = []; $like = "%{$keyword}%";
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_barang WHERE nama_barang LIKE ? ORDER BY id_barang");
        $stmt->bind_param("s", $like); $stmt->execute();
        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); return $hasil;
    }

    // ===========================================
    // --- FUNGSI CRUD CUSTOMER ---
    // ===========================================
    function tampil_customer(){
        $hasil = [];
        $sql = "SELECT * FROM tb_customer ORDER BY id_customer";
        $res = $this->koneksi->query($sql);
        if ($res) $hasil = $res->fetch_all(MYSQLI_ASSOC);
        return $hasil;
    }
    function tambah_customer($id, $nik, $nama, $jk, $alamat, $telp, $email, $pass){
        $stmt = $this->koneksi->prepare(
            "INSERT INTO tb_customer (id_customer, nik_customer, nama_customer, jenis_kelamin, alamat_customer, telepon_customer, email_customer, pass_customer) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssssss", $id, $nik, $nama, $jk, $alamat, $telp, $email, $pass);
        return $stmt->execute();
    }
    function tampil_edit_customer($id_customer){
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_customer WHERE id_customer = ?");
        $stmt->bind_param("s", $id_customer);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }
    function edit_customer($id, $nik, $nama, $jk, $alamat, $telp, $email, $pass){
        $stmt = $this->koneksi->prepare(
            "UPDATE tb_customer 
             SET nik_customer = ?, nama_customer = ?, jenis_kelamin = ?, alamat_customer = ?, telepon_customer = ?, email_customer = ?, pass_customer = ?
             WHERE id_customer = ?"
        );
        $stmt->bind_param("ssssssss", $nik, $nama, $jk, $alamat, $telp, $email, $pass, $id);
        return $stmt->execute();
    }
    function delete_customer($id_customer){
        $stmt = $this->koneksi->prepare("DELETE FROM tb_customer WHERE id_customer = ?");
        $stmt->bind_param("s", $id_customer);
        return $stmt->execute();
    }
    function cari_customer($keyword){
        $hasil = []; $like = "%{$keyword}%";
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_customer WHERE nama_customer LIKE ? ORDER BY id_customer");
        $stmt->bind_param("s", $like); $stmt->execute();
        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); return $hasil;
    }
    // FUNGSI GENERATOR ID CUSTOMER
    function get_next_customer_id(){
        $sql = "SELECT id_customer FROM tb_customer ORDER BY id_customer DESC LIMIT 1";
        $res = $this->koneksi->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $latest_id = $row['id_customer']; // "CST003"
            $num_part = (int) substr($latest_id, 3); // 3
            $num_part++; // 4
            $new_num_part = str_pad((string)$num_part, 3, "0", STR_PAD_LEFT); // "004"
            return "CST" . $new_num_part; // "CST004"
        } else {
            return "CST001"; // Ini data pertama
        }
    }

    // ===========================================
    // --- FUNGSI CRUD SUPPLIER ---
    // ===========================================
    function tampil_supplier(){
        $hasil = [];
        $sql = "SELECT * FROM tb_supplier ORDER BY id_supplier";
        $res = $this->koneksi->query($sql);
        if ($res) $hasil = $res->fetch_all(MYSQLI_ASSOC);
        return $hasil;
    }
    function tambah_supplier($id, $nama, $alamat, $telp, $email, $pass){
        $stmt = $this->koneksi->prepare(
            "INSERT INTO tb_supplier (id_supplier, nama_supplier, alamat_supplier, telepon_supplier, email_supplier, pass_supplier) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssss", $id, $nama, $alamat, $telp, $email, $pass);
        return $stmt->execute();
    }
    function tampil_edit_supplier($id_supplier){
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_supplier WHERE id_supplier = ?");
        $stmt->bind_param("s", $id_supplier);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }
    function edit_supplier($id, $nama, $alamat, $telp, $email, $pass){
        $stmt = $this->koneksi->prepare(
            "UPDATE tb_supplier 
             SET nama_supplier = ?, alamat_supplier = ?, telepon_supplier = ?, email_supplier = ?, pass_supplier = ?
             WHERE id_supplier = ?"
        );
        $stmt->bind_param("ssssss", $nama, $alamat, $telp, $email, $pass, $id);
        return $stmt->execute();
    }
    function delete_supplier($id_supplier){
        $stmt = $this->koneksi->prepare("DELETE FROM tb_supplier WHERE id_supplier = ?");
        $stmt->bind_param("s", $id_supplier);
        return $stmt->execute();
    }
    function cari_supplier($keyword){
        $hasil = []; $like = "%{$keyword}%";
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_supplier WHERE nama_supplier LIKE ? ORDER BY id_supplier");
        $stmt->bind_param("s", $like); $stmt->execute();
        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); return $hasil;
    }
    // FUNGSI GENERATOR ID SUPPLIER
    function get_next_supplier_id(){
        $sql = "SELECT id_supplier FROM tb_supplier ORDER BY id_supplier DESC LIMIT 1";
        $res = $this->koneksi->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $latest_id = $row['id_supplier']; // "SUPP001"
            $num_part = (int) substr($latest_id, 4); // 1 (prefix 4 huruf)
            $num_part++; // 2
            $new_num_part = str_pad((string)$num_part, 3, "0", STR_PAD_LEFT); // "002"
            return "SUPP" . $new_num_part; // "SUPP002"
        } else {
            return "SUPP001"; // Ini data pertama
        }
    }
}
?>