<?php
include_once __DIR__ . '/db_config.php';

$result = [];

    $details = "SELECT `fullname`, `email`, `phone`, `program`, `category` 
                FROM `apply_now` ORDER BY id DESC LIMIT 1";
    if ($det = $conn->query($details)) {
        $result = $det->fetch_assoc() ?? [];
        $det->free();
    }

?>
