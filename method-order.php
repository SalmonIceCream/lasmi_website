<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .section-box {
      background-color: #fcd465;
      /* kuning muda */
      border-radius: 20px;
      padding: 20px;
      color: #5c4400;
    }

    .white-box {
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      font-weight: bold;
      color: #d39e18;
    }

    .summary-box {
      background-color: #f2efef;
      border-radius: 20px;
      padding: 20px;
    }

    .btn-dark-green {
      background-color: #00594d;
      color: white;
      border-radius: 12px;
      width: 100%;
    }

    .payment-option {
      background-color: white;
      border: none;
      border-radius: 12px;
      padding: 10px 0;
      text-align: center;
      font-weight: 500;
      color: #5c4400;
    }
  </style>
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="Lasmi Logo"></a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">HOME</a></li>
          <li class="nav-item"><a class="nav-link" href="#">OUR PRODUCT</a></li>
          <li class="nav-item"><a class="nav-link" href="#">ORDER LIST</a></li>
        </ul>
        <button class="btn btn-color-dark-green rounded-pill py-2 px-4 ls-bold-700">LOGIN</button>
      </div>
    </div>
  </nav>

  <div class="container" style="min-height: 70vh; padding-top: 50px;">
    <div class="row g-4">
      <!-- Left Section -->
      <div class="col-md-8 d-flex flex-column gap-3">
        <!-- Pick-Up Method -->
        <div class="section-box">
          <h5 class="fw-bold text-center mb-3">Pick-Up Method</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="white-box">Delivery</div>
            </div>
            <div class="col-md-6">
              <div class="white-box">Self Pick Up</div>
            </div>
          </div>
        </div>

        <!-- Payment Method -->
        <div class="section-box">
          <h5 class="fw-bold mb-3">Payment Method</h5>
          <p class="mb-2">Bank Transfer</p>
          <div class="row g-2 mb-3">
            <div class="col-md-4"><button class="payment-option w-100">BCA</button></div>
            <div class="col-md-4"><button class="payment-option w-100">BNI</button></div>
            <div class="col-md-4"><button class="payment-option w-100">BRI</button></div>
          </div>

          <p class="mb-2">E-Wallet</p>
          <div class="row g-2">
            <div class="col-md-4"><button class="payment-option w-100">OVO</button></div>
            <div class="col-md-4"><button class="payment-option w-100">Gopay</button></div>
            <div class="col-md-4"><button class="payment-option w-100">Dana</button></div>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-md-4">
        <div class="summary-box shadow-sm">
          <p class="fw-bold">Order Summary</p>
          <div class="d-flex justify-content-between">
            <span>Sub Total</span>
            <span>xxxxx</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold">
            <span>Total</span>
            <span>2500000</span>
          </div>
          <button class="btn btn-dark-green mt-3">Continue Payment</button>
        </div>
      </div>
    </div>
  </div>
  <footer class="ls-bg-dark-green text-white mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Bolu Lapis Lasmi. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>