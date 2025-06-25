<?php
include '../../../config.php';
$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM roombook WHERE id=$id");
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>