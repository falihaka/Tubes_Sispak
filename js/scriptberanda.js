// const buttonlapor = document.querySelector(".button-lapor");

const body = document.querySelector("body");
const ubahlogo = document.querySelector(".ubahlogo");
const ubahjudul = document.querySelector(".ubahjudul");
const result = document.querySelector("#result");
const carikota = document.querySelector("#carikota");
body.style.backgroundColor = "#68b984";
const kota2 = document.querySelector("#kota");
const pbaru = document.createElement("p");
const wa = document.querySelector(".wa");
const ig = document.querySelector(".ig");
const link = document.querySelector(".link");
console.log("tes");

// sosmed
wa.addEventListener("click", function () {
  window.location.href = "https://wa.me/+62895366141915";
  console.log("tes");
});
link.addEventListener("click", function () {
  window.location.href = "http://adasampah.infinityfreeapp.com/php/";
});

// cari json
$("#tombolcari").on("click", function () {
  $("#kota").html("");
  var cek = 0;
  $.getJSON("../json/data.json", function (data) {
    let kota = data.kota;
    let cari = $("#search").val();
    let nama;
    let bupati;
    let dinas;
    let link;
    let luaswilayah;
    let kecamatan;
    let deskripsi;
    let gambar;
    $.each(kota, function (i, data) {
      if (cari == data["nama"]) {
        nama = data["nama"];
        bupati = data["bupati"];
        dinas = data["dinas"];
        link = data["link"];
        luaswilayah = data["luaswilayah"];
        kecamatan = data["kecamatan"];
        deskripsi = data["deskripsi"];
        gambar = data["gambar"];
        cek = parseInt(cek) + 1;
      }
    });
    if (cek == 1) {
      $("#kota").append(
        `<!-- Button trigger modal -->
        <button style="margin-top:20px; " type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalz">
          Lihat selengkapnya tentang ` +
          nama +
          `
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModalz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Penjelasan tentang ` +
          nama +
          `</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <div class="container-fluid">
              <div class="row ">
                <div class="col-md-4 gambarkota2 tengah"><img src="` +
          gambar +
          `" alt=""></div>
                <div class="col-md-8 ms-auto">
                <ul class="list-group">
                <li style="text-align:left;" class="list-group-item">
                  <h3 style="text-align: left;">` +
          nama +
          `</h3>
                </li>
                <li style="text-align:left;" class="list-group-item">
                  Nama Bupati/Wali Kota : ` +
          bupati +
          `
                </li>
                <li style="text-align:left;" class="list-group-item">
                  ` +
          dinas +
          `</br>Link Website : <a href="">` +
          link +
          `</a>
                </li>
                <li style="text-align:left;" class="list-group-item">
                  Luas Wilayah : ` +
          luaswilayah +
          `
                </li>
                <li style="text-align:left;" class="list-group-item">
                  Jumlah Kecematan : ` +
          kecamatan +
          `
                </li>
                <li style="text-align:left;" class="list-group-item">
                  Deskripsi : </br> ` +
          deskripsi +
          `
                </li>
              </ul>
              </ul>
            
            
                </div>
              </div>
            </div>

              </div>
            </div>
          </div>
        </div>`
      );
      $("#search").val("");
    } else {
      $("#kota").append(
        `
        <p>` +
          cari +
          ` tidak ditemukan Pastikan : <br/>
        1. Nama Kabupaten/Kota benar <br/>
        2. Menggunakan awalan 'Kabupaten/Kota '
          <br/> 3. Contoh Kota Malang</p>                   
          `
      );
      $("#search").val("");
    }
  });
});

// alert sweetjs

const hapuslaporan = document.querySelectorAll("#hapuslaporan");
const idlapor = document.querySelectorAll("#idlapor");
const hapusmateri = document.querySelectorAll("#hapusmateri");
const idmateri = document.querySelectorAll("#idmateri");
const tambahmateri = document.querySelector("#tambahmateri");
const tambahlaporan = document.querySelector("#tambahlaporan");
const ubahmateri = document.querySelectorAll("#ubahmateri");
const idmateri2 = document.querySelectorAll("#idmateri2");
const ubahlaporan = document.querySelectorAll("#ubahlaporan");
const keluar = document.querySelector("#keluar");

// keluar
keluar.addEventListener("click", function () {
  Swal.fire({
    title: "Anda yakin ingin keluar?",
    text: "Anda akan kembali ke halaman login",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Keluar",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "logout.php";
    }
  });
});

// hapus laporan
for (let i = 0; i < hapuslaporan.length; i++) {
  hapuslaporan[i].addEventListener("click", function () {
    Swal.fire({
      title: "Yakin ingin menghapus?",
      // showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Hapus",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Laporan Berhasil Di Hapus",
          text: "Halaman akan di muat ulang",
          icon: "success",
          showConfirmButton: false,
        });

        let hapus = "hapuslaporan.php?id=" + idlapor[i].value;
        setInterval(() => {
          window.location.href = hapus;
        }, 2500);
      }
    });
  });
}

// hapus materi
for (let i = 0; i < hapusmateri.length; i++) {
  hapusmateri[i].addEventListener("click", function () {
    Swal.fire({
      title: "Yakin ingin menghapus?",
      text: "Anda tidak akan dapat mengembalikan ini!",
      icon: "warning",
      // showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Hapus",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Materi Berhasil Di Hapus",
          text: "Halaman akan di muat ulang",
          icon: "success",
          showConfirmButton: false,
        });

        let hapus = "hapusmateri.php?id=" + idmateri[i].value;
        setInterval(() => {
          window.location.href = hapus;
        }, 2500);
      }
    });
  });
}

// ubah materi
for (let i = 0; i < ubahmateri.length; i++) {
  ubahmateri[i].addEventListener("click", function () {
    Swal.fire({
      title: "Yakin ingin merubah?",
      // showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Ubah",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        let ubah = "ubahmateri.php?id=" + idmateri[i].value;
        window.location.href = ubah;
      }
    });
  });
}

// ubah laporan
for (let i = 0; i < ubahlaporan.length; i++) {
  ubahlaporan[i].addEventListener("click", function () {
    Swal.fire({
      title: "Yakin ingin merubah?",
      // showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Ubah",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        let ubah = "ubahlaporan.php?id=" + idlapor[i].value;
        window.location.href = ubah;
      }
    });
  });
}

tambahlaporan.addEventListener("click", function () {
  Swal.fire({
    title: "Laporan akan segera di kirim",
    text: "Tunggu beberapa saat dan pastikan semua sudah benar",
    showConfirmButton: false,
    timerProgressBar: true,
  });
});
