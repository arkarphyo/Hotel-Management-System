<?php
include_once '../../../config.php';

header('Content-Type: application/json');

// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Safely extract values
$id = isset($input['id']) ? $input['id'] : null;
$roomno = isset($input['roomno']) ? $input['roomno'] : null;
$roomtype = isset($input['roomtype']) ? $input['roomtype'] : null;
$bedtype = isset($input['bedtype']) ? $input['bedtype'] : null;
$extrabed = isset($input['extrabed']) ? $input['extrabed'] : null;
$roomprice = isset($input['roomprice']) ? $input['roomprice'] : null;
$roomcapacity = isset($input['roomcapacity']) ? $input['roomcapacity'] : null;

// Check if roomno already exists
$check_sql = "SELECT * FROM room WHERE room_number = '$roomno' AND id != '$id'";
$check_result = mysqli_query($conn, $check_sql);
if (mysqli_num_rows($check_result) > 0) {
    echo json_encode(["status" => "error", "message" => "Room number $roomno already exists."]);
    exit;
}

// Update room data in the database
$sql = "UPDATE room SET room_number = '$roomno', type = '$roomtype', bedding = '$bedtype', extra_bed = '$extrabed', price = '$roomprice', capacity = '$roomcapacity' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Room updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to update room: " . mysqli_error($conn)]);
}
?>