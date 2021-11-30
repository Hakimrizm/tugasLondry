<?php

session_start();

if ( !isset($_SESSION["login"]) ){
  header("location:../index.php");
}


include '../function/functions.php';

if ( isset($_POST["submit"]) ){

  if ( tambah($_POST) > 0 ){
    echo "<script>
            alert('Data berhasil di tambahkan!');
            document.location.href = 'index.php';
          </script>";
  }else {
    echo "<script>
            alert('Data gagal di tambahkan!');
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
    body{
      background-color: #0D1117 !important;
    }
  </style>

  <title>Tambah Data Pelanggan</title>
</head>
<body>

  <div class="container">
    <div class="row content">
      <div class="col-md-6">
        <img src="img/vektor.jpeg" alt="image" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h3 class="signin-text mb-3">Tambah data pelanggan</h3>
        <form action="" method="post">
          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="pelanggan_nama" id="nama" class="form-control" required autocomplete="off" placeholder="Nama">
          </div>
          <div class="form-group mb-3">
            <label for="noHp">No Hp</label>
            <input type="text" name="pelanggan_hp" id="noHp" class="form-control" required autocomplete="off" placeholder="No Hp">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="pelanggan_alamat" id="alamat" class="form-control mb-3" required autocomplete="off" placeholder="Alamat">
          </div>
          <button class="btn btn-primary" name="submit">Tambah</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>