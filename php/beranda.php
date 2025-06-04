<?php
session_start();
require 'function.php';
// cek cookie


// jika tidak ada session login

if (!isset($_SESSION["login"])) {
  header("Location: index.php");
}

$sesionnama = $_SESSION["nama"];
// crud pembatasan 
if ($sesionnama === 'admin') {
  $tambahmateri = true;
  $ubahhapusmateri = true;
  $keluar = true;
  $headeradmin = true;
  $laporananda = true;
} else if ($sesionnama === 'user') {
  $headeruser = true;
  $laporanuser = true;
} else {
  $header = true;
  $keluar = true;
  $laporananda = true;
}


// ambil data dati tabel 

// pagination
// konfigurasi


$jumlahlaporanperhalaman = 4;
$baris = mysqli_query($conn, "SELECT * FROM laporanweb WHERE sesinama = '$sesionnama'");
$jumdata = mysqli_num_rows($baris);
$jumhalaman = ceil($jumdata / $jumlahlaporanperhalaman);

$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahlaporanperhalaman * $halamanaktif) - $jumlahlaporanperhalaman;
// var_dump($awaldata);

$materi = query("SELECT * FROM materiweb");
$laporan = query("SELECT * FROM laporanweb WHERE sesinama = '$sesionnama' LIMIT $awaldata,$jumlahlaporanperhalaman");



// cari materi
if (isset($_POST["tombolcari"])) {
  $materi = cari($_POST["carimateri"]);
}
// cari laporan
if (isset($_POST["tombolcari2"])) {
  $laporan = cari2($_POST["carilaporan"], $sesionnama);
}

// ketika submit materi 


// if (isset($_POST["tombollaporan"])) {

//   if (tambahlaporan($_POST) > 0) {
//     echo "
//     <script>
//     alert('Laporan baru berhasil di tambahkan');
//     document.location.href = 'kirim.php';
//     </script>
//     ";
//   } else {
//     echo "
//     <script>alert('Laporan baru gagal di tambahkan');</script>
//     ";
//   }
// }







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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>AdaSampah-Beranda</title>
</head>

