<?php
include_once "../../../config.php";

$id = $_GET['id'];

$payment_info_sql = "SELECT * FROM payment_info WHERE booking_id = $id;";
$payment_info_stmt = $conn->prepare($payment_info_sql);
$payment_info_stmt->execute();
$payment_info_data = $payment_info_stmt->get_result()->fetch_all(MYSQLI_ASSOC);
echo json_encode($payment_info_data);
?>