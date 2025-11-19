<?php 
class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "belajar_oop";
    var $koneksi = "";

    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function tampil_data() {
        $data = mysqli_query($this->koneksi,"select * from tb_barang");
        $hasil = [];
        while($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }

    // ===================================================================
    // == FUNGSI CARI (SUDAH DI-UPGRADE)
    // == Menerima parameter $kategori untuk menentukan kolom pencarian
    // ===================================================================
    function cari_data_barang($keyword, $kategori) {
        
        // Cek kategori apa yang diminta
        if($kategori == "kode") {
            // Jika kategori adalah 'kode', cari di kolom 'kd_barang'
            $query = "select * from tb_barang where kd_barang like '%$keyword%'";
        } else {
            // Jika kategori 'nama' (atau lainnya), cari di kolom 'nama_barang'
            $query = "select * from tb_barang where nama_barang like '%$keyword%'";
        }
        
        $data = mysqli_query($this->koneksi, $query);
        $hasil = [];
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row; 
        }
        return $hasil;
    }

    function tampil_edit_data($id_barang) {
        $data = mysqli_query($this->koneksi,"select * from tb_barang where id_barang='$id_barang'");
        $hasil = [];
        while($d = mysqli_fetch_array($data)){ $hasil[] = $d; }
        return $hasil;
    }

    function delete_data($id_barang) {
        $dt = $this->tampil_edit_data($id_barang);
        if(!empty($dt[0]['gambar_produk']) && file_exists('gambar/'.$dt[0]['gambar_produk'])) {
            unlink('gambar/'.$dt[0]['gambar_produk']);
        }
        mysqli_query($this->koneksi,"delete from tb_barang where id_barang='$id_barang'");
    }

    function kode_barang() {
        $data = mysqli_query($this->koneksi, "SELECT MAX(kd_barang) as kd_barang FROM tb_barang");
        $hasil = [];
        while($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }

    // ===================================================================
    // == FUNGSI TAMBAH DATA BARANG
    // ===================================================================
    function tambah_data($kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk)
    {
        $nama_gambar_baru = null;
        if (!empty($gambar_produk['name'])) {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk['name']);
            $ekstensi = strtolower(end($x));
            $file_tmp = $gambar_produk['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk['name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_barang.php';</script>";
                return false; 
            }
        }
        
        $query = "insert into tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) values ('$kd_barang','$nama_barang','$stok','$harga_beli','$harga_jual', '$nama_gambar_baru')";
        $result = mysqli_query($this->koneksi, $query);
        
        if (!$result) {
             die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
        }
    }

    // ===================================================================
    // == FUNGSI EDIT DATA BARANG
    // ===================================================================
    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk)
    {
        if (!empty($gambar_produk['name'])) {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk['name']);
            $ekstensi = strtolower(end($x));
            $file_tmp = $gambar_produk['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk['name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);
                $query = "update tb_barang set nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$nama_gambar_baru' where id_barang='$id_barang'";
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='edit_barang.php?id_barang=$id_barang';</script>";
                return false;
            }
        } else {
            $query = "update tb_barang set nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' where id_barang='$id_barang'";
        }
        
        $result = mysqli_query($this->koneksi, $query);
        if (!$result) {
             die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
        }
    }

    function tampil_data_customer() {
        $data = mysqli_query($this->koneksi,"select * from tb_customer"); 
        $hasil = [];
        while($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }
    function tampil_data_supplier() {
        $data = mysqli_query($this->koneksi,"select * from tb_supplier");
        $hasil = [];
        while($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }
    function hitung_data_barang() {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(id_barang) as total FROM tb_barang");
        $row = mysqli_fetch_array($data);
        return $row['total'];
    }
    function hitung_data_customer() {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(id_customer) as total FROM tb_customer");
        $row = mysqli_fetch_array($data);
        return $row['total'];
    }
    function hitung_data_supplier() {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(id_supplier) as total FROM tb_supplier");
        $row = mysqli_fetch_array($data);
        return $row['total'];
    }

} 
?>