<?php
function log_action($user_id, $action) {
    $logfile = "../logs/audit_log.txt";
    $time = date("Y-m-d H:i:s");
    $entry = "$time - User ID: $user_id - Action: $action" . PHP_EOL;
    file_put_contents($logfile, $entry, FILE_APPEND);
}
?>
