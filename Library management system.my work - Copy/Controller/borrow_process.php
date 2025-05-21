<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    // Sanitize inputs
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $borrow_date = mysqli_real_escape_string($conn, $_POST['borrow_date']);
    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);
    $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

    // Insert into loans table
    $sql = "INSERT INTO loans (user_id, book_title, borrow_date, return_date, status)
            VALUES ('$user_id', '$title', '$borrow_date', '$return_date', 'On Loan')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['loan_message'] = "Book borrowed successfully.";
    } else {
        $_SESSION['loan_message'] = "Error borrowing book: " . mysqli_error($conn);
    }

    header("Location: ../View/view_loans.php");
    exit();
} else {
    header("Location: ../View/dashboard_user.php");
    exit();
}
?>
