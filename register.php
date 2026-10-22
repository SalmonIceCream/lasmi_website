<?php
include 'config/base_url.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #004b3f;
      /* warna hijau tua */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .register-card {
      background-color: #d9d9d9;
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

    .btn-register {
      background-color: #004b3f;
      color: white;
      border-radius: 20px;
      padding: 10px 30px;
      font-weight: 600;
    }

    .btn-register:hover {
      background-color: #00352e;
    }

    .login-link {
      color: #004b3f;
      font-weight: 600;
      text-decoration: none;
    }

    .login-link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="register-card shadow">
    <h2 class="fw-bold mb-4">Register</h2>
    <form method="post" action="<?php echo $base_url ?>proses/register_proses.php">
      <input type="text" class="form-control" name="nohp" placeholder="Phone Number" required />
      <input type="password" class="form-control" name="password" placeholder="Enter Password" required />
      <input type="password" class="form-control" name="re_password" placeholder="Re-Enter Password" required />
      <button type="submit" class="btn btn-register mt-2">REGISTER</button>
    </form>
    <p class="mt-3 mb-0">
      Have an account? <a href="<?php echo $base_url ?>login.php" class="login-link">Log In</a>
    </p>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>