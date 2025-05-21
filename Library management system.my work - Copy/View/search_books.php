<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Books - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Search for Books by ISBN</h2>
        <form method="get" action="../Controller/book_details.php">
            <label for="isbn">Enter ISBN Number:</label>
            <input type="text" name="isbn" id="isbn" required>
            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>
