<?php
session_start();
require_once("../Model/db_connect.php");

$loan_id = $_POST['loan_id'] ?? null;

if ($loan_id) {
    $query = "UPDATE loans
              SET return_date = DATE_ADD(return_date, INTERVAL 7 DAY), renew_count = renew_count + 1
              WHERE id = ? AND status = 'On Loan'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $loan_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Loan successfully renewed.";
    } else {
        $_SESSION['error'] = "Failed to renew loan.";
    }
    header("Location: ../View/view_loans.php");
    exit();
}
?>
