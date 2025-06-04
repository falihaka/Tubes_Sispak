// const buttonlapor = document.querySelector(".button-lapor");

const body = document.querySelector("body");
const ubahlogo = document.querySelector(".ubahlogo");
const ubahjudul = document.querySelector(".ubahjudul");
const result = document.querySelector("#result");
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

// alert sweetjs

const hapuslaporan = document.querySelectorAll("#hapuslaporan");
const idlapor = document.querySelectorAll("#idlapor");
const ubahlaporan = document.querySelectorAll("#ubahlaporan");

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
