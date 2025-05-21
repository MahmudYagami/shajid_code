<?php session_start(); ?>
<?php if (isset($_SESSION['register_success'])): ?>
    <p style="color: green;"><?php echo $_SESSION['register_success']; unset($_SESSION['register_success']); ?></p>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Library System</title>
    <link rel="stylesheet" href="../Asset/css/login_form.css">
</head>
<body>
    <div class="overlay">
        <div class="login-box">
            <h2>Login to Your Account</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            <?php endif; ?>

            <form action="../Controller/login_validation.php" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Login</button>
            </form>

            <div class="link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
