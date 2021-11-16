<?php

include '../function/functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM pelanggan WHERE 
        pelanggan_nama LIKE '%$keyword%' OR
        pelanggan_hp LIKE '%$keyword%' OR
        pelanggan_alamat LIKE '%$keyword%'
    ";
$pelanggan = query($query);



?>

<table class="table table table-hover shadow-sm">
            <thead class="table-light" style="background-color: #e2edff;">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Hp</th>
                  <th>Alamat</th>
                  <th>Opsi</th>
                </tr>
            </thead>
            <tbody style="background-color: white;">
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