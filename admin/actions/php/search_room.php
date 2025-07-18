<?php
include_once '../../../config.php';

header('Content-Type: application/json');

// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (empty($input['search'])) {
    echo json_encode([]);
    exit;
}

// Set up the SQL query
$sql = "SELECT room.*, 
        roomtype.name AS roomtype_name,
        bed1.name AS bed_name,
        bed2.name AS extra_bed_name,
        booking.stat AS booking_status
        FROM room
        LEFT JOIN roomtype ON room.type = roomtype.id
        LEFT JOIN bedtype AS bed1 ON room.bedding = bed1.id
        LEFT JOIN bedtype AS bed2 ON room.extra_bed = bed2.id
        LEFT JOIN roombook AS booking ON room.booking_id = booking.id
        WHERE room.room_number LIKE ? OR roomtype.name LIKE ? OR bed1.name LIKE ? OR bed2.name LIKE ? ORDER BY room.room_number ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $input['search'], $input['search'],  $input['search'],  $input['search']);
$stmt->execute();
$result = $stmt->get_result();

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
