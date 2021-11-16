<?php
if ( isset($_POST["login"]) ){
 
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    // Cek Username
    if ( mysqli_num_rows($result) === 1 ){

        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ){
            // Set session
            $_SESSION["login"] = true;

            // Cek rememberme 
            // if ( isset($_POST['remember']) ){
            //     setcookie('login', 'true', time()+60)
            // }
            if ( isset($_POST["remember"]) ){
                // Buat COOKIE
                setcookie('haha', $row["id"], time()+60);
                setcookie('hm', hash('sha256', $row["username"]), time()+60);
            }


            header("location:admin/index.php");
            exit;
        }

    }

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Form Login</title>
</head>
<body>
    <div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-5">
        <div class="card">
            <div class="card-header  mb-0"><h5 class="text-center">Sistem Informasi Laundry<br/> SMKN 7 Baleendah</h5></div>
            <div class="card-body">
            
                <?php 
                
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                        echo "<div class='alert alert-danger'>Login gagal! username dan password salah!</div>";
                    }else if($_GET['pesan'] == "logout"){
                        echo "<div class='alert alert-info'>Anda telah berhasil logout</div>";
                    }else if($_GET['pesan'] == "belum_login"){
                        echo "<div class='alert alert-danger'>Anda harus login untuk mengakses halaman admin</div>";
                    }
                }
            ?>          
            <form action="" method="post">
            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="Username" class="form-control from-control-sm" id="Username" aria-describedby="emailHelp" name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control form-control-sm" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <input type="submit" class="btn btn-primary" value="Log In" name="login">    
            </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</body>
</html>