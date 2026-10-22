<?php
session_start();
include('config/base_url.php');
$produk = $_GET['product'] ?? 'mocha';
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
    }

    .nav-link.active::after {
      content: '';
      display: block;
      width: 100%;
      height: 4px;
      background-color: #005142;
      margin-top: 4px;
      border-radius: 2px;
    }

    .badge-star {
      color: #FFD700;
      font-size: 1.2rem;
    }

    .nutrition-box {
      background-color: #005142;
      color: white;
      border-radius: 10px;
      padding: 15px;
      margin-top: 10px;
    }

    .btn-outline-option {
      border-radius: 20px;
      min-width: 80px;
      margin-right: 5px;
      margin-bottom: 5px;
    }

    .product-box {
      background-color: #f9f9f9;
      padding: 10px;
      border-radius: 10px;
      text-align: center;
    }

    .btn-add-cart {
      background-color: #005142;
      color: white;
      border-radius: 8px;
      padding: 10px;
      width: 100%;
    }

    .btn-add-cart:hover {
      background-color: #00352e;
    }

    .option-btn {
      background-color: #fff;
      color: #005142;
      border: none;
      font-weight: 600;
      border-radius: 10px;
      padding: 8px 16px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-right: 10px;
    }

    .option-btn {
      border: 1px solid #ccc;
      background-color: white;
      padding: 8px 16px;
      border-radius: 20px;
      margin-right: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    .option-btn:hover {
      background-color: #f0f0f0;
    }

    input[type="radio"] {
      display: none;
    }

    input[type="radio"]:checked+label {
      background-color: #e2725b;
      /* warna aktif */
      color: white;
      border-color: #e2725b;
    }

    .quantity-box {
      background-color: #f8f9fa;
      border-radius: 10px;
      text-align: center;
      padding: 10px 20px;
      font-weight: bold;
      color: #005142;
      border: none;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 70px;
    }

    .add-to-cart {
      background-color: #005142;
      color: white;
      font-weight: 600;
      padding: 12px;
      border: none;
      width: 100%;
      border-radius: 8px;
      margin-top: 20px;
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
          <li class="nav-item"><a class="nav-link active" href="<?= $base_url ?>product.php">OUR PRODUCT</a></li>
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

  <!-- Product Detail -->
  <div class="container">
    <div class="row my-3">
      <div class="col-12 col-md-4 text-center">
        <img src="assets/img/produk-1.png" class="img-fluid rounded" alt="Bolu Mocha" />
      </div>
      <div class="col-12 col-md-8">
        <span class="fw-bold ls-color-dark-green" style="font-size: 2.5rem;">BOLU LAPIS </span> <br>
        <span class="fw-bold ls-color-dark-green" style="font-size:3.5rem;line-height: 1;"><?php echo strtoupper($produk); ?></span>
        <div class="my-1">
          <h4 class="mb-0">Review</h4>
          <span class="badge-star" style="font-size: 1.5rem;">★ ★ ★ ★ ★</span>
        </div>
        <div class="ls-bg-dark-green text-white p-2 rounded w-75">
          <strong><?php echo strtoupper($produk); ?></strong> – The Original Flavoured dish of Bolu Lapis Lasmi
        </div>
      </div>
      <div class="col-12">
        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center" id="productTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="nutrition-tab" data-bs-toggle="tab" data-bs-target="#nutrition" type="button" role="tab">Nutrition Fact</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab">Ingredients</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="store-tab" data-bs-toggle="tab" data-bs-target="#store" type="button" role="tab">How to Store</button>
          </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content" id="productTabContent">
          <div class="tab-pane fade" id="nutrition" role="tabpanel">
            Nutrition Facts: (per 50g slice): Calories: 180 kcal · Total Fat: 8g · Saturated Fat: 5g · Sodium: 90mg · Carbohydrates: 24g · Sugars: 14g · Protein: 3g
          </div>
          <div class="tab-pane fade show active" id="ingredients" role="tabpanel">
            Ingredients: Premium Flour · Fresh Eggs · Fine Sugar · Butter/Margarine · Sweetened Condensed Milk · Baking Powder · Vanilla Extract · Natural Food Coloring · Optional Flavors: <strong>Pandan, Strawberry, Mocha</strong>
          </div>
          <div class="tab-pane fade" id="store" role="tabpanel">
            Keep refrigerated (0–4°C) and consume within 5–7 days · Store in an airtight container · Serve at room temperature for best taste
          </div>
        </div>
      </div>
    </div>

    <!-- Custom Order -->
    <h6><strong>Customize Order</strong></h6>
    <form action="proses/add_to_cart.php" method="POST" id="cartForm">
      <!-- USER ID (dari session atau hidden) -->
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?? ''; ?>">

      <!-- NAMA PRODUK -->
      <input type="hidden" name="nama_produk" value="<?php echo $produk; ?>">
      <div class="row align-items-center">
        <!-- Quantity -->
        <div class="col-auto">
          <small class="d-block">Quantity</small>
          <input type="number" class="quantity-box" name="quantity" id="quantity" value="1" min="1">
        </div>

        <!-- Size -->
        <div class="col-auto">
          <small class="d-block mb-2">Size</small>

          <input type="radio" id="size-small" name="size" value="small" checked>
          <label for="size-small" class="option-btn">SMALL</label>

          <input type="radio" id="size-large" name="size" value="large">
          <label for="size-large" class="option-btn">LARGE</label>
        </div>

        <!-- Cut -->
        <div class="col-auto">
          <small class="d-block">Cut</small>

          <input type="radio" id="cut" name="cut" value="cut" checked>
          <label for="cut" class="option-btn">CUT</label>

          <input type="radio" id="uncut" name="cut" value="uncut">
          <label for="uncut" class="option-btn">UNCUT</label>
        </div>
      </div>

      <!-- Price -->
      <div class="mt-3">
        <small class="text-muted">Product Price</small>
        <h5><strong id="priceDisplay">Rp. 15.000</strong></h5>
      </div>

      <!-- Hidden input untuk passing harga ke PHP -->
      <input type="hidden" name="harga" id="priceValue" value="15000">

      <!-- Add to Cart -->
      <button type="submit" class="add-to-cart">ADD TO CART</button>
    </form>

    <!-- More Flavours -->
    <h5 class="fw-bold mt-4">Add More Flavour</h5>
    <div class="row text-center">
      <div class="col-lg-3 col-md-4 mb-4">
        <div class="product-card rounded-5 bg-white">
          <img src="assets/img/produk-1.png" width="100%" class="img-fluid mb-2 rounded-5" alt="Mocha">
          <div class="text-center p-4 ls-color-dark-green">
            <h5 class="fw-bold">Pandan</h5>
            <p>Lorem Ipsum Solo De Amit</p>
            <button class="btn btn-color-dark-green rounded-pill px-4 fw-bold">Order</button>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 mb-4">
        <div class="product-card rounded-5 bg-white">
          <img src="assets/img/produk-1.png" width="100%" class="img-fluid mb-2 rounded-5" alt="Pandan">
          <div class="text-center p-4 ls-color-dark-green">
            <h5 class="fw-bold">Strawberry</h5>
            <p>Lorem Ipsum Solo De Amit</p>
            <button class="btn btn-color-dark-green rounded-pill px-4 fw-bold">Order</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="ls-bg-dark-green text-white mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Bolu Lapis Lasmi. All rights reserved.</p>
    </div>
  </footer>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    const priceDisplay = document.getElementById('priceDisplay');
    const priceValue = document.getElementById('priceValue');
    const quantityInput = document.getElementById('quantity');
    const sizeRadios = document.querySelectorAll('input[name="size"]');

    function updatePrice() {
      let size = document.querySelector('input[name="size"]:checked').value;
      let qty = parseInt(quantityInput.value);
      let basePrice = size === 'large' ? 25000 : 15000;
      let total = basePrice * qty;

      priceDisplay.textContent = "Rp. " + total.toLocaleString('id-ID');
      priceValue.value = total;
    }

    sizeRadios.forEach(radio => radio.addEventListener('change', updatePrice));
    quantityInput.addEventListener('input', updatePrice);
  </script>
</body>

</html>