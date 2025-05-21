<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

require_once("../Model/db_connect.php");

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');
$total_fine = 0;

$total_fine = calculateTotalFineByUserId($conn, $user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../Asset/css/dashboard.css">
    <style>
        .overlay {
            position: relative;
        }

        .bell {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 24px;
            color: #4c91ff;
            z-index: 10;
        }

        .bell a {
            text-decoration: none;
            color: inherit;
        }

        .bell:hover {
            color: #2e75f0;
        }

        .fine-box {
            margin-bottom: 20px;
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ffeeba;
            font-weight: bold;
            font-size: 16px;
        }

        .dashboard-card a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <!-- 🔔 Notification Bell -->
        <div class="bell">
            <a href="notifications.php" title="Due Date Notifications">🔔</a>
        </div>

        <div class="dashboard-container">
            <h1>Welcome to the Library</h1>
            <h2><?php echo htmlspecialchars($_SESSION['name']); ?></h2>

            <!-- 📌 Fine Summary -->
            <div class="dashboard-card">
    <a href="view_fines.php">💸 Total Fine: <?php echo $total_fine; ?> ৳</a>
</div>


            <div class="dashboard-card"><a href="book_catalog.php">Book catalog</a></div>
            <div class="dashboard-card"><a href="view_loans.php">My Loans</a></div>
            <div class="dashboard-card"><a href="reading_history.php">Reading History</a></div>
            <div class="dashboard-card"><a href="profile.php">Profile</a></div>
            <div class="dashboard-card"><a href="../Controller/logout.php">Logout</a></div>
        </div>
    </div>
</body>
</html>