<?php
header('Content-Type: application/json');
include '../../../config.php';

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

$required_fields = ['booking_id','name','fat_name', 'age', 'gender', 'nrc_no', 'work', 'indate', 'outdate', 'address', 'remark'];
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

// Prepare and execute insert (adjust table/column names as needed)
$stmt = $conn->prepare("INSERT INTO checkn_info (booking_id, name, fat_name, age, gender, nrc_no, work, in_date, out_date, address, remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "sissssss",
    data['bookingId'],
    data['name'],
    data['fat_name'],
    data['age'],
    data['gender'],
    data['nrc_no'],
    data['work'],
    data['in_date'],
    data['out_date'],
    data['address'],
    data['remark'],
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Check-in info saved successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save check-in info']);
}

$stmt->close();
$conn->close();
?>
