<?php

session_start();

if ( !isset($_SESSION["login"]) ){
  header("location:../index.php");
}


include '../function/functions.php';

$id = $_GET["id"];

if ( hapus($id) > 0){
    echo "<script>
            alert('Data berhasil di hapus!');
            document.location.href = 'index.php';
          </script>";
}else {
    echo "<script>
            alert('Data gagal di hapus!');
          </script>";
}

?>