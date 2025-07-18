<?php
include_once '../../../config.php';

header('Content-Type: application/json');

// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Safely extract values
$roomno = isset($input['roomno']) ? $input['roomno'] : null;
$roomtype = isset($input['roomtype']) ? $input['roomtype'] : null;
$bedtype = isset($input['bedtype']) ? $input['bedtype'] : null;
$extrabed = isset($input['extrabed']) ? $input['extrabed'] : null;
$roomprice = isset($input['roomprice']) ? $input['roomprice'] : null;
$roomcapacity = isset($input['roomcapacity']) ? $input['roomcapacity'] : null;

// Check if roomno already exists
$check_sql = "SELECT * FROM room WHERE room_number = '$roomno'";
$check_result = mysqli_query($conn, $check_sql);
if (mysqli_num_rows($check_result) > 0) {
    echo json_encode(["status" => "error", "message" => "Room number $roomno already exists."]);
    exit;
}

// Insert room data into the database
$sql = "INSERT INTO room (room_number, type, bedding, extra_bed, price, capacity) VALUES ('$roomno', '$roomtype', '$bedtype', '$extrabed', '$roomprice', '$roomcapacity')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Room created successfully.", "room_number" => $roomno]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to create room: " . mysqli_error($conn)]);
}
?>