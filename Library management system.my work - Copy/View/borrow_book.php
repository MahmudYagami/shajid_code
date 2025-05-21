<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$book_id = $_POST['book_id'] ?? null;

if (!$book_id) {
    $_SESSION['loan_message'] = "No book selected.";
    header("Location: book_catalog.php");
    exit();
}

// Get book details from database
$sql = "SELECT title FROM books WHERE id = '$book_id'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
} else {
    $title = "Unknown Book";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Book - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Borrow Book</h2>
        <form action="../Controller/borrow_process.php" method="post">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
            <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">

            <p>You are borrowing: <strong><?php echo htmlspecialchars($title); ?></strong></p>

            <label for="borrow_date">Borrow Date:</label>
            <input type="date" name="borrow_date" id="borrow_date" required>

            <label for="return_date">Expected Return Date:</label>
            <input type="date" name="return_date" id="return_date" required>

            <button type="submit">Confirm Borrow</button>
        </form>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
    <script>
        window.onload = function() {
            // Get today's date in YYYY-MM-DD format
            const today = new Date().toISOString().split('T')[0];
            
            // Set minimum date for borrow date
            const borrowDate = document.getElementById('borrow_date');
            borrowDate.min = today;
            borrowDate.value = today;
            
            // Set minimum date for return date
            const returnDate = document.getElementById('return_date');
            returnDate.min = today;
            
            // Update return date minimum when borrow date changes
            borrowDate.addEventListener('change', function() {
                returnDate.min = this.value;
                if(returnDate.value < this.value) {
                    returnDate.value = this.value;
                }
            });
        }
    </script>
</body>
</html>
