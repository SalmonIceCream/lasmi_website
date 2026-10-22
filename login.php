<?php
include 'config/base_url.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #004b3f;
      /* hijau tua */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .login-card {
      background-color: #e0e0e0;
      border-radius: 30px;
      padding: 40px 30px;
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 15px;
    }

    .btn-login {
      background-color: #004b3f;
      color: white;
      border-radius: 20px;
      padding: 10px 30px;
      font-weight: 600;
    }

    .btn-login:hover {
      background-color: #00352e;
    }

    .register-link {
      color: #004b3f;
      font-weight: 600;
      text-decoration: none;
    }

    .register-link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="login-card shadow">
    <h2 class="fw-bold mb-4">Login</h2>
    <form action="proses/login_proses.php" method="POST">
      <input type="text" class="form-control" name="username" placeholder="Phone Number" required>
      <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
      <button type="submit" class="btn btn-login mt-2">Login</button>
    </form>
    <p class="mt-3 mb-0">
      Doesn’t Have an account?
      <a href="<?= $base_url ?>register.php" class="register-link">Register</a>
    </p>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>