
<?php
session_start();
require_once("../Model/db_connect.php");

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');

// Fetch current loans
$query = "SELECT book_title, return_date FROM loans WHERE user_id = ? AND status = 'On Loan'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$alerts = [
    'advance' => [],
    'overdue' => [],
    'final' => []
];

$unread_count = 0;

while ($row = $result->fetch_assoc()) {
    $title = $row['title'];
    $return_date = $row['return_date'];
    $diff = (strtotime($return_date) - strtotime($today)) / (60 * 60 * 24);

    if ($diff == 3) {
        $alerts['advance'][] = "📘 '{$title}' is due in 3 days.";
        $unread_count++;
    } elseif ($diff == 0) {
        $alerts['overdue'][] = "⚠️ '{$title}' is due today!";
        $unread_count++;
    } elseif ($diff < 0 && $diff >= -7) {
        $alerts['overdue'][] = "❗ '{$title}' is overdue!";
        $unread_count++;
    } elseif ($diff < -7) {
        $alerts['final'][] = "🚨 Final Warning: '{$title}' is over a week overdue!";
        $unread_count++;
    }
}

// Simulated user contact preference (replace with database query/update in real use)
$preferences = [
    'email' => true,
    'sms' => false
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .notification-page {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .notification-bar {
            margin-bottom: 30px;
        }

        .notification-section h3 {
            margin-top: 20px;
            color: #4c91ff;
        }

        .notification {
            background: #eef3ff;
            padding: 12px;
            margin: 10px 0;
            border-left: 5px solid #4c91ff;
        }

        .final { border-left-color: darkred; }
        .overdue { border-left-color: orange; }
        .advance { border-left-color: green; }

        .preferences {
            margin-top: 40px;
        }

        .preferences label {
            display: block;
            margin-bottom: 10px;
        }

        .bell-icon {
            position: relative;
            float: right;
            font-size: 24px;
            color: #4c91ff;
        }

        .bell-icon .count {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="notification-page">
        <h2>
            Notifications
            <span class="bell-icon">
                🔔
                <?php if ($unread_count > 0): ?>
                    <span class="count"><?php echo $unread_count; ?></span>
                <?php endif; ?>
            </span>
        </h2>

        <div class="notification-bar">
            <?php foreach ($alerts as $type => $messages): ?>
                <?php if (!empty($messages)): ?>
                    <div class="notification-section">
                        <h3><?php echo ucfirst($type); ?> Notices</h3>
                        <?php foreach ($messages as $msg): ?>
                            <div class="notification <?php echo $type; ?>"><?php echo $msg; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="preferences">
            <h3>Contact Preferences</h3>
            <form method="post" action="#">
                <label>
                    <input type="checkbox" name="pref_email" <?php echo $preferences['email'] ? 'checked' : ''; ?>> Receive notifications via Email
                </label>
                <label>
                    <input type="checkbox" name="pref_sms" <?php echo $preferences['sms'] ? 'checked' : ''; ?>> Receive notifications via SMS
                </label>
                <button type="submit">Save Preferences</button>
            </form>
        </div>

        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
