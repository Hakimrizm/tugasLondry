<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('haha', '', time() - 3600);
setcookie('hm', '', time() - 3600);

header("location:../index.php");
exit;
?>