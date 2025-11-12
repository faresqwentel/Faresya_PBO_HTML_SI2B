<?php
class database
{
    var $host = "localhost";
    var $username = "root";
    var $password = ""; // Password biasanya kosong di XAMPP default
    var $database = "belajar_oop2";
    var $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "select * from tb_barang");
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_data($kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk)
    {
        if ($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk;

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);
                $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) VALUES ('$kd_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
                $result = mysqli_query($this->koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='tambah_data.php';</script>";
            }
        } else {
            $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual) VALUES ('$kd_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual')";
            $result = mysqli_query($this->koneksi, $query);
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil ditambah.');window.location='tampil.php';</script>";
            }
        }
    }

    function tampil_edit_data($id_barang)
    {
        $data = mysqli_query($this->koneksi, "select * from tb_barang where id_barang='$id_barang'");
        $hasil = [];
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk)
    {
        if ($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk;

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);
                $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$nama_gambar_baru'";
                $query .= " WHERE id_barang='$id_barang'";
                $result = mysqli_query($this->koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil diubah.');window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='edit_data.php?id_barang=$id_barang';</script>";
            }
        } else {
            $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual'";
            $query .= " WHERE id_barang='$id_barang'";
            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil diubah.');window.location='tampil.php';</script>";
            }
        }
    }

    function delete_data($id_barang)
    {
        mysqli_query($this->koneksi, "delete from tb_barang where id_barang='$id_barang'");
    }

    
    function kode_barang()
    {
        $data = mysqli_query($this->koneksi, "SELECT MAX(kd_barang) as kd_barang FROM tb_barang");
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function cari_data($cari, $kriteria)
    {
        $query = "SELECT * FROM tb_barang WHERE $kriteria LIKE '%$cari%'";
        $data = mysqli_query($this->koneksi, $query);
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Fungsi login ini BELUM ADA KODENYA di PDF
    // Anda harus menambahkannya sendiri
    function login($username, $password) {
        $query = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
        $cek = mysqli_num_rows($query);
        
        if($cek > 0){
            // Mulai session
            session_start();
            $data = mysqli_fetch_array($query);
            
            // Buat session
            $_SESSION['username'] = $data['username'];
            $_SESSION['tipe_user'] = $data['tipe_user'];
            
            // Redirect ke halaman tampil.php
            header("location:tampil.php");
        }else{
            echo "<script>alert('Username atau Password salah!');window.location='index.php';</script>";
        }
    }

    // Fungsi logout ini BELUM ADA KODENYA di PDF
    function logout() {
        session_start();
        session_destroy();
        header("location:index.php");
    }
}
?>