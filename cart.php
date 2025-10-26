<?php
if (!isset($_SESSION)) {
    session_start();
}

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['price'])) {
    $item = array(
        'title' => $_POST['title'],
        'price' => floatval($_POST['price'])
    );
    $_SESSION['cart'][] = $item;
}

// Remove item
if (isset($_GET['remove'])) {
    $removeIndex = (int) $_GET['remove'];
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
    }
}

include 'header.php';
?>

<style>
/* 🌌 Page Background (same as shop) */
body {
    background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center fixed;
    background-size: cover;
}

/* 🛒 Cart Box */
.cart-container {
    background: rgba(30, 30, 30, 0.95);
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 0 20px rgba(111, 66, 193, 0.6);
}

/* 🎨 Table Styling */
.cart-table th {
    color: #00ff88;
    font-weight: bold;
    text-transform: uppercase;
}
.cart-table td {
    vertical-align: middle;
    font-size: 1rem;
}
.cart-table tr:hover {
    background: rgba(111, 66, 193, 0.3);
}

/* ❌ Remove Button */
.btn-remove {
    background: #ff4e50;
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 5px 12px;
    border-radius: 6px;
    transition: 0.3s;
    text-decoration: none;
}
.btn-remove:hover {
    background: #ff6f61;
    box-shadow: 0 0 10px #ff4e50;
    text-decoration: none;
}

/* ✅ Checkout Button */
.checkout-btn {
    background: linear-gradient(90deg, #6f42c1, #9b59b6);
    border: none;
    color: #fff;
    font-weight: bold;
    border-radius: 8px;
    padding: 12px 25px;
    transition: 0.3s;
    text-decoration: none;
    display: inline-block;
}
.checkout-btn:hover {
    background: linear-gradient(90deg, #9b59b6, #6f42c1);
    box-shadow: 0 0 15px #9b59b6;
}

/* 🔥 Matching Title */
h2.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    text-align: center;
    background: linear-gradient(90deg, #ff4e50, #ff6f61, #00ff88, #6f42c1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 300% 300%;
    animation: gradient-flow 6s infinite linear;
    margin-bottom: 2rem;
}
@keyframes gradient-flow {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}
</style>

<div class="container py-5">
    <h2 class="section-title">YOUR CART</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="cart-container table-responsive">
            <table class="table table-dark table-hover align-middle cart-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Game</th>
                        <th>Price</th>
                        <th></th>
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
                            <td>
                                <a href="cart.php?remove=<?php echo $index; ?>" class="btn-remove">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="fw-bold">
                        <td colspan="2" class="text-end">TOTAL:</td>
                        <td colspan="2" class="text-success">₱<?php echo number_format($total, 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

       
        <div class="text-end mt-3">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="checkout.php" class="checkout-btn">PROCEED TO CHECKOUT</a>
    <?php else: ?>
        <a href="login.php" class="checkout-btn" style="background: #ff4e50;">LOGIN TO CHECKOUT</a>
    <?php endif; ?>
         <a href="shop.php" class="checkout-btn" style="background: #00ff88; color:#000;">CONTINUE SHOPPING</a>
        </div>

    <?php else: ?>
        <p class="text-center text-muted fs-10">NO GAMES FOUND</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
