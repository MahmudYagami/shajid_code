<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Forgot Password</h2>
        <?php if (isset($_SESSION['forgot_message'])): ?>
            <p class="message"><?php echo $_SESSION['forgot_message']; unset($_SESSION['forgot_message']); ?></p>
        <?php endif; ?>
        <form action="../Controller/forgot_password_process.php" method="post">
            <label for="email">Enter your registered email:</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Send Reset Link</button>
        </form>
        <p><a href="login.php">Back to Login</a></p>
    </div>
</body>
</html>
