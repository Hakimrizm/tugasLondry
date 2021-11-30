<?php

session_start();

if ( !isset($_SESSION["login"]) ){
  header("location:../index.php");
}


include '../function/functions.php';

// Ambil data di url
$id = $_GET["id"];

// Query data berdasarkan id
$pelanggan = query("SELECT * FROM pelanggan WHERE pelanggan_id = $id")[0];

if ( isset($_POST["submit"]) ){

  if ( ubah($_POST) > 0 ){
    echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
          </script>";
  }else {
    echo "<script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php';
          </script>";
  }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/style2.css">

  <style>
    body {
      background-color: #0D1117 !important;
    }
  </style>

  <title>Ubah Data Pelanggan</title>
</head>
<body>

  <div class="container">
    <div class="row content">
      <div class="col-md-6">
        <img src="img/vektor.jpeg" alt="image" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h3 class="signin-text mb-3">Ubah Data Pelanggan</h3>
        <form action="" method="post">
            <input type="hidden" name="pelanggan_id" value="<?= $pelanggan["pelanggan_id"] ?>">
          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="pelanggan_nama" autocomplete="off" placeholder="Nama"  id="nama" class="form-control" required value="<?= $pelanggan["pelanggan_nama"]; ?>">
          </div>
          <div class="form-group mb-3">
            <label for="noHp">No Hp</label>
            <input type="text" name="pelanggan_hp" autocomplete="off" placeholder="No Hp"  id="noHp" class="form-control" required value="<?= $pelanggan["pelanggan_hp"]; ?>">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="pelanggan_alamat" id="alamat" autocomplete="off" placeholder="Alamat"  class="form-control mb-3" required value="<?= $pelanggan["pelanggan_alamat"] ?>">
          </div>
          <button class="btn btn-primary" name="submit">Ubah</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>