<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '', time() - 60000);
setcookie('key', '', time() - 60000);
header("Location: index.php");
exit;
