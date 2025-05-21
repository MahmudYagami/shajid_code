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
    <title>Admin Dashboard - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="admin_manage_books.php">Manage Books</a> |
            <a href="admin_manage_users.php">Manage Users</a> |
            <a href="admin_reports.php">Reports</a> |
            <a href="notification_center.php">Notifications</a> |
            <a href="../Controller/logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        <p>Use the navigation menu to manage library operations.</p>
    </main>
</body>
</html>
