<?php
// koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "adasampah");

// query atau menangkap data tabel materi

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// menambahkan materi 
function tambahmateri($data)
{
    global $conn;
    $judul = htmlspecialchars($data["judul"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);


    // upload gambar dulu
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    // query data
    $query = "INSERT INTO materiweb VALUES ('', '$judul', '$deskripsi', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    // cek apakah gambar tidak di upload
    if ($error === 4) {
        echo "
        <script>
        alert('Pilih gambar terlebih dahulu');
        </script>
        ";
        return false;
    }
    // cek apakah yang diupload itu gambar
    $ektensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    // apakah gambar sesuai dengan syarat jpg jpeg png
    if (!in_array($ekstensigambar, $ektensigambarvalid)) {
        echo "
        <script>
        alert('Yang anda upload bukan gambar!');
        </script>
        ";
        return false;
    }

    // cek jika ukurannya terlalu besar dari 4 mb
    if ($ukuranfile > 4000000) {
        echo "
        <script>
        alert('Ukuran gambar melebihi 4MB!');
        </script>
        ";
        return false;
    }

    // lolos semua pengecekan
    // generater nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;
    // var_dump($namafilebaru);
    move_uploaded_file($tmpname, '../img/' . $namafilebaru);
    // var_dump($namafilebaru);
    return $namafilebaru;
}

function tambahlaporan($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $kota = htmlspecialchars($data["kota"]);
    $lokasi = htmlspecialchars($data["lokasi"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $sesinama = htmlspecialchars($data["sesinama"]);

    // jika kota salah
    if ($kota == "gagal") {
        echo "
        <script>
        alert('Pengiriman laporan GAGAL! Pilih Kota yang benar');
        document.location.href = 'beranda.php';
        </script>
        ";
        exit;
    }
    // upload gambar dulu
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query data
    $query = "INSERT INTO laporanweb VALUES ('', '$nama', '$telepon', '$kota', '$lokasi', '$tanggal', '$deskripsi', '$gambar', '$sesinama')";
    mysqli_query($conn, $query);
    return $gambar;
}

// Hapus materi 
function hapus($hapus)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM materiweb WHERE id = $hapus");
    return mysqli_affected_rows($conn);
}

// Hapus laporan 
function hapus2($hapus)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM laporanweb WHERE id = $hapus");
    return mysqli_affected_rows($conn);
}


// ubah materi

function ubah1($data)
{
    global $conn;
    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    // query data

    $query = "UPDATE materiweb SET
                judul = '$judul',
                deskripsi = '$deskripsi',
                gambar = '$gambar'
                WHERE id = $id;
                ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ubah laporan

function ubah2($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $kota = htmlspecialchars($data["kota"]);
    $lokasi = htmlspecialchars($data["lokasi"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $sesinama = htmlspecialchars($data["sesinama"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }
    // query data

    $query = "UPDATE laporanweb SET
                nama = '$nama',
                telepon = '$telepon',
                kota = '$kota',
                lokasi = '$lokasi',
                tanggal = '$tanggal',
                deskripsi = '$deskripsi',
                gambar = '$gambar',
                sesinama = '$sesinama'
                WHERE id = $id;
                ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// cari materi

function cari($data)
{
    $query = "SELECT * FROM materiweb 
                    WHERE
                    judul LIKE '%$data%'";
    return query($query);
}

function cari2($data, $data2)
{
    $query = "SELECT * FROM laporanweb 
                    WHERE sesinama = '$data2' AND
                    nama LIKE '%$data%' OR
                    telepon LIKE '%$data%' OR
                    kota LIKE '%$data%' OR
                    lokasi LIKE '%$data%' OR
                    tanggal LIKE '%$data%' OR
                    deskripsi LIKE '%$data%' OR
                    gambar LIKE '%$data%'
                    
                    ";
    return query($query);
}

function cari3($data)
{
    $query = "SELECT * FROM laporanweb WHERE
                    nama LIKE '%$data%' OR
                    telepon LIKE '%$data%' OR
                    kota LIKE '%$data%' OR
                    lokasi LIKE '%$data%' OR
                    tanggal LIKE '%$data%' OR
                    deskripsi LIKE '%$data%' OR
                    gambar LIKE '%$data%'
                    
                    ";
    return query($query);
}


// registrasi

function registrasi($data)
{

    global $conn;
    $nama = strtolower(stripslashes($data["nama"]));
    $katasandi = mysqli_real_escape_string($conn, $data["katasandi"]);
    $katasandi2 = mysqli_real_escape_string($conn, $data["katasandi2"]);

    // cek konfirmasi password
    if ($katasandi !== $katasandi2) {
        echo "
        <script>
        alert('Konfirmasi Password tidak sesuai!');
        </script>
        ";
        return false;
    }
    // username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT nama FROM user WHERE nama = '$nama'");

    // apabila result bernilai true atau 1
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
        alert('Username sudah terdaftar!');
        </script>
        ";
        return false;
    }

    // enkripsi dulu passwordnya
    $katasandi = password_hash($katasandi, PASSWORD_DEFAULT);
    // insert database
    mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$katasandi')");

    return mysqli_affected_rows($conn);
}
