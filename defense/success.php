<?php
session_start();
include 'db.php';
include 'header.php';

// ✅ Redirect if no order_id
if (!isset($_GET['order_id'])) {
    header("Location: shop.php");
    exit;
}

$order_id = intval($_GET['order_id']);

// ✅ Fetch order details (without get_result)
$stmt = $conn->prepare("SELECT o.id, o.total, o.order_date, u.username 
                        FROM orders o 
                        JOIN users u ON o.user_id = u.id 
                        WHERE o.id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->bind_result($id, $total, $order_date, $username);
if ($stmt->fetch()) {
    $order = array(
        'id' => $id,
        'total' => $total,
        'order_date' => $order_date,
        'username' => $username
    );
} else {
    echo "<div class='container text-center py-5'><h3>❌ Order not found!</h3></div>";
    include 'footer.php';
    exit;
}
$stmt->close();

// ✅ Fetch order items (without get_result)
$itemStmt = $conn->prepare("SELECT game_title, price FROM order_items WHERE order_id = ?");
$itemStmt->bind_param("i", $order_id);
$itemStmt->execute();
$itemStmt->bind_result($game_title, $price);

$items = array();
while ($itemStmt->fetch()) {
    $items[] = array('game_title' => $game_title, 'price' => $price);
}
$itemStmt->close();
?>

<style>
body {
    background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center fixed;
    background-size: cover;
}
.success-container {
    background: rgba(30, 30, 30, 0.95);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 0 25px rgba(111, 66, 193, 0.6);
}
.success-title {
    font-size: 2rem;
    font-weight: 800;
    color: #00ff88;
}
.order-table {
    color: #fff;
}
.btn-gaming {
    background: linear-gradient(90deg, #6f42c1, #9b59b6);
    border: none;
    color: #fff;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s;
}
.btn-gaming:hover {
    background: linear-gradient(90deg, #9b59b6, #6f42c1);
    box-shadow: 0 0 15px #9b59b6;
}
</style>

<div class="container py-5">
    <div class="success-container text-center">
        <h2 class="success-title">✅ ORDER CONFIRMED!</h2>
        <p class="text-light mb-4">Thank you for your purchase, <strong><?php echo htmlspecialchars($order['username']); ?></strong>.</p>

        <div class="text-start">
            <p><strong>Order ID:</strong> #<?php echo $order['id']; ?></p>
            <p><strong>Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?></p>
        </div>

        <table class="table table-dark table-hover align-middle order-table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Game Title</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                foreach ($items as $item): 
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo htmlspecialchars($item['game_title']); ?></td>
                    <td class="text-success fw-bold">₱<?php echo number_format($item['price'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="fw-bold">
                    <td colspan="2" class="text-end">TOTAL:</td>
                    <td class="text-success">₱<?php echo number_format($order['total'], 2); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="shop.php" class="btn-gaming me-2">🛒 Continue Shopping</a>
            <a href="orders.php" class="btn-gaming">📦 View My Orders</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
