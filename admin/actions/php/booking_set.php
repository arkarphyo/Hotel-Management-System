<?php
include("../../../config.php");
header('Content-Type: application/json');

// Handle JSON input for fetch POST
$input = json_decode(file_get_contents('php://input'), true);

// If using fetch with POST, use $input; if using form POST, use $_POST
$Name = $input['Name'] ?? $_POST['Name'] ?? '';
$National = $input['National'] ?? $_POST['National'] ?? '';        
$Phone = $input['Phone'] ?? $_POST['Phone'] ?? '';
$RoomNos = $input['RoomNos'] ?? $_POST['RoomNos'] ?? '';
$RoomType = $input['RoomType'] ?? $_POST['RoomType'] ?? '';
$Bed = $input['Bed'] ?? $_POST['Bed'] ?? '';
$NoofRoom = $input['NoofRoom'] ?? $_POST['NoofRoom'] ?? '';
$Meal = $input['Meal'] ?? $_POST['Meal'] ?? '';
$cin = $input['cin'] ?? $_POST['cin'] ?? '';
$cout = $input['cout'] ?? $_POST['cout'] ?? '';
$data = [
    'Name' => $Name,
    'Phone' => $Phone,
    'National' => $National,
    'RoomNos' => $RoomNos,
    'RoomType' => $RoomType,
    'Bed' => $Bed,
    'NoofRoom' => $NoofRoom,
    'Meal' => $Meal,
    'cin' => $cin,
    'cout' => $cout
];

// Check for missing required fields
$required = ['Name', 'Phone', 'National', 'RoomNos', 'RoomType', 'Bed', 'NoofRoom', 'Meal', 'cin', 'cout'];
$missing = [];
foreach ($required as $field) {
    if (empty($data[$field])) {
        $missing[] = $field;
    }
}

// Room availability logic (as before)
$rsql = "SELECT * FROM room WHERE status = 0";
$available_room = mysqli_query($conn, $rsql);
$rooms = [];
while ($row = mysqli_fetch_assoc($available_room)) {
    $rooms[] = [
        'room_number' => $row['room_number'],
        'id' => $row['id'],
        'type' => $row['type'],
        'bedding' => $row['bedding'],
        'status' => $row['status']
    ];
}


if (!empty($missing)) {
    echo json_encode([
        "status" => "error",
        "message" => "Please fill the following details: " . implode(', ', $missing)
    ]);
    exit;
} else {
    $sta = "NotConfirm";
    // Calculate number of days between check-in and check-out
    // Calculate number of days between check-in and check-out
    try {
        if (empty($cin) || empty($cout)) {
            throw new Exception("Check-in or check-out date is missing.");
        }else{
            $cin = date('Y-m-d', strtotime($cin));
            $cout = date('Y-m-d', strtotime($cout));
            // Validate date format
            if (!DateTime::createFromFormat('Y-m-d', $cin) || !DateTime::createFromFormat('Y-m-d', $cout)) {
                throw new Exception("Invalid date format. Please use YYYY-MM-DD.");
            }
            // Check if check-in date is before check-out date
            if ($cin > $cout) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Check-in date cannot be later than check-out date."
                ]);
                exit;
            }
            
            
                echo json_encode([
                    "status" => "error",
                    "message" => "Check-out date must be after check-in date. $cin - $cout"
                ]);
                exit;
            
            // Uncomment the following lines if you want to validate the date range
            // $cin = date('Y-m-d', strtotime($data['cin']));
            // $date1 = new DateTime($data['cin']);
            // $date2 = new DateTime($data['cout']);
            // if ($date1 > $date2) {
            //     echo json_encode([
            //         "status" => "error",
            //         "message" => "Check-in date cannot be later than check-out date."
            //     ]);
            //     exit;
            // }
            // $interval = $date1->diff($date2);
            // $nodays = $interval->days;
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid date format: " . $e->getMessage()
        ]);
        exit;
    }

    $sql = "INSERT INTO roombook(Name,Phone,National,RoomNos,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            "ssssssssssssi",
            $Name, $Phone, $National, $RoomNos, $RoomType, $Bed, $NoofRoom, $Meal, $cin, $cout, $sta, $nodays
        );
        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Reservation successful"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Something went wrong"
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to prepare statement"
        ]);
    }
    exit;
}
// If this is a fetch request for room availability
?>