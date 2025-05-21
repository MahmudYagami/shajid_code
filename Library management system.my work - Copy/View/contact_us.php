<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Contact Us</h2>
        <?php if (isset($_SESSION['contact_status'])): ?>
            <p class="message"><?php echo $_SESSION['contact_status']; unset($_SESSION['contact_status']); ?></p>
        <?php endif; ?>
        <form action="../Controller/contact_process.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Your Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
