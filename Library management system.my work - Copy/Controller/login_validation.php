<?php
session_start();
require_once("../Model/db_connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $_SESSION["error"] = "Email and password are required.";
        header("Location: ../View/login.php");
        exit();
    }

    $user = authenticateUser($conn, $email);
    if ($user && $password === $user['password']) { // replace with password_verify if hashed
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["name"] = $user['name'];
        $_SESSION["email"] = $user['email'];
        $_SESSION["role"] = $user['role'];

        $redirect = ($user['role'] === 'admin') ? "dashboard_admin.php" : "dashboard_user.php";
        header("Location: ../View/$redirect");
        exit();
    }

    $_SESSION["error"] = "Invalid email or password.";
    header("Location: ../View/login.php");
    exit();
} else {
    header("Location: ../View/login.php");
    exit();
}
