<?php
include_once '../../../config.php';

header('Content-Type: application/json');

// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);
?>
