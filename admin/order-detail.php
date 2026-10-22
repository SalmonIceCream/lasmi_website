<?php
session_start();
include '../config/base_url.php';
include '../config/db.php';

$invoice = $_GET['invoice'] ?? '';
if (empty($invoice)) {
  echo "Invoice tidak ditemukan.";
  exit;
}

// Ambil semua order berdasarkan invoice
$stmt = $conn->prepare("SELECT * FROM `order` WHERE kode_invoice = ?");
$stmt->bind_param("s", $invoice);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

// Ambil status sekarang
$current_status = $orders[0]['status'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Bolu Lapis Lasmi</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffffff;
    }

    .header-bar {
      background-color: white;
      padding: 10px 20px;
    }

    .invoice-box {
      background-color: #015b4f;
      color: white;
      text-align: center;
      border-radius: 10px;
      padding: 10px;
    }

    .field-box {
      background-color: #e9e9e9;
      border-radius: 12px;
      padding: 10px;
      margin-bottom: 10px;
    }

    .progress-btn {
      background-color: #e0e0e0;
      border: none;
      border-radius: 10px;
      padding: 10px 12px;
      width: 100%;
      font-weight: 500;
    }

    .update-btn {
      background-color: #015b4f;
      color: white;
      border-radius: 10px;
      width: 100%;
      padding: 10px;
      border: none;
      font-weight: 600;
      margin-top: 20px;
    }

    .back-btn {
      background-color: #015b4f;
      color: white;
      border: none;
      font-size: 24px;
      border-radius: 10px;
      padding: 0 15px;
      height: 40px;
    }

    input[type="radio"].btn-check:checked+label {
      background-color: #00594d;
      border-color: #00594d;
      color: #fff;
      font-weight: bold;
    }
  </style>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="<?= $base_url ?>">
        <img src="../assets/img/logo.png" alt="Lasmi Logo" height="40">
      </a>

      <!-- Toggler for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="<?= $base_url ?>dashboard.php">Admin Dashboard</a></li>
        </ul>
        <a href="<?php if (isset($_SESSION['user'])) {
                    echo '../proses/logout.php';
                  } else {
                    echo 'login.php';
                  } ?>"
          class="btn btn-color-dark-green rounded-pill py-2 px-4 ms-lg-3 mt-2 mt-lg-0 ls-bold-700">
          <?php
          if (isset($_SESSION['user'])) {
            echo 'LOGOUT';
          } else {
            echo 'LOGIN';
          } ?>
        </a>
      </div>
    </div>
  </nav>
  <div class="container py-4" style="min-height: 70vh;">
    <!-- Invoice and Back -->
    <div class="d-flex align-items-center my-3">
      <button class="back-btn me-2">&larr;</button>
      <div class="invoice-box flex-grow-1">INVOICE <?= $invoice ?></div>
    </div>

    <!-- User Info -->
    <div class="field-box">Name</div>
    <div class="field-box">Phone Number</div>
    <div class="field-box">Address</div>
    <form action="../proses/update_order.php" method="POST">
      <input type="hidden" name="invoice" value="<?= $invoice ?>">
      <!-- Progress -->
      <?php
      $progress = [
        "Payment",
        "In Making",
        "Bake Done",
        "Packaging",
        "On Delivery",
        "Finished"
      ];
      ?>
      <div class="row">
        <?php foreach ($progress as $status): ?>
          <div class="col-4 mb-2">
            <input type="radio" class="btn-check" name="status" id="status-<?= strtolower(str_replace(' ', '-', $status)) ?>" value="<?= $status ?>" <?= ($status === $current_status) ? 'checked' : '' ?>>
            <label class="btn btn-light w-100 progress-btn" for="status-<?= strtolower(str_replace(' ', '-', $status)) ?>">
              <?= $status ?>
            </label>
          </div>
        <?php endforeach; ?>
      </div>

      <button type="submit" class="update-btn">Update Status</button>
    </form>

  </div>
  <footer class="ls-bg-dark-green text-white mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Bolu Lapis Lasmi. All rights reserved.</p>
    </div>
  </footer>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>