<body style="background-color: #68b984;">

  <!--START Modal  tambah materi-->
  <!-- Modal -->
  <div class="modal fade modal-lg" id="exatambampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div style="background-color: #68b984;" class="modal-header">
          <h1 style="color:white;" class="modal-title fs-5" id="exampleModalLabel">TAMBAH MATERI</h1>
        </div>
        <div class="modal-body2">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <i class="fa-sharp fa-solid fa-heading"></i>
              <label class="form-label tambahjudul">Judul</label>
              <input type="text" class="form-control" required autocomplete="off" name="judul" placeholder="Nama">
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-clipboard fa-1x deskripsi"></i>
              <label class="form-label tambahdeskripsi">Deskripsi Materi</label>
              <textarea type="text" class="form-control" required autocomplete="off" name="deskripsi" maxlength="500" placeholder="Deskripsikan materi"></textarea>

            </div>
            <div class="mb-3">
              <i class="fa-solid fa-camera-retro fa-1x gambar3"></i>
              <label class="form-label tambahgambar">Gambar</label>
              <input type="file" class="form-control" required autocomplete="off" name="gambar" placeholder="Masukan gambar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button id="tambahmateri" type="submit" name="tombolmateri" class="btn btn-primary">Tambah Materi</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--START Modal  tambah laporan-->
  <form action="kirim.php" method="post" enctype="multipart/form-data">
    <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div style="background-color: #68b984;" class="modal-header">
            <h1 style="color:white;" class="modal-title fs-5" id="staticBackdropLabel">FORMULIR LAPORAN</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!--START FORM LAPOR   -->

          <div style=" width: 95%; margin:auto; margin-top:10px; margin-bottom:10px;" class="modal-body2">
            <div class="mb-3">
              <i class="fa-solid fa-user fa-1x nama"></i>
              <label class="form-label">Nama</label>
              <input type="text" placeholder="Nama anda" class="form-control" autocomplete="off" name="nama" required>
            </div>
            <input type="hidden" name="sesinama" value="<?php echo $sesionnama ?> ">
            <div class="mb-3">
              <i class="fa-sharp fa-solid fa-1x fa-phone-flip"></i>
              <label class="form-label">Nomor Telepon</label>
              <input type="number" class="form-control" required autocomplete="off" name="telepon" required placeholder="08XXXXXXXXXX">
            </div>
            <div class="mb-3">
              <i class="fa-sharp fa-solid fa-building-wheat"></i>
              <label class="form-label">PIlih Kota</label>
              <select class="form-select" name="kota" id="pkota">
                <option value="gagal" selected>Pilih Kabupaten/Kota</option>
                <option value="Kabupaten Bandung">Kabupaten Bandung</option>
                <option value="Kabupaten Bandung Barat">Kabupaten Bandung Barat</option>
                <option value="Kabupaten Bekasi">Kabupaten Bekasi</option>
                <option value="Kabupaten Bogor">Kabupaten Bogor</option>
                <option value="Kabupaten Ciamis">Kabupaten Ciamis</option>
                <option value="Kabupaten Cianjur">Kabupaten Cianjur</option>
                <option value="Kabupaten Cirebon">Kabupaten Cirebon</option>
                <option value="Kabupaten Garut">Kabupaten Garut</option>
                <option value="Kabupaten Indramayu">Kabupaten Indramayu</option>
                <option value="Kabupaten Karawang">Kabupaten Karawang</option>
                <option value="Kabupaten Kuningan">Kabupaten Kuningan</option>
                <option value="Kabupaten Majalengka">Kabupaten Majalengka</option>
                <option value="Kabupaten Pangandaran">Kabupaten Pangandaran</option>
                <option value="Kabupaten Purwakarta">Kabupaten Purwakarta</option>
                <option value="Kabupaten Subang">Kabupaten Subang</option>
                <option value="Kabupaten Sukabumi">Kabupaten Sukabumi</option>
                <option value="Kabupaten Sumedang">Kabupaten Sumedang</option>
                <option value="Kabupaten Tasikmalaya">Kabupaten Tasikmalaya</option>
                <option value="Kota Bandung">Kota Bandung</option>
                <option value="Kota Banjar">Kota Banjar</option>
                <option value="Kota Bekasi">Kota Bekasi</option>
                <option value="Kota Bogor">Kota Bogor</option>
                <option value="Kota Cimahi">Kota Cimahi</option>
                <option value="Kota Cirebon">Kota Cirebon</option>
                <option value="Kota Depok">Kota Depok</option>
                 <option value="Kota Sukabumi">Kota Sukabumi</option>
                <option value="Kota Tasikmalaya">Kota Tasikmalaya</option>
                <option value="Email AdaSampah">Email AdaSampah</option>
              </select>
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-location-dot fa-1xs lokasi"></i>
              <label class="form-label">Titik Lokasi</label>
              <input type="text" class="form-control" required autocomplete="off" name="lokasi" placeholder="Kab. Bandung, Kota Bandung, Kab. Garut, Jawa Barat">
            </div>
            <div class="mb-3">
              <i class="fa-sharp fa-solid fa-calendar"></i>
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" required autocomplete="off" name="tanggal">
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-clipboard fa-1x deskripsi"></i>
              <label class="form-label" id="deskripsi-laporan">Deskripsi</label>
              <textarea class="form-control" required autocomplete="off" name="deskripsi" rows="2" placeholder="Deskripsikan area tersebut"></textarea>
            </div>
            <div class="mb-3">
              <i class="fa-solid fa-camera-retro fa-1x gambar3"></i>
              <label class="form-label">Gambar Lokasi (ukuran gambar max 4mb)</label>
              <input type="file" class="form-control" required autocomplete="off" name="gambar" placeholder="Masukan gambar">
            </div>
          </div>
          <p>
            <button id="tambahlaporan" style="width: 150px;" class="btn btn-success tombollapor" name="tombollaporan" type="submit" role="button">
              Kirim Laporan
            </button>
            <button style="width: 75px;" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Penting
            </button>
          <div class="collapse" id="collapseExample">
            <div style="width: 100%;" class="card card-body">
              Data yang anda laporkan akan di tampilkan di website ini dan dikirimkan ke dinas kebersihan sesuai kota yang dipilih, Jadi bijaklah dalam melaporkan.
            </div>
          </div>
  </form>


  <!-- END FORM LAPOR -->
  </div>
  </div>
  </div>
  <!-- END MODAL -->
  <div class="carousel cr">
    <div class="header">
      <img style="width: 200px;" src="../img/logoasli.png" alt="">
      <div class="user">
        <h1>Halo, <?php echo $_SESSION["nama"]; ?></h1>
        <?php if (isset($header)) : ?>
          <p>Jadilah Pahlawan dan bantu Kota mu dari sampah pengganggu kesehatan</p>
          <button class="button-lapor" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa-solid fa-plus"></i> Tambahkan laporan</button>
        <?php endif; ?>
        <?php if (isset($headeruser)) : ?>
          <p>Mulai masuk dengan akun dan jadilah pahlawan kebersihan untuk kotamu</p>
          <button onClick="document.location.href='logout.php'" class="button-lapor"> <i class="fa-sharp fa-solid fa-arrow-right-to-bracket"></i> MASUK AKUN </button>
        <?php endif; ?>
        <?php if (isset($headeradmin)) : ?>
          <p>Anda masuk ke akun admin adasampah, anda bisa mengakses semua fitur web</p>
          <button class="button-lapor" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa-solid fa-plus"></i> Tambahkan laporan</button>
        <?php endif; ?>
      </div>
    </div>
    <?php if (isset($keluar)) : ?>
      <div class="header2">
        <a style="cursor: pointer;" id="keluar">Keluar</a>
      </div>
    <?php endif; ?>
  </div>
  </div>

  <div class="kotajatim">
    <div class="judul3">
      <h3>Provinsi Jawa Barat</h3>
      <p>Memiliki 20 Kabupaten dan 9 Kota </p>
      <p>Temukan Penjelasan Tentang Kota Kalian</p>
    </div>
    <div class="carikota">
      <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
      <input autocomplete="off" placeholder="Kota Surabaya" id="search" type="search">
      <button id="tombolcari">Cari</button>
    </div>
    <div id="kota"></div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>

      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="penjelasanweb">
            <div class="isijelas">
              <img src="../img/jabar.jpg" alt="">
              <div class="judul4">
                <h2>Provinsi Jawa Barat</h2>
                <p>Jawa Barat adalah provinsi yang terletak di Pulau Jawa, Indonesia. Provinsi ini beribu kota di Kota Bandung. Jawa Barat berbatasan dengan Banten dan DKI Jakarta di sebelah barat, Laut Jawa di utara, Jawa Tengah di timur, dan Samudra Hindia di sebelah selatan. Bersama dengan Banten, Jawa Barat disebut sebagai Tatar Sunda atau Pasundan karena merupakan kampung asli masyarakat Sunda, suku terbesar kedua di Indonesia.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="penjelasanweb">
            <div class="isijelas">
              <img src="../img/loogoo.png" alt="">
              <div class="judul4">
                <h2>WEB APP ADASAMPAH</h2>
                <p style="padding-bottom: 24px;">Website Aplikasi AdaSampah ini dibuat untuk membantu masyarakat kabupaten atau kota di Jawa Timur dalam melaporkan tempat kotor kepada Dinas Kebersihan pada setiap kota/kabupaten masing-masing. Hal ini bertujuan untuk membantu Provinsi Jawa Timur dalam mengurangi sampah yang mengganggu kesehatan</p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="penjelasanweb">
            <div class="isijelas">
              <img src="../img/card.png" alt="">
              <div class="judul4">
                <h2>DONASI PENGEMBANGAN</h2>
                <p style="padding-bottom: 24px;">Untuk membantu pengembangan fitur dan kemajuan dari web AdaSampah bisa donasi lewat </br> whatsapp : 0895366141915 </br> Email : adasampah84@gmail.com </br> BRI : 3168 0101 4668 502 </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!-- end kota jatim  -->


  <!-- swiper js -->
  <div style="margin-bottom : 20px; " data-aos="fade-down" data-aos-duration="1000" class="swiper mySwiper">
    <div class="judul1">
      <h2><i style="margin-right: 10px;" class="fa-solid fa-clone"></i>Materi Kebersihan</h2>
      <?php if (isset($tambahmateri)) : ?>
        <button data-bs-toggle="modal" data-bs-target="#exatambampleModal"> <i class="fa-solid fa-plus"></i> Tambahkan materi</button>
      <?php endif; ?>
    </div>
    <div class="carimateri">
      <form action="" method="post">
        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
        <input autocomplete="off" placeholder="Cari judul materi" name="carimateri" type="search">
        <button type="submit" name="tombolcari">Cari</button>
      </form>
    </div>
    <div class="swiper-wrapper">
      <?php foreach ($materi as $materi2) :  ?>
        <div class="swiper-slide" style="border: 0px;">
          <div class="materi materi2" style="border: 0px;">
            <div class="gambar2" style="background-image: url('../img/<?= $materi2["gambar"]; ?>');">

            </div>
            <div class="penjelasan">
              <?php if (isset($ubahhapusmateri)) : ?>
                <div class="crudmateri">
                  <a id="hapusmateri" style="color:black;"><i class="fa-solid fa-trash "></i></a>
                  <a id="ubahmateri" style="color: black;"><i class="fa-sharp fa-solid fa-pen-to-square "></i></a>
                  <input type="hidden" id="idmateri" value="<?= $materi2["id"]; ?>">
                </div>
              <?php endif; ?>
              <div class="penjelasanmateri">
                <h3><?= $materi2["judul"]; ?></h3>
                <div class="garis"></div>
                <p><?= $materi2["deskripsi"]; ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>

  <div class="judul2">
    <h2><i style="margin-right: 10px;" class="uploadlogo fa-solid fa-clone"></i>Laporan Anda</h2>
    <button onClick="document.location.href='semualaporan.php'" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i style="margin-right: 5px; margin-left: 5px;" class="fa-sharp fa-solid fa-globe"></i>Semua Laporan</button>
  </div>
  <div class="carimateri">
    <form action="" method="post">
      <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
      <input autocomplete="off" type="search" name="carilaporan" placeholder="Cari laporan Anda">
      <button type="submit" name="tombolcari2">Cari</button>
    </form>
  </div>

  <?php if (isset($laporanuser)) : ?>
    <h3 style="color: white; margin-left:40px; margin-top:30px">Masuk akun untuk membuat laporan</h3>
  <?php endif; ?>

  <?php if (isset($laporananda)) : ?>

    <div class="halamanbungkus">
      <p>Laporan : </p>
      <?php if ($halamanaktif > 1) : ?>
        <a href="?halaman=<?= $halamanaktif - 1 ?>">&lt;</a>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $jumhalaman; $i++) : ?>
        <?php if ($i == $halamanaktif) : ?>
          <a href="beranda.php?halaman=<?= $i ?>" style="color:white; background-color:black;"><?= $i ?></a>
        <?php else : ?>
          <a href="beranda.php?halaman=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($halamanaktif < $jumhalaman) : ?>
        <a href="?halaman=<?= $halamanaktif + 1 ?>">&gt;</a>
      <?php endif; ?>
    </div>

    <div class="row" style="width:97%; margin:auto; margin-top:20px;">
      <!-- foreach -->
      <?php foreach ($laporan as $laporan2) :  ?>
        <div class="col" style="margin-bottom:20px;">
          <div class="card" data-aos="fade-down" data-aos-duration="1000">
            <img src="../img/<?= $laporan2["gambar"]; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <div class=" judulcard">
                <i style="margin-right: 10px; margin-top:5px;" class="fa-sharp fa-solid fa-building-wheat"></i>
                <h5 class="card-title"><?= $laporan2["kota"]; ?></h5>
              </div>
              <div class="judulcard">
                <p style="font-size: 12px;"><?= $laporan2["lokasi"]; ?></p>
              </div>
              <div class="judulcard">
                <i style="margin-right: 10px;" class="fa-solid fa-user fa-1x nama"></i>
                <h6 styclass="card-title">Oleh <?= $laporan2["nama"]; ?></h6>

              </div>
              <p style="font-size: 12px;">Telp : <?= $laporan2["telepon"]; ?></p>
              <p class="berhasil" style="border: 2px solid yellowgreen; padding :2px; width:80%"> <i style="margin-right: 5px;" class="fa-solid fa-clipboard-check fa-1x"></i>Laporan terkirim ke Email DLH</p>
              <div class="desklapor">
                <p class="card-text"><?= $laporan2["deskripsi"]; ?></p>
              </div>
              <input type="hidden" name="" id="idlapor" value="<?= $laporan2["id"]; ?>">
            </div>

            <!-- footer -->
            <div class="card-footer" style="display: flex; justify-content:space-between;">
              <small class="text-muted">Post pada <?= $laporan2["tanggal"]; ?></small>
              <div>
                <a id="hapuslaporan" style="color:black;"><i class="fa-solid fa-trash"></i></a>
                <a id="ubahlaporan" style="color: black; margin-left:10px;"><i class="fa-sharp fa-solid fa-pen-to-square ubahlogo2"></i></a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- endforeach -->
    </div>
  <?php endif; ?>

  <!-- <div class="batas"></div> -->
  <div class="footer">
    <div class="sosmed">
      <i class="wa fa-brands fa-whatsapp fa-2x"></i>
      <i class="ig fa-brands fa-instagram fa-2x"></i>
      <i class="link fa-brands fa-chrome fa-2x"></i>
    </div>
    <div class="emailfot">
      <p>adasampah84@gmail.com</p>
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
  <script src="../js/scriptberanda.js"></script>
  <script>
    AOS.init()
  </script>
  <!-- Initialize Swiper -->
  <script>
    window.addEventListener('load', () => {
      startQueries();
    })
    const startQueries = () => {
      const MediaQueryNew = matchMedia('(max-width:750px)');

      const ifMatchesChange = e => {
        if (e.matches) {
          var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerGroup: 2,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        } else {
          var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 0,
            slidesPerGroup: 4,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });

        }
      }
      MediaQueryNew.addListener(ifMatchesChange)
      ifMatchesChange(MediaQueryNew)
    }
  </script>

  <!-- tambah materi -->
  <?php
  if (isset($_POST["tombolmateri"])) {
    if (tambahmateri($_POST) > 0) {
      echo "
      <script>
      Swal.fire({
          icon: 'success',
          title: 'Materi berhasil ditambahkan',
          text: 'Halaman akan di muat ulang',
          showConfirmButton: false,
        });
        setInterval( () => {
          window.location.href = 'beranda.php';
       }, 2000);
      </script>
      ";
    } else {
      echo "
<script>alert('Materi baru gagal di tambahkan');</script>
";
    }
  }


  ?>
</body>

</html>