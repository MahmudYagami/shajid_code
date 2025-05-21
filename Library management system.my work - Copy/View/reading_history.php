<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch only loans that are "Returned"
$loans = [];
$sql = "SELECT id, book_title, borrow_date, return_date, actual_return, status 
        FROM loans 
        WHERE user_id = '$user_id' AND status = 'Returned' 
        ORDER BY actual_return DESC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $loans[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Returned Books - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <style>
        .table-container {
            max-width: 900px;
            margin: 40px auto;
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

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #4c91ff;
            color: white;
            border-radius: 8px;
        }

        .btn-link:hover {
            background-color: #3a75d3;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>📦 Returned Books</h2>

        <?php if (count($loans) > 0): ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Borrowed On</th>
                    <th>Due Date</th>
                    <th>Returned On</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($loan['book_title']); ?></td>
                        <td><?php echo htmlspecialchars($loan['borrow_date']); ?></td>
                        <td><?php echo htmlspecialchars($loan['return_date']); ?></td>
                        <td><?php echo htmlspecialchars($loan['actual_return']); ?></td>
                        <td><?php echo htmlspecialchars($loan['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No returned books yet.</p>
        <?php endif; ?>

        <a href="dashboard_user.php" class="btn-link">← Back to Dashboard</a>
    </div>
</body>
</html>
