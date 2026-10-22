<?php
session_start();
include 'config/db.php';
include 'config/base_url.php';
$user_id = $_SESSION['user']['id'];

$sql = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Hitung total harga
$total = 0;
$items = [];

while ($row = $result->fetch_assoc()) {
  $items[] = $row;
  $total += $row['harga']; // harga sudah termasuk quantity × harga satuan
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Bolu Lapis Lasmi</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .cart-box {
      background-color: #00594d;
      border-radius: 20px;
      color: white;
      padding: 20px;
    }

    .cart-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 20px;
    }

    .rounded-btn {
      border-radius: 12px;
    }

    .btn-yellow {
      background-color: #d39e18;
      color: white;
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
  <div class="container py-5" style="min-height: 70vh;">
    <div class="row g-4">
      <!-- Cart Item -->
      <div class="col-md-8">
        <?php if ($result->num_rows === 0): ?>
          <div class="col-12 text-center p-5">
            <h4 class="mt-3">Keranjang kamu masih kosong</h4>
            <p class="text-muted">Yuk lihat-lihat produk dan tambahkan ke keranjang.</p>
          </div>
        <?php else: ?>
          <?php foreach ($items as $row): ?>
            <div class="cart-item d-flex align-items-center cart-box mb-3" data-size="<?= $row['size'] ?>">
              <img src="assets/img/produk-1.png" alt="<?= $row['nama_produk'] ?>" class="cart-image me-3" style="width: 80px; height: 80px; object-fit: cover;">
              <div>
                <h5 class="mb-1"><?= htmlspecialchars($row['nama_produk']) ?></h5>
                <small><?= ucfirst($row['size']) ?> - <?= ucfirst($row['cut']) ?></small><br>
              </div>
              <div class="ms-auto d-flex align-items-center gap-2">
                <form action="proses/update_qty.php" method="POST" class="d-flex align-items-center update-cart-form">
                  <input type="hidden" name="cart_id" value="<?= $row['id'] ?>">
                  <input type="number" class="form-control quantity-box quantity-input" name="quantity" value="<?= $row['quantity'] ?>" min="1" style="width: 70px;">
                </form>
                <form action="proses/delete_cart.php" method="POST">
                  <input type="hidden" name="cart_id" value="<?= $row['id'] ?>">
                  <button type="submit" class="btn btn-link text-white fs-4" title="Hapus">&#128465;</button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Right Side Panel -->
      <div class="col-md-4 d-flex flex-column gap-3">
        <!-- Voucher -->
        <div class="bg-white p-3 rounded shadow-sm">
          <p class="fw-bold mb-2">Voucher Redeem</p>
          <input type="text" class="form-control mb-2" placeholder="Insert Code">
          <button class="btn btn-color-orange w-100 rounded-btn fw-bold">Check</button>
        </div>

        <!-- Order Summary -->
        <div class="bg-white p-3 rounded shadow-sm">
          <p class="fw-bold mb-2">Order Summary</p>
          <div class="d-flex justify-content-between mb-3">
            <span>Sub Total</span>
            <span id="subtotal-box">Rp. 0</span>
          </div>
          <a href="checkout.php" class="btn btn-color-dark-green w-100 rounded-btn fw-bold">Check Out</a>
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
    function updateSubtotal() {
      const cartItems = document.querySelectorAll('.cart-item');
      let total = 0;

      cartItems.forEach(item => {
        const qtyInput = item.querySelector('.quantity-input');
        const sizeRadio = item.querySelector('input[name="size"]:checked') || {
          value: item.dataset.size
        };

        const qty = parseInt(qtyInput.value) || 0;
        const size = sizeRadio.value || item.dataset.size;

        let pricePerUnit = (size === 'large') ? 25000 : 15000;
        total += pricePerUnit * qty;
      });

      // Update subtotal di tampilan
      const subtotalBox = document.querySelector('#subtotal-box');
      if (subtotalBox) {
        subtotalBox.textContent = 'Rp. ' + total.toLocaleString('id-ID');
      }
    }

    // Saat DOM ready
    $(document).ready(function() {
      // Event: quantity input change
      $('.quantity-input').on('input', function() {
        const form = $(this).closest('.update-cart-form');
        const formData = form.serialize();

        // Kirim update ke server
        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: formData,
          success: function(res) {
            console.log('Quantity updated');
            updateSubtotal(); // Hitung ulang setelah update sukses
          },
          error: function() {
            alert('Gagal mengupdate quantity.');
          }
        });
      });

      // Event: size radio button change
      $('input[name="size"]').on('change', function() {
        updateSubtotal(); // Recalculate only
      });

      // Jalankan saat awal
      updateSubtotal();
    });
  </script>

</body>

</html>