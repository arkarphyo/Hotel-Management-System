<?php
include("../../../config.php");

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;
$nodays = $input['nodays'] ?? null;
header('Content-Type: application/json');

if ($id === null) {
    echo json_encode(["status" => "error", "message" => "ID not provided."]);
    exit;
}

$roombook_sql = "UPDATE roombook SET stat = 2 WHERE id = ?";

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
                // Convert room numbers to integers for binding
                
                if (is_array(json_decode($room_id, true))) {
                    // If RoomNos is a JSON array, decode it
                    $room_numbers = json_decode($room_id, true);
                } else {
                    // Otherwise, treat as comma-separated string
                    $room_numbers = array_map('trim', explode(',', $room_id));
                }
                $room_numbers_int = array_map('intval', $room_numbers);
                $room_numbers_init = [];
                foreach ($room_numbers as $num) {
                    if (is_numeric($num)) {
                        $room_numbers_init[] = $num;
                    } else {
                        echo json_encode(["status" => "error", "message" => "Invalid room number: $num"]);
                        exit;
                    }
                }
                // Prepare placeholders for the IN clause
                $placeholders = implode(',', array_fill(0, count($room_numbers_init), '?'));
                $room_sql = "UPDATE room SET status = 1, duration = $nodays, booking_id = ? WHERE room_number IN ($placeholders)";
                $payment_sql = "INSERT INTO payment_info (booking_id, room_id, total_amount, payment_type, prepayment_required_amount, payment_paid_amount) VALUE (?, ?, ?, ?, ?, ?)";
                // Add booking_id to the beginning of the parameters array
                array_unshift($room_numbers_int, $id);
                $room_stmt = $conn->prepare($room_sql);
                if ($room_stmt) {
                    // Dynamically build the types string (all integers)
                    $types = str_repeat('i', count($room_numbers_int));
                    // Use argument unpacking for bind_param
                    $room_stmt->bind_param($types, ...$room_numbers_int);
                    $room_stmt->execute();
                    $room_stmt->close();
                                            // Step 4: Get room IDs for these room numbers
                        $placeholders = implode(',', array_fill(0, count($room_numbers_init), '?'));
                        $select_sql = "SELECT id, price, extra_bed FROM room WHERE room_number IN ($placeholders)";
                        $select_stmt = $conn->prepare($select_sql);
                        if ($select_stmt) {
                            $types = str_repeat('i', count($room_numbers_init));
                            $select_stmt->bind_param($types, ...$room_numbers_init);
                            $select_stmt->execute();
                            $result = $select_stmt->get_result();
                            $room_ids = [];
                            while ($row = $result->fetch_assoc()) {
                                $room_ids[] = $row['id'];
                            }
                            $select_stmt->close();
                        }
                                                 // Step 5: Insert into payment_info
                        
                        $booking_id = $id;
                        $total_amount = 0;
                        $prepayment_required = 0;

                        
                            foreach ($room_ids as $room_id) {
                                $room_sql = "SELECT price, extra_bed FROM room WHERE id = ?";
                                $room_stmt = $conn->prepare($room_sql);
                                if ($room_stmt) {
                                    $room_stmt->bind_param('i', $room_id);
                                    $room_stmt->execute();
                                    $room_result = $room_stmt->get_result();
                                    $room_row = $room_result->fetch_assoc();
                                    $price = $room_row['price'];
                                    $extra_bed = $room_row['extra_bed'];
                                    if($extra_bed > 0){
                                        $get_extra_bed_sql = "SELECT price FROM bedtype WHERE id = $extra_bed";
                                        $get_extra_bed_price = $conn->query($get_extra_bed_sql);
                                        $extra_bed_price = $get_extra_bed_price->fetch_assoc()['price'];
                                        $price += $price + $extra_bed_price;
                                    }
                                    $book_data_sql = "SELECT * FROM roombook WHERE id = $booking_id";
                                    $book_data = $conn->query($book_data_sql);
                                    $book_data_row = $book_data->fetch_assoc();
                                    $total_amount += $price * $book_data_row['nodays'];
                                    $prepayment_required = $total_amount * 0.5;
                                    $room_stmt->close();
                                }
                                
                                $payment_sql = "INSERT INTO payment_info (booking_id, room_id, total_amount, payment_type, prepayment_required_amount, paid_amount) VALUE ($booking_id, $room_id, $total_amount,  1, $prepayment_required, 0)";
                                $payment_stmt = $conn->prepare($payment_sql);
                                // $payment_stmt->bind_param('iiidii', $booking_id, $room_id, $total_amount, $payment_type = 1, $prepayment_required, $paid_amount = 0);
                                $payment_stmt->execute();
                            }
                            $payment_stmt->close();

                                        // Step 6: Success response
                        echo json_encode([
                            "status" => "success",
                            "message" => "Booking confirmed and payment info inserted.",
                            "booking_id" => $booking_id,
                            "room_numbers" => $room_numbers_init
                        ]);
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