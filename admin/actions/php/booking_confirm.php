<?php
include("../../../config.php");

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

header('Content-Type: application/json');

if ($id === null) {
    echo json_encode(["status" => "error", "message" => "ID not provided."]);
    exit;
}

$roombook_sql = "UPDATE roombook SET stat = 1 WHERE id = ?";

$stmt = $conn->prepare($roombook_sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close();
        // Fetch the room id associated with the booking
        $fetch_room_id_sql = "SELECT RoomNos FROM roombook WHERE id = ?";
        $fetch_stmt = $conn->prepare($fetch_room_id_sql);
        if ($fetch_stmt) {
            $fetch_stmt->bind_param("i", $id);
            $fetch_stmt->execute();
            $fetch_stmt->bind_result($room_id);
            if ($fetch_stmt->fetch()) {
                $fetch_stmt->close();
                // Handle multiple room numbers (comma-separated)
                $room_numbers = array_map('trim', explode(',', $room_id));
                json_encode($room_numbers); // Debugging line to check room numbers
                $placeholders = implode(',', array_fill(0, count($room_numbers), '?'));
                // Convert room numbers to integers for binding
                $room_numbers_int = array_map('intval', $room_numbers);
                $room_sql = "UPDATE room SET status = 1 WHERE room_number IN ($placeholders)";
                $room_stmt = $conn->prepare($room_sql);
                if ($room_stmt) {
                    // Dynamically build the types string (all integers)
                    $types = str_repeat('i', count($room_numbers_int));
                    // Use argument unpacking for bind_param
                    $room_stmt->bind_param($types, ...$room_numbers_int);
                    $room_stmt->execute();
                    $room_stmt->close();
                    echo json_encode(["status" => "success", "message" => "Booking confirmed."]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to prepare room update statement."]);
                }
            } else {
                $fetch_stmt->close();
                echo json_encode(["status" => "error", "message" => "Room ID not found for this booking."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to fetch room ID."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update booking."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to prepare statement."]);
}
?>