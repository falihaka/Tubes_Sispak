<?php
session_start();
// jika tidak ada session login

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

// sesi penting nama
$sesionnama = $_SESSION["nama"];

require 'function.php';
$id = $_GET["id"];

// ambil tabel materiweb
$laporan = query("SELECT * FROM laporanweb WHERE id = $id");




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleubah.css">
</head>

<body>
    <div class="gelap"></div>
    <div class="container">
        <div class="wrapper">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="display: flex; flex-direction:column;">
                    <h1 style="color:white; margin:auto;" class="modal-title fs-5" id="exampleModalLabel">UBAH LAPORAN</h1>
                    <p style="color:white; margin:auto;">Data yang di ubah tidak lagi di kirim ke dinas</p>
                </div>
                <input type="hidden" name="id" value="<?= $laporan[0]["id"]; ?>">
                <input type="hidden" name="gambarlama" value="<?= $laporan[0]["gambar"]; ?>">
                <input type="hidden" name="sesinama" value="<?php echo $sesionnama ?> ">
                <div class="mb-3">
                    <i style="color:white;" class="fa-solid fa-user fa-1x nama"></i>
                    <label style="color:white;" class="form-label">Nama</label>
                    <input type="text" value="<?= $laporan[0]["nama"]; ?>" class="form-control" required autocomplete="off" name="nama" required placeholder="Nama">
                </div>
                <div class="mb-3">
                    <i style="color:white;" class="fa-sharp fa-solid fa-1x fa-phone-flip"></i>
                    <label style="color:white;" class="form-label" id="email-laporan">Nomor Telepon</label>
                    <input type="number" value="<?= $laporan[0]["telepon"]; ?>" class="form-control" required autocomplete="off" name="telepon" required placeholder="08XXXXXXXXXXX">
                </div>
                <div class="mb-3">
                    <i style="color:white;" class="fa-sharp fa-solid fa-building-wheat"></i>
                    <label style="color:white;" class="form-label">PIlih Kota (Kota tidak bisa dirubah)</label>
                    <input type="hidden" value="<?= $laporan[0]["kota"]; ?>" name="kota">
                    <select disabled class="form-select" id="pkota">
                        <option selected><?= $laporan[0]["kota"]; ?></option>
                        <option value="Kota Surabaya">Kota Surabaya</option>
                        <option value="Kabupaten Sidoarjo">Kabupaten Sidoarjo</option>
                        <option value="Kota Malang">Kota Malang</option>
                    </select>
                </div>
                <div class="mb-3">
                    <i style="color:white;" class="fa-solid fa-location-dot fa-1xs lokasi"></i>
                    <label style="color:white;" class="form-label">Titik Lokasi</label>
                    <input type="text" value="<?= $laporan[0]["lokasi"]; ?>" class="form-control" required autocomplete="off" name="lokasi" placeholder="ITATS, Jalan Arief Rahman Hakim, Klampis Ngasem, Kota Surabaya, Jawa Timur">
                </div>
                <div class="mb-3">
                    <i style="color:white;" class="fa-sharp fa-solid fa-calendar"></i>
                    <label disabled style="color:white;" class="form-label">Tanggal</label>
                    <input type="date" value="<?= $laporan[0]["tanggal"]; ?>" class="form-control" required autocomplete="off" name="tanggal">
                </div>
                <div class="mb-3">
                    <i style="color:white;" class="fa-solid fa-clipboard fa-1x deskripsi"></i>
                    <label style="color:white;" class="form-label" id="deskripsi-laporan">Deskripsi</label>
                    <textarea class="form-control" required autocomplete="off" name="deskripsi" rows="2" placeholder="Deskripsikan area tersebut"><?= $laporan[0]["deskripsi"]; ?></textarea>
                </div>
                <input type="hidden" value="<?= $laporan[0]["gambar"]; ?>" class="bg">
                <div class="mb-3">
                    <i style="color:white;" class="fa-solid fa-camera-retro fa-1x gambar3"></i>
                    <label style="color:white;" class="form-label">Gambar Lokasi</label>
                    <input type="file" class="form-control gambar" required autocomplete="off" name="gambar" placeholder="Masukan gambar">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary kembali" data-bs-dismiss="modal">Kembali</button>
                    <button style="margin-left:20px;" type="submit" name="tombollaporan" class="btn btn-primary">Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../js/ubah.js"></script>
    <script src="../alert/dist/sweetalert2.all.min.js"></script>

    <?php
    // ketika tombol ubah di pencet
    if (isset($_POST["tombollaporan"])) {

        if (ubah2($_POST) > 0) {
            echo "
      <script>
      Swal.fire({
        icon: 'success',
        title: 'Laporan berhasil di ubah',
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
        <script>alert('Laporan gagal di ubah');
        document.location.href = 'beranda.php';
      
      </script>
      ";
        }
    }

    ?>
</body>

</html>