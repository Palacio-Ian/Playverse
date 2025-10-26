<?php
include 'header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card auth-card shadow-lg text-center">
        <h2 class="mb-3">WELCOME<span class="text-primary"><?= htmlspecialchars($_SESSION['username']) ?></span>!</h2>
        <p class="lead">You are successfully logged in.</p>
		<a href="index.php" class="btn btn-light mt-3">HOME</a>
		<a href="shop.php" class="btn btn-light mt-3">SHOP</a>
        <a href="logout.php" class="btn btn-danger mt-3">LOG OUT</a>
    </div>
</div>

<?php include 'footer.php'; ?>
