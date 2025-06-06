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
        
        $room_sql = "UPDATE room SET status = 1 WHERE id = ?";
        $room_stmt = $conn->prepare($room_sql);
        if ($room_stmt) {
            $room_stmt->bind_param("i", $id);
            $room_stmt->execute();
            $room_stmt->close();
            echo json_encode(["status" => "success", "message" => "Booking confirmed."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare room update statement."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update booking."]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Failed to prepare statement."]);
}
?>