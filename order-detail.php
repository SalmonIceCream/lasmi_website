<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
          <li class="nav-item"><a class="nav-link active" href="#">Admin Dashboard</a></li>
        </ul>
        <button class="btn btn-color-dark-green rounded-pill py-2 px-5 ls-bold-700">Logout</button>
      </div>
    </div>
  </nav>

  <div class="container py-4" style="min-height: 70vh;">
    <!-- Invoice and Back -->
    <div class="d-flex align-items-center my-3">
      <button class="back-btn me-2">&larr;</button>
      <div class="invoice-box flex-grow-1">INVOICE #XX1XXX</div>
    </div>

    <!-- User Info -->
    <div class="field-box">Name</div>
    <div class="field-box">Phone Number</div>
    <div class="field-box">Address</div>

    <!-- Progress -->
    <div class="mb-2 fw-bold">Progress</div>
    <div class="row g-2">
      <div class="col-4"><button class="progress-btn">Payment</button></div>
      <div class="col-4"><button class="progress-btn">In Making</button></div>
      <div class="col-4"><button class="progress-btn">Bake Done</button></div>
      <div class="col-4"><button class="progress-btn">Packaging</button></div>
      <div class="col-4"><button class="progress-btn">On Delivery</button></div>
      <div class="col-4"><button class="progress-btn">Finished</button></div>
    </div>

    <button class="update-btn">Update Status</button>
  </div>
  <footer class="ls-bg-dark-green text-white mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Bolu Lapis Lasmi. All rights reserved.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>