<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <h2>User Management</h2>
    <p>Feature coming soon: View, Edit, Delete user accounts.</p>
    <p><a href="dashboard_admin.php">← Back to Dashboard</a></p>
</body>
</html>
