<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = $_POST["isbn"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $shelf = $_POST["shelf"];

    $stmt = $conn->prepare("INSERT INTO books (isbn, title, author, genre, shelf) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $isbn, $title, $author, $genre, $shelf);

    if ($stmt->execute()) {
        $_SESSION["book_message"] = "Book added successfully.";
    } else {
        $_SESSION["book_message"] = "Error adding book.";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../View/add_book.php");
    exit();
}
?>
