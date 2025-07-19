<?php
include '../../../config.php';

header('Content-Type: application/json');
// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);
// Safely extract values
$booking_id = isset($input['bookingId']) ? intval($input['bookingId']) : null;
$name = isset($input['name']) ? $input['name'] : '';
$national = isset($input['national']) ? $input['national'] : '';
$phone = isset($input['phone']) ? intval($input['phone']) : null;
$room_type = isset($input['room_type']) ? $input['room_type'] : '';
$room_nos = isset($input['room_nos']) ? $input['room_nos'] : '';
$bed = isset($input['bed']) ? $input['bed'] : '';
$noof_room = isset($input['noof_room']) ? intval($input['noof_room']) : 0;
$meal = isset($input['meal']) ? $input['meal'] : '';
$checkin = isset($input['cin']) ? $input['cin'] : '';
$checkout = isset($input['cout']) ? $input['cout'] : '';
$stat = isset($input['stat']) ? intval($input['stat']) : 0;

if ($noof_room == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Number of rooms must be greater than 0']);
    exit;
}

$query = "UPDATE roombook SET 
name = ?, national = ?, phone = ?, RoomType = ?, RoomNos = ?, Bed = ?, NoOfRoom = ?, Breakfast = ?, cin = ?, cout = ?, stat = ? WHERE id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Database query preparation failed: ' . $conn->error]);
    exit;
}

// If the booking status is changed to cancelled, update the room status
if ($stat == 1 || $stat == 0 && $noof_room > 0) {
    // Decode the room numbers from JSON
    $roomNosArray = json_decode($room_nos, true);

    if (is_array($roomNosArray)) {
        foreach ($roomNosArray as $roomNo) {
            $updateRoomSql = "UPDATE room SET status = 0 WHERE room_number = ?";
            $roomStmt = $conn->prepare($updateRoomSql);
            if ($roomStmt) {
                $roomStmt->bind_param("s", $roomNo);
                $roomStmt->execute();
                if ($roomStmt->error) {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update room status: ' . $roomStmt->error]);
                    exit;
                }
                $roomStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database query preparation failed: ' . $conn->error]);
                exit;
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid room numbers format']);
        exit;
    }
}else if ($stat == 2 || $stat == 3 && $noof_room > 0) {
    // If the booking is cancelled, update the room status
    $roomNosArray = json_decode($room_nos, true);
    if (is_array($roomNosArray)) {
        foreach ($roomNosArray as $roomNo) {
            $updateRoomSql = "UPDATE room SET status = 1, booking_id = ? WHERE room_number = ?";
            $roomStmt = $conn->prepare($updateRoomSql);
            if ($roomStmt) {
                $roomStmt->bind_param("ss", $booking_id, $roomNo);
                $roomStmt->execute();
                if ($roomStmt->error) {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update room status: ' . $roomStmt->error]);
                    exit;
                }
                $roomStmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database query preparation failed: ' . $conn->error]);
                exit;
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid room numbers format']);
        exit;
    }
}

$stmt->bind_param("sssssssissii",$name, $national, $phone, $room_type, $room_nos, $bed, $noof_room, $meal, $checkin, $checkout, $stat, $booking_id);
// Execute the query
if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => 'Database query execution failed: ' . $stmt->error]);
    exit;
} else {
    echo json_encode(['status' => 'success', 'message' => 'Booking updated successfully']);
}


?>