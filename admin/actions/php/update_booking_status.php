<?php
    include_once '../../../config.php';

    
header('Content-Type: application/json');

// Get raw JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Safely extract values
$booking_id = isset($input['id']) ? intval($input['id']) : null;
$status = isset($input['status']) ? intval($input['status']) : null;
//$sql = "UPDATE roombook SET stat = $status WHERE booking_id = $booking_id";
$sql = "UPDATE roombook SET stat = '$status' WHERE id = '$booking_id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $response = [
        'status' => 'success',
        'booking_id' => $booking_id,
        'status_code' => $status,
        'message' => 'Booking status updated successfully.'
    ];
} else {
    $response = [
        'status' => 'error',
        'booking_id' => $booking_id,
        'status_code' => $status,
        'message' => 'Failed to update booking status: ' . mysqli_error($conn)
    ];
}
echo json_encode($response);
mysqli_close($conn);

?>