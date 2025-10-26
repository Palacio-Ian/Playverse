<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = md5($_POST['password']);

    // Basic email validation (PHP 7 compatible)
    if (strpos($email, '@') === false || strpos($email, '.com') === false) {
        $error = "Invalid email address. Must contain '@' and end with '.com'.";
    } else {
        // Check if username or email already exists
        $checkSql = "SELECT id FROM users WHERE username=? OR email=?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "Username or email already exists. Please choose another.";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $error = "Something went wrong. Please try again.";
            }
            $stmt->close();
        }
        $checkStmt->close();
    }
}
include 'header.php';
?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card auth-card shadow-lg">
        <h3 class="text-center mb-4">CREATE ACCOUNT</h3>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-gaming w-100">SIGN UP</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="login.php">Log In</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
