const bg2 = document.querySelector(".bg");
const kembali = document.querySelector(".kembali");
const body = document.querySelector("body");

let bg = "url('../img/" + bg2.value + "')";
body.style.backgroundImage = bg;
console.log(bg);

kembali.addEventListener("click", function () {
  window.location.href = "beranda.php";
});
