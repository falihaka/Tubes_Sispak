<?php
session_start();
// jika tidak ada session login

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}
require 'function.php';
$id = $_GET["id"];

if (hapus2($id) > 0) {
    echo "
    <script>
    document.location.href = 'beranda.php';
    </script>
    ";
} else {
    echo "
    <script>
    Swal.fire('Laporan Berhasil Di Hapus!', '', 'error');
    document.location.href = 'beranda.php';
    </script>
    ";
}
