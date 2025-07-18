<?php
include '../../../config.php';
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

$sql = "SELECT room.*,
        roomtype.name AS roomtype_name,
        bed1.name AS bed_name,
        bed2.name AS extra_bed_name,
        booking.stat AS booking_status
        FROM 
            room 
        LEFT JOIN roomtype ON room.type = roomtype.id 
        LEFT JOIN bedtype AS bed1 ON room.bedding = bed1.id
        LEFT JOIN bedtype AS bed2 ON room.extra_bed = bed2.id
        LEFT JOIN roombook AS booking ON room.booking_id = booking.id ORDER BY room.room_number ASC";
$result = mysqli_query($conn, $sql);

$rooms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}


header('Content-Type: application/json');
echo json_encode($rooms);
?>
