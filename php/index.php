<?php
session_start();
require 'function.php';
// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $katasandi = $_POST["katasandi"];
    $result = mysqli_query($conn, "SELECT nama FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['nama'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: beranda.php");
}





// masuk dengan user
if (isset($_POST['user'])) {
    // set session
    $_SESSION["login"] = true;
    $_SESSION["nama"] = 'user';
    header("Location: beranda.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdaSampah-Masuk</title>
    <link rel="stylesheet" href="../css/styleindex.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="../img/logoasli.png" alt="">
        </div>
        <div class="menu">
            <button class="klik-beranda">Beranda</button>
            <button class="klik-masuk">Masuk</button>
            <button class="klik-daftar">Daftar</button>
            <button class="klik-tentang">Tentang</button>
        </div>
    </div>
    <div class="container">
        <div class="container1">
            <img src="../img/logo4.png" alt="">
        </div>
        <div class="container2">
            <div class="start">
                <h1 class="kata-kata"></h1>
                <p class="kata-kata2"></p>
                <form action="" method="post">
                    <button name="user" type="submit" class="button-33" role="button">Mulai jadi pahlawan</button>
                </form>
                <div class="masuk form">
                    <form action="" method="post">
                        <p>Nama akun : </p>
                        <input name="nama" type="text" class="user" id="nama" autocomplete="off">
                        <p>Kata sandi : </p>
                        <input name="katasandi" type="password" class="pw" autocomplete="off">
                        <div class="remember">
                            <input type="checkbox" name="ingat" id="">
                            <p>ingat saya</p>
                        </div>
                        <button name="masuk" type="submit" class="login">MASUK</button>
                    </form>
                </div>
                <div class="form daftar">
                    <form action="" method="post">
                        <p>Nama akun : </p>
                        <input required autocomplete="off" value="" name="nama" type="text" class="user">
                        <p>Kata sandi : </p>
                        <input required autocomplete="off" name="katasandi" type="password" class="pw">
                        <p>Konfirmasi Kata sandi : </p>
                        <input required autocomplete="off" name="katasandi2" type="password" class="pw">
                        <button name="daftar" type="submit" class="regis">Daftar</button>
                    </form>
                </div>
                <div class="tentang">
                    <h2>Website AdaSampah</h2>
                    <p>Website ini di buat dengan tujuan sebagai bentuk partisipasi dari masyarakat untuk membantu Dinas Lingkungan Hidup di
                        Kabupaten atau Kota Jawa Barat dalam melaksanakan tugasnya. Fitur utama website ini adalah mengirim laporan lingkungan yang kotor ke Email DLH kabupaten dan Kota di Jawa Barat.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script src="../js/scriptindex2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
    <script src="../alert/dist/sweetalert2.all.min.js"></script>

    <?php


    // masuk/login
    if (isset($_POST['masuk'])) {
        $nama = $_POST["nama"];
        $katasandi = $_POST["katasandi"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$nama'");

        // cek username apakah benar (jika benar menghasilkan 1)
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // jika true
            if (password_verify($katasandi, $row["katasandi"])) {

                // set session
                $_SESSION["login"] = true;
                $_SESSION["nama"] = $nama;

                // cek remember me 

                if (isset($_POST['ingat'])) {
                    // buat cookie
                    $_SESSION["nama"] = $nama;
                    setcookie('id', $row['id'], time() + 6000);
                    setcookie('key', hash('sha256', $row['nama']), time() + 6000);
                }
                echo "
                <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Selamat Datang',
                    text: 'Berhasil masuk dengan akun anda',
                    showConfirmButton: false,
                  });
                  setInterval( () => {
                    window.location.href = 'beranda.php';
                 }, 2000);
                </script>";
                exit;
            } else {

                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Masuk!',
                    text: 'Pastikan Nama akun dan katasandi sesuai dengan akun anda',
                    showConfirmButton: false,
                  });
                  setInterval( () => {
                    window.location.href = 'index.php';
                 }, 2000);
                      </script>";
            }
        }
    }

    //REGIS
    if (isset($_POST['daftar'])) {
        if (registrasi($_POST) > 0) {

            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Akun baru berhasil di tambahkan',
                text: 'Segera masuk dengan akun baru anda',
                showConfirmButton: false,
              });
              setInterval( () => {
                window.location.href = 'index.php';
             }, 2000);
            </script>";
        } else {
            echo mysqli_error($conn);
        }
    }

    ?>
</body>

</html>