<?php
function calculate_fine($due_date, $return_date) {
    $due = new DateTime($due_date);
    $return = new DateTime($return_date);
    $interval = $due->diff($return)->days;

    if ($return > $due) {
        $fine = $interval * 0.25;
        return min($fine, 10); // cap at $10
    }
    return 0;
}
?>
