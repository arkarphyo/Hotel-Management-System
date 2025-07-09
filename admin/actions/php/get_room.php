<?php
include '../../../config.php';
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

$sql = "SELECT room.*,
        roomtype.name AS roomtype_name,
        bedtype.name AS extrabed_name
        FROM 
            room 
        LEFT JOIN roomtype ON room.type = roomtype.id 
        LEFT JOIN bedtype ON room.extra_bed = bedtype.id ORDER BY room.room_number ASC";
$result = mysqli_query($conn, $sql);

$rooms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}


header('Content-Type: application/json');
echo json_encode($rooms);
?>
