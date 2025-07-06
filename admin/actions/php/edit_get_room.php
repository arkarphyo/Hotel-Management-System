<?php
include '../../../config.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM room";
$result = mysqli_query($conn, $sql);

$rooms = [];

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['status'] == 1) {
        $booksql = "SELECT * FROM roombook WHERE JSON_CONTAINS(RoomNos, '\"".$row['room_number']."\"')";
        $booked_result = mysqli_query($conn, $booksql);

        $booked = mysqli_num_rows($booked_result) > 0;
        
    } else {
        $booked = false;
    }
     $rooms[] = [
            'booking_id' => $row['booking_id'],
            'room_number' => $row['room_number'],
            'type' => $row['type'],
            'booked' => $booked
        ];
   
}

echo json_encode($rooms);
