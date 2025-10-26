<?php
session_start();
include 'db.php';
include 'header.php';

// ✅ Require login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please login to view your orders");
    exit;
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch all orders for this user
$stmt = $conn->prepare("SELECT id, total, order_date FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($order_id, $total, $order_date);

$orders = array();
while ($stmt->fetch()) {
    $orders[] = array(
        'id' => $order_id,
        'total' => $total,
        'order_date' => $order_date
    );
}
$stmt->close();
?>

<style>
body {
    background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center fixed;
    background-size: cover;
}
.orders-container {
    background: rgba(30,30,30,0.95);
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 0 20px rgba(111,66,193,0.6);
}
.section-title {
    font-size: 2rem;
    font-weight: 800;
    text-align: center;
    background: linear-gradient(90deg, #ff4e50, #00ff88, #6f42c1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.btn-view {
    background: linear-gradient(90deg, #6f42c1, #9b59b6);
    border: none;
    color: #fff;
    padding: 6px 15px;
    border-radius: 6px;
    font-weight: bold;
    text-decoration: none;
}
.btn-view:hover {
    background: linear-gradient(90deg, #9b59b6, #6f42c1);
    box-shadow: 0 0 10px #9b59b6;
}
</style>

<div class="container py-5">
    <h2 class="section-title">📦 MY ORDERS</h2>

    <div class="orders-container mt-4 table-responsive">
        <?php if (empty($orders)): ?>
            <p class="text-center text-light">You have no past orders.</p>
        <?php else: ?>
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                foreach ($orders as $order): 
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td>#<?php echo $order['id']; ?></td>
                    <td class="text-success fw-bold">₱<?php echo number_format($order['total'], 2); ?></td>
                    <td><?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?></td>
                    <td>
                        <a href="success.php?order_id=<?php echo $order['id']; ?>" class="btn-view">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
