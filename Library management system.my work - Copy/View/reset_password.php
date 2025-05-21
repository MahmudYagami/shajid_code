<?php
session_start();
if (!isset($_GET['token'])) {
    $_SESSION['reset_error'] = "Invalid or missing reset token.";
    header("Location: forgot_password.php");
    exit();
}
$token = $_GET['token'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Reset Your Password</h2>
        <?php if (isset($_SESSION['reset_error'])): ?>
            <p class="error"><?php echo $_SESSION['reset_error']; unset($_SESSION['reset_error']); ?></p>
        <?php endif; ?>
        <form action="../Controller/reset_password_process.php" method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
