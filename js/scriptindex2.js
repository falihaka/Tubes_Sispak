const klikmasuk = document.querySelector(".klik-masuk");
const klikberanda = document.querySelector(".klik-beranda");
const klikdaftar = document.querySelector(".klik-daftar");
const kliktentang = document.querySelector(".klik-tentang");
const start = document.querySelector(".start");
const user = document.querySelector(".user");
const pw = document.querySelector(".pw");
const login = document.querySelector(".login");
const katakata = document.querySelector(".kata-kata");
const katakata2 = document.querySelector(".kata-kata2");
const masuk = document.querySelector(".masuk");
const daftar = document.querySelector(".daftar");
const tentang = document.querySelector(".tentang");
const button33 = document.querySelector(".button-33");
const nama = document.querySelector("#nama");

masuk.classList.add("none");
daftar.classList.add("none");
tentang.classList.add("none");
klikberanda.style.backgroundColor = "black";

klikmasuk.disabled = true;
klikdaftar.disabled = true;
kliktentang.disabled = true;
klikberanda.disabled = true;
klikmasuk.style.color = "#bfbfbf";
kliktentang.style.color = "#bfbfbf";
klikdaftar.style.color = "#bfbfbf";
setTimeout(function () {
  klikmasuk.disabled = false;
  klikdaftar.disabled = false;
  kliktentang.disabled = false;
  klikberanda.disabled = false;
  klikmasuk.style.color = "white";
  klikdaftar.style.color = "white";
  kliktentang.style.color = "white";
}, 5000);

// mengetik
var i = 0,
  u = 0,
  text,
  text2;
text = "Tidak untuk saling menyalahkan, ini hanya soal kesadaran";
text2 =
  "Bantu Provinsi Jawa Timur dari darurat sampah dengan cara menambah pemahaman tentang sampah,laporkan tempat yang kotor dan pahlawan kebersihan akan menuntaskannya";
function mengetik() {
  if (i < text.length) {
    katakata.innerHTML += text.charAt(i);
    i++;
    setTimeout(mengetik, 50);
  }
}
function mengetik2() {
  if (u < text2.length) {
    katakata2.innerHTML += text2.charAt(u);
    u++;
    setTimeout(mengetik2, 30);
  }
}
mengetik();
mengetik2();

// mulai
klikmasuk.addEventListener("click", function () {
  // disable
  klikberanda.disabled = true;
  klikdaftar.disabled = true;
  kliktentang.disabled = true;
  klikmasuk.disabled = true;
  klikberanda.style.color = "#bfbfbf";
  kliktentang.style.color = "#bfbfbf";
  klikdaftar.style.color = "#bfbfbf";

  setTimeout(function () {
    klikdaftar.disabled = false;
    klikberanda.disabled = false;
    kliktentang.disabled = false;
    klikmasuk.disabled = false;
    klikdaftar.style.color = "white";
    klikberanda.style.color = "white";
    kliktentang.style.color = "white";
  }, 3000);

  masuk.classList.remove("none");
  gsap.to(".masuk", { duration: 0.05, opacity: 1 });
  gsap.to(".daftar", { duration: 0.05, opacity: 0 });
  button33.classList.add("none");
  daftar.classList.add("none");
  tentang.classList.add("none");
  katakata.innerHTML = "";
  katakata2.innerHTML = "";

  var i = 0,
    u = 0,
    text,
    text2;
  text = "Masuk dan jadilah Pahlawan";
  text2 =
    "Masuk dengan akun anda yang sudah ada, jika tidak mempunyai akun bisa klik tombol daftar di atas";
  function mengetik() {
    if (i < text.length) {
      katakata.innerHTML += text.charAt(i);
      i++;
      setTimeout(mengetik, 30);
    }
  }
  function mengetik2() {
    if (u < text2.length) {
      katakata2.innerHTML += text2.charAt(u);
      u++;
      setTimeout(mengetik2, 20);
    }
  }
  mengetik();
  mengetik2();
  klikberanda.style.backgroundColor = "transparent";
  klikdaftar.style.backgroundColor = "transparent";
  kliktentang.style.backgroundColor = "transparent";
  klikmasuk.style.backgroundColor = "black";
});

