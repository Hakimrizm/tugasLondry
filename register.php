<?php

include 'function/functions.php';

if ( isset($_POST["register"]) ){

    if ( registrasi($_POST) > 0 ){
        echo "<script>
                alert('Data berhasil ditambahkan!');
            </script>";
    } else {
        echo mysqli_error($conn);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <style>
        html,body{
            background-color: #0D1117 !important;
        }
    </style>

    <title>Sign Up</title>
  </head>
  <body>


  <div class="global-container">

      <div class="card login-form">
          <div class="card-body">
              <h1 class="card-title text-center">Sign up</h1>
              <div class="card-text">
                  <form action="" method="post">

                      <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control form-control-sm" id="username" name="username">
                      </div>
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control form-control-sm" id="password" name="password">
                      </div>
                      <div class="form-group">
                          <label for="password2">Password</label>
                          <input type="password" class="form-control form-control-sm" id="password2" name="password2">
                      </div>
                      <button type="submit" class="btn btn-primary btn-block" name="register">Sign Up</button>

                  </form>
              </div>
          </div>
      </div>

  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/sweetalert2.all.min.js"></script>
  </body>
</html>