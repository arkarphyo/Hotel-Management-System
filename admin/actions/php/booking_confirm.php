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

$sql = "UPDATE roombook SET stat = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Booking confirmed."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update booking."]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Failed to prepare statement."]);
}
?>