// klik beranda
klikberanda.addEventListener("click", function () {
  masuk.classList.add("none");
  daftar.classList.add("none");
  tentang.classList.add("none");
  gsap.to(".masuk", { duration: 0.05, opacity: 0 });
  gsap.to(".daftar", { duration: 0.05, opacity: 0 });
  button33.classList.remove("none");

  klikmasuk.style.backgroundColor = "transparent";
  klikdaftar.style.backgroundColor = "transparent";
  kliktentang.style.backgroundColor = "transparent";
  klikberanda.style.backgroundColor = "black";

  katakata.innerHTML =
    "Tidak untuk saling menyalahkan, ini hanya soal kesadaran";
  katakata2.innerHTML =
    "Bantu Indonesia dari darurat sampah dengan cara menambah pemahaman tentang sampah,laporkan tempat yang kotor dan pahlawan kebersihan akan menuntaskannya";
});

klikdaftar.addEventListener("click", function () {
  // disable
  klikberanda.disabled = true;
  klikmasuk.disabled = true;
  kliktentang.disabled = true;
  klikdaftar.disabled = true;
  klikberanda.style.color = "#bfbfbf";
  kliktentang.style.color = "#bfbfbf";
  klikmasuk.style.color = "#bfbfbf";
  setTimeout(function () {
    klikmasuk.disabled = false;
    klikberanda.disabled = false;
    kliktentang.disabled = false;
    klikdaftar.disabled = false;
    klikmasuk.style.color = "white";
    klikberanda.style.color = "white";
    kliktentang.style.color = "white";
  }, 3000);

  button33.classList.add("none");
  masuk.classList.add("none");
  tentang.classList.add("none");
  daftar.classList.remove("none");
  gsap.to(".daftar", { duration: 0.05, opacity: 1 });
  gsap.to(".masuk", { duration: 0.05, opacity: 0 });
  // disabled delay button

  katakata.innerHTML = "";
  katakata2.innerHTML = "";
  var i = 0,
    u = 0,
    text,
    text2;
  text = "Daftarkan dirimu sebagai Pahlawan";
  text2 = "Ada calon pahlawan baru nih, Ayok bantu bersihkan kota kalian!";
  function mengetik() {
    if (i < text.length) {
      katakata.innerHTML += text.charAt(i);
      i++;
      setTimeout(mengetik, 30);
    }
  }
  function mengetik2() {
    if (u < text2.length) {
      katakata2.innerHTML += text2.charAt(u);
      u++;
      setTimeout(mengetik2, 20);
    }
  }
  mengetik();
  mengetik2();

  klikmasuk.style.backgroundColor = "transparent";
  klikberanda.style.backgroundColor = "transparent";
  kliktentang.style.backgroundColor = "transparent";
  klikdaftar.style.backgroundColor = "black";
});

kliktentang.addEventListener("click", function () {
  // disable
  klikberanda.disabled = true;
  klikmasuk.disabled = true;
  klikdaftar.disabled = true;
  kliktentang.disabled = true;
  klikberanda.style.color = "#bfbfbf";
  klikdaftar.style.color = "#bfbfbf";
  klikmasuk.style.color = "#bfbfbf";
  setTimeout(function () {
    klikmasuk.disabled = false;
    klikberanda.disabled = false;
    klikdaftar.disabled = false;
    kliktentang.disabled = false;
    klikmasuk.style.color = "white";
    klikberanda.style.color = "white";
    klikdaftar.style.color = "white";
  }, 3000);

  button33.classList.add("none");
  masuk.classList.add("none");
  daftar.classList.add("none");
  //
  tentang.classList.remove("none");
  gsap.to(".tentang", { duration: 0.05, opacity: 1 });
  // disabled delay button
  katakata.innerHTML = "";
  katakata2.innerHTML = "";
  klikmasuk.style.backgroundColor = "transparent";
  klikberanda.style.backgroundColor = "transparent";
  klikdaftar.style.backgroundColor = "transparent";
  kliktentang.style.backgroundColor = "black";
});
