<?php
session_start();
// jika tidak ada session login

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

$sesionnama = $_SESSION["nama"];

if ($sesionnama === 'admin') {
    $header = true;
    $ubahhapus = true;
} else if ($sesionnama === 'user') {
    $headeruser = true;
} else {
    $header = true;
}


require 'function.php';

$jumlahlaporanperhalaman = 8;
$baris = mysqli_query($conn, "SELECT * FROM laporanweb");
$jumdata = mysqli_num_rows($baris);
$jumhalaman = ceil($jumdata / $jumlahlaporanperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahlaporanperhalaman * $halamanaktif) - $jumlahlaporanperhalaman;

// ambil data dati tabel 
$laporan = query("SELECT * FROM laporanweb ORDER BY id DESC LIMIT $awaldata, $jumlahlaporanperhalaman");

if (isset($_POST["tombolcari2"])) {
    $laporan = cari3($_POST["carilaporan"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleberanda.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Secular+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>AdaSampah-Beranda</title>
</head>

<body style="background-color: #68b984;">

    <!-- header -->
    <div class="carousel cr">
        <div class="header">
            <img style="width: 200px;" src="../img/logoasli.png" alt="">
            <div class="user">
                <h1>Halo, <?php echo $_SESSION["nama"]; ?></h1>
                <?php if (isset($header)) : ?>
                    <p>Jadilah Pahlawan dan bantu Kota mu dari sampah pengganggu kesehatan</p>
                    <button onClick="document.location.href='beranda.php'" class="button-lapor" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i style="margin-right: 5px;" class="fa-solid fa-arrow-left"></i>Kembali ke beranda</button>
                <?php endif; ?>
                <?php if (isset($headeruser)) : ?>
                    <p>Mulai masuk dengan akun dan jadilah pahlawan kebersihan untuk kotamu</p>
                    <button onClick="document.location.href='beranda.php'" class="button-lapor" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i style="margin-right: 5px;" class="fa-solid fa-arrow-left"></i> Kembali ke beranda</button>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- cari -->
    <div class="judul2">
        <h2><i style="margin-right: 10px;" class="uploadlogo fa-solid fa-clone"></i>Semua Laporan pengguna</h2>
    </div>
    <div class="carimateri">
        <form action="" method="post">
            <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
            <input autocomplete="off" type="search" name="carilaporan" placeholder="Cari laporan Anda">
            <button type="submit" name="tombolcari2">Cari</button>
        </form>
    </div>

    <!-- semua laporan -->
    <div class="halamanbungkus">
        <p>Laporan : </p>
        <?php if ($halamanaktif > 1) : ?>
            <a href="?halaman=<?= $halamanaktif - 1 ?>">&lt;</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $jumhalaman; $i++) : ?>
            <?php if ($i == $halamanaktif) : ?>
                <a href="semualaporan.php?halaman=<?= $i ?>" style="color:white; background-color:black;"><?= $i ?></a>
            <?php else : ?>
                <a href="semualaporan.php?halaman=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($halamanaktif < $jumhalaman) : ?>
            <a href="?halaman=<?= $halamanaktif + 1 ?>">&gt;</a>
        <?php endif; ?>
    </div>
    <div class="row" style=" margin:auto; margin-top:20px;">
        <!-- foreach -->
        <?php foreach ($laporan as $laporan2) :  ?>
            <div class="col">
                <div class="card" style="margin-bottom:20px;">
                    <img src="../img/<?= $laporan2["gambar"]; ?>" class="card-img-top" alt="...">
                    <div class="card-body" style="height:235px; ">
                        <div class=" judulcard">
                            <i style="margin-right: 10px; margin-top:5px;" class="fa-sharp fa-solid fa-building-wheat"></i>
                            <h5 class="card-title"><?= $laporan2["kota"]; ?></h5>
                        </div>
                        <input type="hidden" name="" id="idlapor" value="<?= $laporan2["id"]; ?>">
                        <div class="judulcard">
                            <p style="font-size: 12px;"><?= $laporan2["lokasi"]; ?></p>
                        </div>
                        <div class="judulcard">
                            <i style="margin-right: 10px;" class="fa-solid fa-user fa-1x nama"></i>
                            <h6 styclass="card-title">Oleh <?= $laporan2["nama"]; ?></h6>
                        </div>
                        <p style="font-size: 12px;">Telp : <?= $laporan2["telepon"]; ?></p>
                        <div class="desklapor">
                            <p class="card-text"><?= $laporan2["deskripsi"]; ?></p>
                        </div>
                    </div>

                    <!-- footer -->
                    <div class="card-footer" style="display: flex; justify-content:space-between;">
                        <small class="text-muted">Post pada <?= $laporan2["tanggal"]; ?></small>
                        <div>
                            <?php if (isset($ubahhapus)) : ?>
                                <a id="hapuslaporan" style="color:black;"><i class="fa-solid fa-trash"></i></a>
                                <a id="ubahlaporan" style="color: black; margin-left:10px;"><i class="fa-sharp fa-solid fa-pen-to-square ubahlogo2"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- endforeach -->
    </div>


    <!-- footer -->
    <div class="footer">
        <div class="sosmed">
            <i class="wa fa-brands fa-whatsapp fa-2x"></i>
            <i class="ig fa-brands fa-instagram fa-2x"></i>
            <i class="link fa-brands fa-chrome fa-2x"></i>
        </div>
        <div class="emailfot">
            <p>adasampah@gmail.com</p>
        </div>
    </div>
    <!-- jquery -->
    <script src="../alert/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="../js/scriptsemua.js"></script>

</body>

</html>