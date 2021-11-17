<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "londry");

function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    
    return $rows;
}

function tambah($data){
    global $conn;

    $nama = htmlspecialchars($data["pelanggan_nama"]);
    $noHp = htmlspecialchars($data["pelanggan_hp"]);
    $alamat = htmlspecialchars($data["pelanggan_alamat"]);

    $query = "INSERT INTO pelanggan 
    VALUES
    ('', '$nama', '$noHp', '$alamat')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    
    mysqli_query($conn, "DELETE FROM pelanggan WHERE pelanggan_id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = $data["pelanggan_id"];
    $nama = htmlspecialchars($data["pelanggan_nama"]);
    $noHp = htmlspecialchars($data["pelanggan_hp"]);
    $alamat = htmlspecialchars($data["pelanggan_alamat"]);

    $query = "UPDATE pelanggan SET
                pelanggan_nama = '$nama',
                pelanggan_hp = '$noHp',
                pelanggan_alamat = '$alamat'
            WHERE pelanggan_id = $id;
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM pelanggan WHERE 
                pelanggan_nama LIKE '%$keyword%' OR
                pelanggan_hp LIKE '%$keyword%' OR
                pelanggan_alamat LIKE '%$keyword%'
                ";
    return query($query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE  username = '$username'");

    if ( mysqli_fetch_assoc($result) ){
        echo "<script>
                alert('Username sudah ada!, silahkan ganti username baru');
            </script>";
        return false;
    }

    // Cek konfirmasi Password
    if ( $password !== $password2 ){
        echo "<script>
                alert('Konfirmasi Password tidak sesuai!');
            </script>";
        return false;
    }

    // Enkripsi Password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // Tambahkan User baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

