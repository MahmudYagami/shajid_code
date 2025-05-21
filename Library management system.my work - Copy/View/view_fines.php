<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');
$total_fine = 0;
$fine_details = [];

$fine_data = calculateUserFines($conn, $user_id);
$total_fine = $fine_data['total'];
$fine_details = $fine_data['details'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Fines - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <style>
        .fine-container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4c91ff;
            color: white;
        }

        .pay-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .pay-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="fine-container">
        <h2>💸 Your Total Fine</h2>
        <?php if (empty($fine_details)): ?>
            <p>You have no outstanding fines.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Book Title</th>
                    <th>Days Overdue</th>
                    <th>Fine (৳)</th>
                </tr>
                <?php foreach ($fine_details as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo $row['days']; ?></td>
                        <td><?php echo $row['fine']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Total Fine:</strong> <?php echo $total_fine; ?> ৳</p>
            <form method="post" action="#">
                <button class="pay-btn" type="submit">Pay Now</button>
            </form>
        <?php endif; ?>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
