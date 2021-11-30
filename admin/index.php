<?php

session_start();

if ( !isset($_SESSION["login"]) ){
  header("location:../index.php");
}

include '../function/functions.php';

// Membuat Pagination
// konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM pelanggan"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;

$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$pelanggan = query("SELECT * FROM pelanggan LIMIT $awalData, $jumlahDataPerHalaman");

// Tombol ditekan
if ( isset($_POST["cari"]) ){

  $pelanggan = cari($_POST["keyword"]);


}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Dongle:wght@300&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    
    <!-- My Css -->
    <!-- <link rel="stylesheet" href="../css/font.css"> -->
    <style>
        body {
        font-family: "Nunito Sans", sans-serif;
        background-color: #0D1117;
      }

      .navbar-brand {
        font-family: "Shadows Into Light", cursive;
      }

    </style>

    <title>Halaman Admin</title>
  </head>
  <body>


    <!-- Membuat Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-3" style="background-color: #161B22;">
      <div class="container">
        <a class="navbar-brand" href="#">LONDRY SMKN7</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pelanggan</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                More
              </a>
              <ul class="dropdown-menu shadow-sm" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Transaksi Pembelian</a></li>
                <li><a class="dropdown-item" href="#">Transaksi Penjualan</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item bi bi-box-arrow-right" href="logout.php">Log out</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Laporan</a>
            </li>
          </ul>
          <form class="d-flex" action="" method="post">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off" id="keyword">
            <button class="btn btn-outline-success" type="submit" name="cari" id="tombol-cari">Search</button>
          </form>
        </div>
      </div>
  </nav>
    <!-- Akhir Navbar -->

    <div class="container">
      <div class="row text-end mb-3">
        <div class="col">
          <a href="tambah.php" class="btn btn-sm btn-primary shadow-sm">Tambah</a>
        </div>
      </div>
    </div>

    <!-- Tables -->

    <div class="container">

      <div class="panel-body">
        <div id="live">
          <table class="table table table-hover shadow-sm table-dark">
            <thead class="table-dark" style="background-color: #e2edff;">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Hp</th>
                  <th>Alamat</th>
                  <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
              <?php foreach ( $pelanggan as $row ): ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $row["pelanggan_nama"]; ?></td>
                <td><?= $row["pelanggan_hp"]; ?></td>
                <td><?= $row["pelanggan_alamat"]; ?></td>
                <td>
                  <a href="ubah.php?id=<?= $row["pelanggan_id"] ?>" class="btn btn-sm btn-info">Ubah</a>
                  <a href="hapus.php?id=<?= $row["pelanggan_id"]; ?>" class="btn btn-sm btn-danger" id="tombol">Hapus</a>
                </td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
      </div>
      </div>
    
      <!-- Nav Pagination -->
    <div arial-label="">
      <ul class="pagination justify-content-end">
        <li class="page-item shadow-sm">
          <?php if( $halamanAktif > 1 ) : ?>
            <a href="?page=<?= $halamanAktif - 1; ?>" class="page-link">
              <span aria-link="true">&laquo</span>
            </a>
          <?php endif; ?>
        </li>
        <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ): ?>
          <?php if( $i == $halamanAktif ) : ?>
            <li class="page-item active shadow-sm" aria-current="page"><a href="?page=<?= $i; ?>"  class="page-link"><?= $i; ?></a></li>
          <?php else : ?>
            <li class="page-item shadow-sm"><a href="?page=<?= $i; ?>"  class="page-link"><?= $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
          <li class="page-item shadow-sm">
            <?php if( $halamanAktif < $jumlahHalaman ) : ?>
              <a href="?page=<?= $halamanAktif + 1; ?>" class="page-link">
                <span aria-link="true">&raquo</span>
              </a>
            <?php endif; ?>
          </li>
      </ul>
    </div>
    <!-- Akhir Nav Pagination -->
    </div>
    <!-- Akhir Tables -->

    
    

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
  
  </body>
</html>