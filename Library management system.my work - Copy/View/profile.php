<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Library System</title>
    <link rel="stylesheet" href="../Asset/css/profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>👤 My Profile</h2>

        <div class="profile-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        </div>

        <div class="profile-actions">
            <a href="edit_profile.php"> Edit Profile</a>
            <a href="change_password.php"> Change Password</a>
            <a href="dashboard_user.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
