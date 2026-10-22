<?php
session_start();
include 'config/base_url.php';
include 'config/db.php';

$user_id = $_SESSION['user']['id'] ?? 0;

$query = "SELECT DISTINCT kode_invoice, tanggal_pesanan, tipe_order, metode_pembayaran, alamat, kota, kecamatan, jam_pickup, tanggal_pickup
          FROM `order`
          WHERE user_id = ?
          ";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$invoices = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
    }

    .navbar-custom {
      background-color: #ffffff;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
    }

    .card-order {
      background-color: #eaeaea;
      border-radius: 15px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 20px;
      margin-top: 30px;
    }

    .status-badge {
      background-color: #007f5f;
      color: white;
      border-radius: 20px;
      padding: 3px 10px;
      font-size: 0.8rem;
    }

    .btn-status {
      background-color: #004b3f;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      padding: 8px 16px;
    }

    .btn-status:hover {
      background-color: #00352e;
    }

    .btn-logout {
      background-color: #004b3f;
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
    }
  </style>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="<?= $base_url ?>">
        <img src="assets/img/logo.png" alt="Lasmi Logo" height="40">
      </a>

      <!-- Toggler for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>">HOME</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>product.php">OUR PRODUCT</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?= $base_url ?>order-list.php">ORDER LIST</a></li>
          <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $base_url ?>cart.php">CART</a>
            </li>
          <?php endif; ?>
        </ul>
        <a href="<?php if (isset($_SESSION['user'])) {
                    echo 'proses/logout.php';
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


  <!-- Order Card -->
  <div class="container mt-5" style="min-height: 70vh;">
    <h4 class="fw-bold mb-3">Order List</h4>

    <?php while ($invoice = $invoices->fetch_assoc()): ?>
      <div class="card-order shadow-sm">
        <img src="assets/img/produk-1.png" alt="Order Item" width="100" class="rounded" />
        <div class="flex-grow-1">
          <h6 class="mb-1 fw-bold">Invoice: <?= htmlspecialchars($invoice['kode_invoice']) ?></h6>
          <?= date("d M Y", strtotime($invoice['tanggal_pesanan'])) ?>
          <!-- Produk dalam invoice -->
          <ul class="mt-2 mb-2">
            <?php
            $kode_invoice = $invoice['kode_invoice'];
            $itemQuery = "SELECT nama_produk, quantity, size, cut, total_harga,status FROM `order` WHERE kode_invoice = ?";
            $itemStmt = $conn->prepare($itemQuery);
            $itemStmt->bind_param("s", $kode_invoice);
            $itemStmt->execute();
            $items = $itemStmt->get_result();
            $total = 0;
            $status = 'payment';
            while ($item = $items->fetch_assoc()):
              $total = $item['total_harga'];
              $status =  $item['status'];
            ?>
              <li><?= $item['nama_produk'] ?> (<?= $item['size'] ?> - <?= $item['cut'] ?>), Qty: <?= $item['quantity'] ?> </li>
            <?php endwhile; ?>
          </ul>
          <p class="mb-1">Metode: <?= ucfirst($invoice['tipe_order']) ?> - <?= $invoice['metode_pembayaran'] ?></p>
          <?php if ($invoice['tipe_order'] == 'delivery'): ?>
            <p class="mb-1">Alamat: <?= $invoice['alamat'] ?>, <?= $invoice['kecamatan'] ?>, <?= $invoice['kota'] ?></p>
          <?php else: ?>
            <p class="mb-1">Pickup: <?= $invoice['tanggal_pickup'] ?> jam <?= $invoice['jam_pickup'] ?></p>
          <?php endif; ?>
          <h6 class="mb-1 fw-bold">Total: Rp. <?= number_format($total, 0, ',', '.') ?></h6>
          <!-- <p class="mb-1 fw-bold" style="font-size: 2.5rem; line-height: 1;">Mocha</p> -->
        </div>
        <div>
          <?php if ($status == 'payment'): ?>
            <form action="proses/confirm_payment.php" method="POST" class="d-inline">
              <input type="hidden" name="kode_invoice" value="<?= $invoice['kode_invoice'] ?>">
              <button type="submit" class="btn btn-status">Confirm Payment</button>
            </form>
          <?php else : ?>
            <button class="btn btn-status">STATUS : <?= strtoupper($status) ?></button>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>

    <!-- <div class="card-order shadow-sm">
      <img src="assets/img/produk-1.png" alt="Order Item" width="100" class="rounded" />
      <div class="flex-grow-1">
        <h6 class="mb-1 fw-bold">Bolu Lapis</h6>
        <p class="mb-1 fw-bold" style="font-size: 2.5rem; line-height: 1;">Mocha</p>
      </div>
      <div>
        <button class="btn btn-status">DETAIL</button>
      </div>
    </div>
    <div class="card-order shadow-sm">
      <img src="assets/img/produk-1.png" alt="Order Item" width="100" class="rounded" />
      <div class="flex-grow-1">
        <h6 class="mb-1 fw-bold">Bolu Lapis</h6>
        <p class="mb-1 fw-bold" style="font-size: 2.5rem; line-height: 1;">Pandan</p>
      </div>
      <div>
        <button class="btn btn-status">DETAIL</button>
      </div>
    </div>
    <div class="card-order shadow-sm">
      <img src="assets/img/produk-1.png" alt="Order Item" width="100" class="rounded" />
      <div class="flex-grow-1">
        <h6 class="mb-1 fw-bold">Bolu Lapis</h6>
        <p class="mb-1 fw-bold" style="font-size: 2.5rem; line-height: 1;">Strawberry</p>
      </div>
      <div>
        <button class="btn btn-status">DETAIL</button>
      </div>
    </div> -->
  </div>
  <footer class="ls-bg-dark-green text-white mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Bolu Lapis Lasmi. All rights reserved.</p>
    </div>
  </footer>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>