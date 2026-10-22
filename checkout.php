<?php
session_start();
include 'config/db.php';
include 'config/base_url.php';
if (isset($_GET['error'])) {
  echo "<div class='alert alert-danger'>" . $_GET['error'] . "</div>";
}
$user_id = $_SESSION['user']['id']; // pastikan sudah login

// Ambil semua item cart user
$query = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
  $items[] = $row;
}
$subtotal = 0;
foreach ($items as $item) {
  $quantity = $item['quantity'];
  $size = strtolower($item['size']);

  // Harga berdasarkan size
  $price = ($size === 'large') ? 25000 : 15000;

  $subtotal += $price * $quantity;
}

// Biaya pengiriman default
$delivery_fee = 10000; // 10K
$total = $subtotal;

// Optional: hanya jika user memilih delivery
if (isset($_GET['delivery']) && $_GET['delivery'] == 1) {
  $total += $delivery_fee;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
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

    .btn-check-fee {
      background-color: #b57a0a;
      color: white;
      border-radius: 12px;
      padding: 6px 20px;
      border: none;
    }

    input[type="radio"].btn-check:checked+label {
      background-color: #00594d;
      border-color: #00594d;
      color: #fff;
      font-weight: bold;
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
          <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>order-list.php">ORDER LIST</a></li>
          <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
              <a class="nav-link active" href="<?= $base_url ?>cart.php">CART</a>
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

  <div class="container" style="min-height: 70vh; padding-top: 50px;">
    <div class="row g-4">
      <!-- Left Section -->
      <div class="col-md-8 d-flex flex-column gap-3">
        <!-- Pick-Up Method -->
        <div class="section-box" id="select-method">
          <h5 class="fw-bold text-center mb-3">Pick-Up Method</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="white-box delivery" style="cursor: pointer;">Delivery</div>
            </div>
            <div class="col-md-6">
              <div class="white-box pickup" style="cursor: pointer;">Self Pick Up</div>
            </div>
          </div>
        </div>

        <div class="section-box d-none" id="delivery-section">
          <!-- Back Arrow dan Title -->
          <div class="d-flex align-items-center mb-3">
            <button class="btn btn-link text-white p-0 me-2 back-button" style="font-size: 1.2rem; font-weight: 900; ">
              <i class="bi bi-chevron-left"></i>
            </button>
            <!-- <h5 class="mb-0 fw-bold">Pick Up</h5> -->
            <h5 class="fw-bold text-center mb-0">Delivery</h5>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" id="kota-input" class="form-control rounded-pill">
            </div>
            <div class="col-md-6">
              <label class="form-label">District</label>
              <input type="text" id="kecamatan-input" class="form-control rounded-pill">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Full Address</label>
            <input type="text" id="alamat-input" class="form-control rounded-pill">
          </div>
          <div class="text-end">
            <button class="btn-check-fee">Fee Check</button>
          </div>
        </div>
        <div class="section-box d-none" id="pickup-section">
          <div class="d-flex align-items-center mb-3">
            <button class="btn btn-link text-white p-0 me-2 back-button" style="font-size: 1.2rem; font-weight: 900; ">
              <i class="bi bi-chevron-left"></i>
            </button>
            <h5 class="fw-bold text-center mb-0">Pick Up</h5>
          </div>
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" id="pickup-date" class="form-control rounded-pill">
          </div>
          <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" id="pickup-time" class="form-control rounded-pill">
          </div>
          <div class="text-end">
            <button class="btn-check-fee">Confirm</button>
          </div>
        </div>
        <!-- Payment Method -->
        <div class="section-box">
          <h5 class="fw-bold mb-3">Payment Method</h5>

          <p class="mb-2">Bank Transfer</p>
          <div class="row g-2 mb-3">
            <div class="col-md-4">
              <input type="radio" class="btn-check" name="payment_method" id="bca" value="BCA" autocomplete="off">
              <label class="btn btn-light w-100 rounded-pill" for="bca">BCA</label>
            </div>
            <div class="col-md-4">
              <input type="radio" class="btn-check" name="payment_method" id="bni" value="BNI" autocomplete="off">
              <label class="btn btn-light w-100 rounded-pill" for="bni">BNI</label>
            </div>
            <div class="col-md-4">
              <input type="radio" class="btn-check" name="payment_method" id="bri" value="BRI" autocomplete="off">
              <label class="btn btn-light w-100 rounded-pill" for="bri">BRI</label>
            </div>
          </div>

          <p class="mb-2">E-Wallet</p>
          <div class="row g-2">
            <div class="col-md-4">
              <input type="radio" class="btn-check" name="payment_method" id="ovo" value="OVO" autocomplete="off">
              <label class="btn btn-light w-100 rounded-pill" for="ovo">OVO</label>
            </div>
            <div class="col-md-4">
              <input type="radio" class="btn-check" name="payment_method" id="gopay" value="Gopay" autocomplete="off">
              <label class="btn btn-light w-100 rounded-pill" for="gopay">Gopay</label>
            </div>
            <div class="col-md-4">
              <input type="radio" class="btn-check" name="payment_method" id="dana" value="Dana" autocomplete="off">
              <label class="btn btn-light w-100 rounded-pill" for="dana">Dana</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-md-4">
        <div class="summary-box shadow-sm">
          <p class="fw-bold">Order Summary</p>
          <div class="d-flex justify-content-between">
            <span>Sub Total</span>
            <span id="subtotal-box">Rp. <?= number_format($subtotal, 0, ',', '.') ?></span>
          </div>
          <div class="d-flex justify-content-between" id="delivery-fee-row" style="display: none;">
            <span>Delivery Fee</span>
            <span id="delivery-fee-text">Rp. 0</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold">
            <span>Total</span>
            <span id="total-box">Rp. <?= number_format($total, 0, ',', '.') ?></span>
          </div>
          <form action="proses/order.php" method="POST" id="orderForm">
            <!-- Hidden Inputs -->
            <input type="hidden" name="tipe_order" id="tipe_order">
            <input type="hidden" name="total_harga" id="total_harga">
            <input type="hidden" name="metode_pembayaran" id="metode_pembayaran">

            <!-- Alamat Delivery -->
            <input type="hidden" name="alamat" id="alamat">
            <input type="hidden" name="kota" id="kota">
            <input type="hidden" name="kecamatan" id="kecamatan">

            <!-- Pickup -->
            <input type="hidden" name="tanggal_pickup" id="tanggal_pickup">
            <input type="hidden" name="jam_pickup" id="jam_pickup">

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-dark-green mt-3">Continue Payment</button>
          </form>
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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      function showSection(showId) {
        const sections = ['#pickup-section', '#delivery-section', '#select-method'];
        sections.forEach(function(id) {
          $(id).toggleClass('d-none', id !== showId);
        });
      }

      function getSubtotal() {
        // Ambil nilai angka dari teks seperti "Rp. 25.000"
        return parseInt($('#subtotal-box').text().replace(/[Rp. ]/g, '').replace('.', '')) || 0;
      }

      function updateTotal(isDelivery) {
        const fee = 10000;
        const subtotal = getSubtotal();
        let total = subtotal;

        if (isDelivery) {
          $('#delivery-fee-row').show();
          $('#delivery-fee-text').text('Rp. ' + fee.toLocaleString('id-ID'));
          total += fee;
        } else {
          $('#delivery-fee-row').hide();
          $('#delivery-fee-text').text('Rp. 0');
        }

        $('#total-box').text('Rp. ' + total.toLocaleString('id-ID'));
      }

      $('.delivery').click(function() {
        showSection('#delivery-section');
        updateTotal(true);
      });

      $('.pickup').click(function() {
        showSection('#pickup-section');
        updateTotal(false);
      });

      $('.back-button').click(function() {
        showSection('#select-method');
      });

      // Inisialisasi awal (jika ingin langsung update saat halaman load)
      updateTotal(false);

      // Saat klik metode pembayaran
      $('.btn-check').change(function() {
        const method = $(this).val();
        $('#metode_pembayaran').val(method);
      });

      let tipeOrder = ''; // penanda pilihan

      // Saat klik pickup
      $('.pickup').click(function() {
        tipeOrder = 'pickup';
        $('#tipe_order').val('pickup');

        // Kosongkan yang tidak relevan
        $('#alamat, #kota, #kecamatan').val('');
        $('#alamat-input, #kota-input, #kecamatan-input').val('');

        // Tampilkan form pickup
        showSection('#pickup-section');

        // Update total harga
        let total = parseInt($('#total-box').text().replace(/[Rp. ]/g, ''));
        $('#total_harga').val(total);
      });

      // Saat klik delivery
      $('.delivery').click(function() {
        tipeOrder = 'delivery';
        $('#tipe_order').val('delivery');

        // Kosongkan yang tidak relevan
        $('#tanggal_pickup, #jam_pickup').val('');
        $('#pickup-date, #pickup-time').val('');

        // Tampilkan form delivery
        showSection('#delivery-section');

        // Update total harga
        let total = parseInt($('#total-box').text().replace(/[Rp. ]/g, ''));
        $('#total_harga').val(total);
      });

      // Update hidden input sesuai isian (pickup)
      $('#pickup-date, #pickup-time').on('input change', function() {
        if (tipeOrder === 'pickup') {
          $('#tanggal_pickup').val($('#pickup-date').val());
          $('#jam_pickup').val($('#pickup-time').val());
        }
      });

      // Update hidden input sesuai isian (delivery)
      $('#alamat-input, #kota-input, #kecamatan-input').on('input change', function() {
        if (tipeOrder === 'delivery') {
          $('#alamat').val($('#alamat-input').val());
          $('#kota').val($('#kota-input').val());
          $('#kecamatan').val($('#kecamatan-input').val());
        }
      });

      // Fungsi tampilkan section sesuai id
      function showSection(showId) {
        const sections = ['#pickup-section', '#delivery-section', '#select-method'];
        sections.forEach(function(id) {
          $(id).toggleClass('d-none', id !== showId);
        });
      }
    });
  </script>
</body>

</html>