<?php require '../config/function.php';?>
<?php
if (isset($_POST['login'])) {
    if ($_POST > 0) {
        login($_POST);
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Signin Template · Bootstrap v5.0</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/signin.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body class="text-center">

<main class="form-signin">
  <form action="" method="post">
    <img src="https://pikobar.jabarprov.go.id/img/logo-relawan-covid.png" alt="" width="150" height="150">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <label for="username" class="visually-hidden">Username</label>
    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
    <label for="password" class="visually-hidden">Password</label>
    <input type="password" id="password" name="password" class="form-control mt-1" placeholder="Password" required>
    <button class="w-100 btn btn-lg btn-danger" type="submit" name="login" id="login">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy;2021</p>
  </form>
</main>


    
  </body>
</html>
