// Ambil Element
var keyword = document.getElementById("keyword");
var tombolCari = document.getElementById("tombol-cari");
var live = document.getElementById("live");

// Tambahkan event ketika di tulis
keyword.addEventListener("keyup", function () {
  // Buat object ajax
  var xhr = new XMLHttpRequest();
  // Cek ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        live.innerHTML = xhr.responseText;

    }
  }

  // Eksekusi ajax
  xhr.open('GET', '../ajax/pelanggan.php?keyword=' + keyword.value, true);
  xhr.send();
});
