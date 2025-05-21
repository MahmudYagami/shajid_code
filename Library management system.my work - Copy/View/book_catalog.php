<?php
session_start();
require_once("../Model/db_connect.php");

$keyword = $_GET['keyword'] ?? '';
$category = $_GET['category'] ?? '';

$result = searchBooks($conn, $keyword, $category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Catalog</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <style>
        .catalog-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"], select {
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }

        .book-item {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-left: 5px solid #4c91ff;
        }

        .book-item form {
            margin-top: 10px;
        }

        .book-item button {
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .book-item button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="catalog-container">
        <h2>📚 Book Catalog</h2>

        <form method="get" action="">
            <input type="text" name="keyword" placeholder="Search by title or author" value="<?php echo htmlspecialchars($keyword); ?>">
            <select name="category">
                <option value="">All Categories</option>
                <option value="Fiction" <?php if ($category == "Fiction") echo 'selected'; ?>>Fiction</option>
                <option value="Science" <?php if ($category == "Science") echo 'selected'; ?>>Science</option>
                <option value="History" <?php if ($category == "History") echo 'selected'; ?>>History</option>
                <option value="Biography" <?php if ($category == "Biography") echo 'selected'; ?>>Biography</option>
            </select>
            <button type="submit">Search</button>
        </form>

        <?php while ($book = $result->fetch_assoc()): ?>
            <div class="book-item">
                <strong><?php echo htmlspecialchars($book['title']); ?></strong><br>
                Author: <?php echo htmlspecialchars($book['author']); ?><br>
                Genre: <?php echo htmlspecialchars($book['genre']); ?><br>
                Shelf: <?php echo htmlspecialchars($book['shelf']); ?><br>

                <form method="post" action="borrow_book.php">
    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
    <button type="submit">Borrow</button>
</form>

            </div>
        <?php endwhile; ?>

        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
