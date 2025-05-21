<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
$notifications = [
    ['message' => 'Book "Intro to PHP" is due in 3 days.', 'date' => '2025-05-10', 'read' => false],
    ['message' => 'Book "JavaScript Basics" has been returned successfully.', 'date' => '2025-05-01', 'read' => true],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="notification-container">
        <h2>Your Notifications</h2>
        <?php if (empty($notifications)): ?>
            <p>No notifications at the moment.</p>
        <?php else: ?>
            <ul class="notification-list">
                <?php foreach ($notifications as $note): ?>
                    <li class="<?php echo $note['read'] ? 'read' : 'unread'; ?>">
                        <p><?php echo htmlspecialchars($note['message']); ?></p>
                        <span><?php echo $note['date']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <p><a href="<?php echo $_SESSION['role'] === 'admin' ? 'dashboard_admin.php' : 'dashboard_user.php'; ?>">← Back to Dashboard</a></p>
    </div>
</body>
</html>
