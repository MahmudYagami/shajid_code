<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$loan_id = $_GET['loan_id'] ?? null;

if (!$loan_id) {
    $_SESSION['loan_message'] = "Invalid loan request.";
    header("Location: view_loans.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$loans = getReturnedLoans($conn, $_SESSION['user_id']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Return Book</h2>
        <form method="post" action="../Controller/return_process.php">
            <input type="hidden" name="loan_id" value="<?php echo htmlspecialchars($loan_id); ?>">
           
            <label for="return_date">Return Date:</label>
            <input type="date" name="return_date" id="return_date" required>
            <button type="submit">Confirm Return</button>
        </form>
        <p><a href="view_loans.php">← Back to Loans</a></p>
    </div>
    <script>
        window.onload = function() {
            // Get today's date in YYYY-MM-DD format
            const today = new Date().toISOString().split('T')[0];
            
            // Set minimum date for return date
            const returnDate = document.getElementById('return_date');
            returnDate.min = today;
            returnDate.value = today;
        }
    </script>
</body>
</html>
