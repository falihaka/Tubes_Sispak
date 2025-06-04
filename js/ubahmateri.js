const gambar = document.querySelector(".gambar");
const body = document.querySelector("body");

let bg = "url('../img/" + gambar.value + "')";
body.style.backgroundImage = bg;

console.log(bg);
