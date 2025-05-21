<?php
session_start();
require_once("../Model/db_connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $_SESSION['pass_error'] = "Passwords do not match.";
        header("Location: ../View/change_password.php");
        exit();
    }

    $stored_password = getUserPasswordHash($conn, $id);

    if ($stored_password && $current === $stored_password) {
        if (updateUserPassword($conn, $id, $new)) {
            $_SESSION['pass_success'] = "Password updated.";
        } else {
            $_SESSION['pass_error'] = "Failed to update password.";
        }
    } else {
        $_SESSION['pass_error'] = "Incorrect current password.";
    }

    header("Location: ../View/change_password.php");
    exit();
}
?>
