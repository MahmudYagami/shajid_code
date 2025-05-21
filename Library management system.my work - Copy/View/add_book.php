<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Book - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Book</h2>
        <?php if (isset($_SESSION['book_message'])): ?>
            <p class="message"><?php echo $_SESSION['book_message']; unset($_SESSION['book_message']); ?></p>
        <?php endif; ?>
        <form action="../Controller/book_add_process.php" method="post">
            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" id="isbn" required>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
            <label for="author">Author:</label>
            <input type="text" name="author" id="author" required>
            <label for="genre">Genre:</label>
            <input type="text" name="genre" id="genre">
            <label for="shelf">Shelf Location:</label>
            <input type="text" name="shelf" id="shelf">
            <button type="submit">Add Book</button>
        </form>
        <p><a href="dashboard_admin.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
