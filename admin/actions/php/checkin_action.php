<?php
include '../../../config.php';

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

$required_fields = ['booking_id'];

$missing = [];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        $missing[] = $field;
    }
}

if (!empty($missing)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields: ' . implode(', ', $missing)]);
    exit;
}

$booking_id = $data['booking_id'];

$stmt = $conn->prepare("UPDATE roombook SET stat = 3 WHERE id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();

if ($stmt->error) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update booking status: ' . $stmt->error]);
    exit;
}

echo json_encode(['status' => 'success', 'message' => 'Check-in successful']);
