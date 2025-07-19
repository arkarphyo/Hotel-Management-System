<?php
include '../../../config.php';
header('Content-Type: application/json');

// Database connection (adjust credentials as needed)


if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid booking ID']);
    exit;
}

$stmt = $conn->prepare("SELECT id, RoomNos, cin, cout FROM roombook WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($result_id, $result_rooms,$result_cin, $result_cout);

if ($stmt->fetch()) {
    echo json_encode(['status' => 'success', 'booking_id' => $result_id, 'cin' => $result_cin, 'cout' => $result_cout, 'rooms' => $result_rooms]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Booking not found']);
}

$stmt->close();
$conn->close();
?>
