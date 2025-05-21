<?php
session_start();
$card_number = $_SESSION['library_card_number'] ?? 'UNKNOWN';
unset($_SESSION['library_card_number']); // optional: clear after displaying
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Library</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-image: url('../Asset/images/4.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            max-width: 500px;
        }

        .welcome-box h1 {
            color: #2e3a59;
            margin-bottom: 20px;
        }

        .welcome-box p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .library-card {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            background-color: #4c91ff;
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 30px;
        }

        .login-button {
            padding: 12px 24px;
            background-color: #2e75f0;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .login-button:hover {
            background-color: #1d5ed8;
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Welcome to the Library!</h1>
        <p>Your account has been successfully created.</p>
        <p>Your Library Card Number is:</p>
        <div class="library-card"><?php echo htmlspecialchars($card_number); ?></div>
        <br>
        <a href="login.php" class="login-button">Login Now</a>
    </div>
</body>
</html>
