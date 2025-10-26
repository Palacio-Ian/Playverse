<?php
session_start();
include 'db.php';

// ✅ Require login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = 'checkout.php';
    header("Location: login.php?message=Please login to complete checkout");
    exit;
}

// ✅ Require items in cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    include 'header.php';
    echo "<div class='container text-center py-5'>
            <h3>Your cart is empty!</h3>
            <a href='shop.php' class='btn btn-gaming mt-3'>Go back to Shop</a>
          </div>";
    include 'footer.php';
    exit;
}

// ✅ Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += floatval($item['price']);
}

// ✅ When user confirms checkout
if (isset($_POST['confirm'])) {
    $user_id = $_SESSION['user_id'];

    // 🔒 Insert order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed (orders): " . $conn->error);
    }

    $stmt->bind_param("id", $user_id, $total);
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // 🔒 Insert each cart item
        $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, game_title, price) VALUES (?, ?, ?)");
        if (!$itemStmt) {
            die("Prepare failed (order_items): " . $conn->error);
        }

        foreach ($_SESSION['cart'] as $item) {
            $title = $item['title'];
            $price = floatval($item['price']);
            $itemStmt->bind_param("isd", $order_id, $title, $price);
            $itemStmt->execute();
        }

        // ✅ Clear cart after success
        unset($_SESSION['cart']);

        // ✅ Redirect to success.php
        header("Location: success.php?order_id=" . $order_id);
        exit;
    } else {
        die("Error saving order: " . $conn->error);
    }
}
?>

<?php include 'header.php'; ?>

<style>
body {
    background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center fixed;
    background-size: cover;
}
.checkout-container {
    background: rgba(30,30,30,0.95);
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 0 20px rgba(111, 66, 193, 0.6);
}
.checkout-btn {
    background: linear-gradient(90deg, #6f42c1, #9b59b6);
    border: none;
    color: #fff;
    font-weight: bold;
    border-radius: 8px;
    padding: 12px 25px;
    transition: 0.3s;
}
.checkout-btn:hover {
    background: linear-gradient(90deg, #9b59b6, #6f42c1);
    box-shadow: 0 0 15px #9b59b6;
}
</style>

<div class="container py-5">
    <h2 class="section-title">CHECKOUT</h2>
    <div class="checkout-container table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Game</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $index => $item):
                    $total += $item['price'];
                ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td class="text-success fw-bold">₱<?php echo number_format($item['price'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="fw-bold">
                    <td colspan="2" class="text-end">TOTAL:</td>
                    <td class="text-success">₱<?php echo number_format($total, 2); ?></td>
                </tr>
            </tbody>
        </table>
        <form method="POST" class="text-end">
            <button type="submit" name="confirm" class="checkout-btn">CONFIRM ORDER</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
