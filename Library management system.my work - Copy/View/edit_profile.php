<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Profile</h2>
        <form action="../Controller/edit_profile_process.php" method="post">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $_SESSION['name']; ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
