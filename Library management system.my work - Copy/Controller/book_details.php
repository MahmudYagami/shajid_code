<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../Model/db_connect.php");

$isbn = $_GET['isbn'] ?? '';
$book = false;

if (!empty($isbn)) {
    $book = getBookDetailsByISBN($conn, $isbn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Details</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <style>
        .book-details-container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }

        .shelf-badge {
            background-color: #4c91ff;
            color: white;
            padding: 5px 12px;
            border-radius: 5px;
            font-weight: bold;
        }

        a.button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #4c91ff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }

        a.button:hover {
            background-color: #3a75d3;
        }
    </style>
</head>
<body>
    <div class="book-details-container">
        <h2>Book Details</h2>

        <?php if ($book): ?>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($book['title']); ?></p>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
            <p><strong>Shelf Location:</strong> <span class="shelf-badge"><?php echo htmlspecialchars($book['shelf']); ?></span></p>
            <p><strong>ISBN:</strong> <?php echo htmlspecialchars($isbn); ?></p>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <a class="button" href="../View/borrow_book.php?title=<?php echo urlencode($book['title']); ?>">Borrow this Book</a>
            <?php endif; ?>

        <?php else: ?>
            <p style="color:red;">No book found for ISBN: <?php echo htmlspecialchars($isbn); ?></p>
        <?php endif; ?>

        <p><a class="button" href="search_books.php">← Back to Search</a></p>
    </div>
</body>
</html>
