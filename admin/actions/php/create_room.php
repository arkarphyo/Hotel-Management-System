<?php
include_once '../../../config.php';

header('Content-Type: application/json');

// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Safely extract values
$roomno = isset($input['roomno']) ? $input['roomno'] : null;
$roomtype = isset($input['roomtype']) ? $input['roomtype'] : null;
$bedtype = isset($input['bedtype']) ? $input['bedtype'] : null;
$roomprice = isset($input['roomprice']) ? $input['roomprice'] : null;
$roomcapacity = isset($input['roomcapacity']) ? $input['roomcapacity'] : null;

// Insert room data into the database
$sql = "INSERT INTO room (room_number, type, bedding, price, capacity) VALUES ('$roomno', '$roomtype', '$bedtype', '$roomprice', '$roomcapacity')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Room created successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to create room: " . mysqli_error($conn)]);
}
?>