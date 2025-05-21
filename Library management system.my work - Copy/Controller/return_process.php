<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $loan_id = mysqli_real_escape_string($conn, $_POST['loan_id']);
    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);
    $user_id = $_SESSION['user_id'];

    // Update the specific loan
    $sql = "UPDATE loans 
            SET status = 'Returned', actual_return = '$return_date' 
            WHERE id = '$loan_id' AND user_id = '$user_id' AND status = 'On Loan'";

    if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn) > 0) {
        $_SESSION['loan_message'] = "Book returned successfully.";
    } else {
        $_SESSION['loan_message'] = "Failed to return book or book already returned.";
    }

    header("Location: ../View/view_loans.php");
    exit();
} else {
    header("Location: ../View/view_loans.php");
    exit();
}
