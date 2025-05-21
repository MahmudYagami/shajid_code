<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $name = trim($_POST['name']);
    $id = $_SESSION['user_id'];

    if (updateUserName($conn, $id, $name)) {
        $_SESSION['name'] = $name;
        $_SESSION['profile_success'] = "Profile updated successfully.";
    } else {
        $_SESSION['profile_error'] = "Failed to update profile.";
    }

    header("Location: ../View/profile.php");
    exit();
}
?>
