<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Library System</title>
    <link rel="stylesheet" href="../Asset/css/login_form.css">
</head>
<body>
    <div class="overlay">
        <div class="login-box">
            <h2>Create Your Library Account</h2>

            <!-- Show registration error if exists -->
            <?php if (isset($_SESSION['register_error'])): ?>
                <p style="color: red;"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></p>
            <?php endif; ?>

            <form action="../Controller/register_validation.php" method="post" enctype="multipart/form-data">
                <label for="name">Full Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>

                <label for="id_proof">Upload ID Proof:</label>
                <input type="file" name="id_proof" id="id_proof" accept=".jpg,.jpeg,.png,.pdf" required>

                <button type="submit">Register</button>
            </form>

            <div class="link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>

    <!-- JavaScript validation file -->
    <script src="../Asset/js/register.js"></script>
    
</body>
</html>
