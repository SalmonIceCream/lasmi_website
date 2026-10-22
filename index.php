<?php
session_start();
include 'config/base_url.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

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
          <li class="nav-item"><a class="nav-link active" href="<?= $base_url ?>">HOME</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>product.php">OUR PRODUCT</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>order-list.php">ORDER LIST</a></li>
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
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container ls-bg-primary rounded-5 p-5" style="background-image: url('assets/img/box-lasmi.png'); background-size: contain;background-repeat: no-repeat;background-position:right;">
      <div class="row">
        <div class="col-md-6">
          <div class="text-start">
            <span style="font-size: 1.5rem; font-weight: 800;">NOW COME IN</span><br>
            <span style="font-size: 4.5rem; font-weight: 900;line-height: 1;">LARGE <br> BOX</span><br>
            <a href="<?= $base_url ?>product.php" class="btn btn-light fw-bold mt-3 ls-color-orange rounded-pill px-4">ORDER NOW</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="container about-section p-5 text-center rounded-5">
    <h4>About Bolu Lapis Lasmi</h4>
    <p>Bolu Lapis Lasmi is a specialty bakery dedicated to crafting delicious, high-quality layered cakes. With a focus on freshness and customer satisfaction, we prepare each cake to order at our physical store. Supported by a passionate team, Bolu Lapis Lasmi combines traditional flavors with modern quality standards to bring you the perfect treat for any occasion.</p>
  </section>

  <!-- Product Section -->
  <section class="product-section my-5 ls-bg-primary py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="product-card rounded-5 bg-white">
            <img src="assets/img/produk-1.png" width="100%" class="img-fluid mb-2 rounded-5" alt="Mocha">
            <div class="text-center p-4 ls-color-orange">
              <h5 class="fw-bold">Mocha</h5>
              <p>Lorem Ipsum Solo De Amit</p>
              <a href="detail-product.php?product=mocha" class="btn btn-color-orange rounded-pill px-4 fw-bold">Order</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="product-card rounded-5 bg-white">
            <img src="assets/img/produk-1.png" width="100%" class="img-fluid mb-2 rounded-5" alt="Pandan">
            <div class="text-center p-4 ls-color-orange">
              <h5 class="fw-bold">Pandan</h5>
              <p>Lorem Ipsum Solo De Amit</p>
              <a href="detail-product.php?product=pandan" class="btn btn-color-orange rounded-pill px-4 fw-bold">Order</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="product-card rounded-5 bg-white">
            <img src="assets/img/produk-1.png" width="100%" class="img-fluid mb-2 rounded-5" alt="Strawberry">
            <div class="text-center p-4 ls-color-orange">
              <h5 class="fw-bold">Strawberry</h5>
              <p>Lorem Ipsum Solo De Amit</p>
              <a href="detail-product.php?product=strawberry" class="btn btn-color-orange rounded-pill px-4 fw-bold">Order</a>
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- Track Order Section -->
  <section class="track-section">
    <div class="container rounded-5 ls-bg-light-grey">
      <div class="row">
        <div class="col py-5 d-flex flex-column align-items-center justify-content-center text-center">
          <h4 style="font-weight: 800;font-size: 3rem;">Track Your Order</h4>
          <a href="<?= $base_url ?>order-list.php" class="btn btn-dark mt-2">HERE</a>
        </div>
        <div class="col">
          <img src="assets/img/icon-truck.png" alt="Truck Icon" class="img-fluid" style="max-width: 300px;">
        </div>
      </div>
    </div>
  </section>

  <footer class="ls-bg-dark-green text-white mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Bolu Lapis Lasmi. All rights reserved.</p>
    </div>
  </footer>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>