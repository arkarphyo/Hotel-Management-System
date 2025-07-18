<?php
include("../../../config.php");
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Handle JSON input for fetch POST
$input = json_decode(file_get_contents('php://input'), true);

$id = $input['id'] ?? null;

header('Content-Type: application/json');
if ($id === null) {
    echo json_encode(["status" => "error", "message" => "ID not provided."]);
    exit;
}else{}
if ($id > 0) {
    $cancelsql = "UPDATE roombook SET stat = 0 WHERE id = $id";   
    $result = mysqli_query($conn, $cancelsql);
    if ($result) {
        $getRoomNosSql = "SELECT RoomNos FROM roombook WHERE id = $id";
        $roomNosResult = mysqli_query($conn, $getRoomNosSql);
        if ($roomNosResult && mysqli_num_rows($roomNosResult) > 0) {
            $row = mysqli_fetch_assoc($roomNosResult);
            $roomNosJson = $row['RoomNos'];
            $roomNosArray = json_decode($roomNosJson, true);
            if (is_array($roomNosArray)) {
                foreach ($roomNosArray as $roomNo) {
                    $updateRoomSql = "UPDATE room SET status = 0 WHERE room_number = '$roomNo'";
                    mysqli_query($conn, $updateRoomSql);
                }
            }
        }

        echo json_encode(["status" => "success", "message" => "Booking deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete booking."]);
    }
}

exit;

?>