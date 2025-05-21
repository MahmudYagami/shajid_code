<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Normally you would save this to DB or send email
    $_SESSION["contact_status"] = "Thank you, we received your message.";
    header("Location: ../View/contact_us.php");
    exit();
}
?>
