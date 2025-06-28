<?php
include("../../../config.php");
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");



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


if (!empty($missing)) {
    echo json_encode([
        "status" => "error",
        "message" => "Please fill the following details: " . implode(', ', $missing)
    ]);
    exit;
} else {
    $sta = "NotConfirm";
    // Calculate number of days between check-in and check-out
    try {
        if (empty($cin) || empty($cout)) {
            throw new Exception("Check-in or check-out date is missing.");
        }else{
        // Convert input dates to dd-MM-yyyy format for display/validation
        $cin_formatted = date('d-m-Y', strtotime($cin));
        $cout_formatted = date('d-m-Y', strtotime($cout));
        
        // Validate date format (input should be in Y-m-d, output for display is d-m-Y)
        $date1 = DateTime::createFromFormat('d-m-Y', $cin_formatted);
        $date2 = DateTime::createFromFormat('d-m-Y', $cout_formatted);

        if (!$date1 || !$date2) {
            throw new Exception("Invalid date format. Please use DD-MM-YYYY.");
        }

        // Calculate number of days between check-in and check-out
        $interval = $date1->diff($date2);
        $nodays = $interval->days;
            // Check if check-in date is before check-out date
            if ($cin > $cout) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Check-in date cannot be later than check-out date."
                ]);
                exit;
            }
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid date format: " . $e->getMessage()
        ]);
        exit;
    }

    $sql = "INSERT INTO roombook(Name,Phone,National,RoomNos,RoomType,Bed,NoofRoom,Breakfast,cin,cout,nodays,stat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Define $Breakfast and $stat variables
        $Breakfast = $Meal;
        $stat = $sta;
        // All fields are strings except $nodays (integer)
        // $stat is a string, $nodays is integer
        $stmt->bind_param(
            "ssssssssssis",
            $Name,
            $Phone,
            $National,
            $RoomNos,
            $RoomType,
            $Bed,
            $NoofRoom,
            $Breakfast,
            $cin,
            $cout,
            $nodays,
            $stat
        );
        try {
            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Reservation successful"
                ]);
                $stmt->close();
                exit;
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Something went wrong"
                ]);
                $stmt->close();
                exit;
            }
        } catch (Throwable $th) {
            echo json_encode([
                "status" => "error",
                "message" => "Error executing statement: " . $th->getMessage()
            ]);
            $stmt->close();
            exit;
        }
    }
}
?>