<?php
include '../../../config.php';
$input = json_decode(file_get_contents('php://input'), true);

$id = isset($input['id']) ? intval($input['id']) : null;
$query = mysqli_query($conn, "SELECT * FROM roombook WHERE id=$id");
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>