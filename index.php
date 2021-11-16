<?php

session_start();
include 'function/functions.php';

if ( isset($_COOKIE["haha"]) && isset($_COOKIE["hm"]) ){
    $id = $_COOKIE['haha'];
    $hm = $_COOKIE['hm'];

    // Ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id ");

    $row = mysqli_fetch_assoc($result);

    // Cek cookie dan username
    if ( $hm === hash('sha256', $row['username']) ){
        $_SESSION['login'] = true;
    }
}

if ( isset($_SESSION["login"]) ){
    header("location:admin/index.php");
    exit;
}

if ( isset($_POST["login"]) ){
 
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

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

    $error = true;

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

    <link rel="stylesheet" href="css/style.css">

    <title>Hello, world!</title>
  </head>
  <body>

  <div class="global-container">

    <div class="flash-data"></div>
      <div class="card login-form">
          <div class="card-body">
              <h1 class="card-title text-center">Login</h1>
              <div class="card-text">
            <?php if( isset($error) ): ?>
               <div id="alert"></div>
            <?php endif; ?>
                  <form action="" method="post">
                      <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control form-control-sm" id="username" name="username">
                      </div>
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control form-control-sm" id="password" name="password">
                      </div>
                      <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>

                      <div class="mb-3 form-check">
                          <label for="me" class="form-check-label">Remember Me</label>
                          <input type="checkbox" name="remember" class="form-check-input" id="me">
                      </div>

                      <div class="signup">
                          Don't have an account? <a href="register.php">Create one</a>
                      </div>
                  </form>
              </div>
          </div>
      </div>

  </div>

  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/alert.js"></script>

  </body>
</html>