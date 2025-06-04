<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <script src="../alert/dist/sweetalert2.all.min.js"></script>
   <?php
   session_start();
   require 'function.php';

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;


   if (isset($_POST["tombollaporan"])) {
      $conn = mysqli_connect("localhost", "root", "", "adasampah");
      $nama = htmlspecialchars($_POST["nama"]);
      $telepon = htmlspecialchars($_POST["telepon"]);
      $kota = htmlspecialchars($_POST["kota"]);
      $lokasi = htmlspecialchars($_POST["lokasi"]);
      $tanggal = htmlspecialchars($_POST["tanggal"]);
      $deskripsi = htmlspecialchars($_POST["deskripsi"]);
      $sesinama = htmlspecialchars($_POST["sesinama"]);

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
      $gambar = $namafilebaru;

      if (!$gambar) {
         return false;
      }

      // query data
      $query = "INSERT INTO laporanweb VALUES ('', '$nama', '$telepon', '$kota', '$lokasi', '$tanggal', '$deskripsi', '$gambar', '$sesinama')";
      mysqli_query($conn, $query);

      $hasil = $gambar;

      var_dump($hasil);
      if ($hasil > 0) {
         $gambarbaru = $hasil;
         $emailberhasil = true;
      } else {
         echo "
     <script>alert('Laporan baru gagal di tambahkan');</script>
     ";
      }
   }


   if (isset($emailberhasil)) {
      require_once "../library/PHPMailer.php";
      require_once "../library/Exception.php";
      require_once "../library/OAuth.php";
      require_once "../library/POP3.php";
      require_once "../library/SMTP.php";

      $nama = $_POST['nama'];
      $telepon = $_POST['telepon'];
      $lokasi = $_POST['lokasi'];
      $kota = $_POST['kota'];
      $tanggal = $_POST['tanggal'];
      $deskripsi = "Nama : " . $_POST['nama'] . '<br>' . "Telepon : " . $_POST['telepon'] . '<br>' .
         "Kabupaten/Kota : " . $_POST['kota'] . '<br>'  . "Titik Lokasi : " . $_POST['lokasi'] .
         '<br>' . "Tanggal : " . $_POST['tanggal'] . '<br>'  . "Titik Lokasi : " . $_POST['lokasi'] . '<br>' .
         "Deskripsi : " . $_POST['deskripsi'] . '<br>' . 'Website : http://adasampah.infinityfreeapp.com/php/';
      // $pesan = $_POST['pesan'];
      // $img = $_POST['img'];

      if ($kota == "Email Fery") {
         $emailkabkot = "tinemu.store@gmail.com";
      } else if ($kota == "Email Davano") {
         $emailkabkot = "yustinamalia22@gmail.com";
      } else if ($kota == "Email Devano") {
         $emailkabkot = "devanorama123@gmail.com";
      } else if ($kota == "Kabupaten Bangkalan") {
         $emailkabkot = "dlh@bangkalankab.go.id";
      } else if ($kota == "Kabupaten Banyuwangi") {
         $emailkabkot = "dlh.banyuwangi@gmail.com";
      } else if ($kota == "Kabupaten Bojonegoro") {
         $emailkabkot = "dlh.bojonegoro@gmail.com";
      } else if ($kota == "Kabupaten Bondowoso") {
         $emailkabkot = "dlh.bondowoso@gmail.com";
      } else if ($kota == "Kabupaten Gresik") {
         $emailkabkot = "dinaslingkunganhidupgresik@gmail.com";
      } else if ($kota == "Kabupaten Jember") {
         $emailkabkot = "dlh@jemberkab.go.id";
      } else if ($kota == "Kabupaten Jombang") {
         $emailkabkot = "kpde@jombangkab.go.id";
      } else if ($kota == "Kabupaten Kediri") {
         $emailkabkot = "dlh@kedirikab.go.id";
      } else if ($kota == "Kabupaten Lamongan") {
         $emailkabkot = "dinlh@lamongankab.go.id";
      } else if ($kota == "Kabupaten Lumajang") {
         $emailkabkot = "lingkungan@lumajangkab.go.id";
      } else if ($kota == "Kabupaten Madiun") {
         $emailkabkot = "dlhkabmadiun@gmail.com";
      } else if ($kota == "Kabupaten Magetan") {
         $emailkabkot = "dlh@magetan.go.id";
      } else if ($kota == "Kabupaten Malang") {
         $emailkabkot = "lh@malangkab.go.id";
      } else if ($kota == "Kabupaten Nganjuk") {
         $emailkabkot = "dlh@nganjukkab.go.id";
      } else if ($kota == "Kabupaten Pacitan") {
         $emailkabkot = "dlh@pacitankab.go.id";
      } else if ($kota == "Kabupaten Pamekasan") {
         $emailkabkot = "dlh@pamekasankab.go.id";
      } else if ($kota == "Kabupaten Pasuruan") {
         $emailkabkot = "dlh@pasuruankab.go.id";
      } else if ($kota == "Kabupaten Ponorogo") {
         $emailkabkot = "dlh@ponorogo.go.id";
      } else if ($kota == "Kabupaten Probolinggo") {
         $emailkabkot = "dlh_kabprobolinggo@yahoo.co.id";
      } else if ($kota == "Kabupaten Sampang") {
         $emailkabkot = "dlh@sampangkab.go.id";
      } else if ($kota == "Kabupaten Sidoarjo") {
         $emailkabkot = "dlhk@sidoarjokab.go.id";
      } else if ($kota == "Kabupaten Situbondo") {
         $emailkabkot = "situbondo.dlh@gmail.com";
      } else if ($kota == "Kabupaten Sumenep") {
         $emailkabkot = "dlh@sumenepkab.go.id";
      } else if ($kota == "Kota Batu") {
         $emailkabkot = "dlhkotabatu@gmail.com";
      } else if ($kota == "Kota Blitar") {
         $emailkabkot = "dlh@blitarkota.go.id";
      } else if ($kota == "Kota Madiun") {
         $emailkabkot = "lingkunganhidup.kotamadiun@gmail.com";
      } else if ($kota == "Kota Madiun") {
         $emailkabkot = "lingkunganhidup.kotamadiun@gmail.com";
      } else if ($kota == "Kota Malang") {
         $emailkabkot = "dlh@malangkota.go.id";
      } else if ($kota == "Kota Mojokerto") {
         $emailkabkot = "ppid@mojokertokota.go.id";
      } else if ($kota == "Kota Pasuruan") {
         $emailkabkot = "dlhkp@pasuruankota.go.id";
      } else if ($kota == "Kota Probolinggo") {
         $emailkabkot = "blh.kota.probolinggo@gmail.com";
      } else {
         echo "
      <script>
      alert('Pengiriman laporan GAGAL!');
      document.location.href = 'beranda.php';
      </script>
      ";
         exit;
      }
      $mail = new PHPMailer(true);

      //Enable SMTP debugging.
      // $mail->SMTPDebug = 3;
      //Set PHPMailer to use SMTP.
      $mail->isSMTP();
      //Set SMTP host name
      $mail->Host = "smtp.gmail.com"; //host mail server
      //Set this to true if SMTP host requires authentication to send email
      $mail->SMTPAuth = true;
      //Provide username and password
      $mail->Username = "adasampah84@gmail.com";   //nama-email smtp
      $mail->Password = "bmxqtptzsvrbkwls";           //password email smtp
      //If SMTP requires TLS encryption then set it
      $mail->SMTPSecure = "tls";
      //Set TCP port to connect to
      $mail->Port = 587;
      //email pengirim
      $mail->setFrom("tes2@gmail.com");
      // $mail->addAddress($_POST['email'], $_POST['nama']); //nama pengirim
      $mail->addAddress($emailkabkot, $kota); //email penerima

      $mail->isHTML(true);
      $mail->Subject = $nama;
      $mail->addAttachment('../img/' . $gambarbaru);
      $mail->Body = $deskripsi;


      // $mail->Subject = $_POST['subjek']; //subject
      // $mail->Body    = $_POST['pesan']; //isi email
      // $mail->AltBody = "PHP mailer"; //body email (optional)
      $mail->AltBody = "PHP mailer";
      if (!$mail->send()) {
         // echo "Mailer Error: " . $mail->ErrorInfo;
         echo "
     <script>
     alert('Laporan gagal terkirim ke Email DLH');
     </script> . $mail->ErrorInfo;
     ";
      } else {
         // echo "Message has been sent successfully";
         echo "
      <script>
      Swal.fire({
          icon: 'success',
          title: 'Laporan berhasil ditambahkan dan di kirim ke Email DLH',
          text: 'Halaman akan di muat ulang',
          showConfirmButton: false,
        });
        setInterval( () => {
          window.location.href = 'beranda.php';
       }, 2000);
      </script>
      ";
      }
   }

   ?>
</body>

</html>