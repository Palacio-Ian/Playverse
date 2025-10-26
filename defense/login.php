<?php
session_start(); // ✅ must be at the top, before anything else
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Select ID, username, and password so we can store user_id in session
    $sql = "SELECT id, username, password FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_id, $db_username, $db_password);
        $stmt->fetch();

        if ($password === $db_password) {
            // ✅ Store user info in session
            $_SESSION['user_id'] = $db_id;
            $_SESSION['username'] = $db_username;

            // ✅ If user came from checkout, redirect back there
            if (isset($_SESSION['redirect_after_login'])) {
                $redirect = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']);
                header("Location: $redirect");
                exit;
            }

            // Default redirect
            header("Location: welcome.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
    $stmt->close();
}
?>

<?php include 'header.php'; ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card auth-card shadow-lg">
        <h3 class="text-center mb-4">LOGIN</h3>

        <!-- ✅ Show any message passed from checkout -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-warning text-center">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Show login errors -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-gaming w-100">LOG IN</button>
        </form>
        <p class="text-center mt-3">Don’t have an account? <a href="register.php">Register</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
