<?php
    session_start();
    include '../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <!-- boot -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="../dist/font-awesome/css/all.min.css"/>
	<!-- css for table and search bar -->
	<link rel="stylesheet" href="css/roombook.css">
    

</head>
<body>
<div class="container mt-4 p-10">
    <?php 
        $confirmedBookingSQL = "SELECT * FROM payment_info GROUP BY booking_id;";
        $confirmedBookingExecute = mysqli_query($conn, $confirmedBookingSQL);
        while($confirmBookingRow = mysqli_fetch_assoc($confirmedBookingExecute)){
           
    ?>
    <table style="border: 3px solid #0e1b3d;" class="table table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="11" class="text-center" style="background-color: #0e1b3d; color: #ffffff;">
                    <h5>Payment Information For Booking ID (<?php echo $confirmBookingRow['booking_id']; ?>)</h5>
                </th>
            <tr>
            <tr class="text-center">
                <th scope="col">Payment ID</th>
                <th scope="col">Room Number</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Booking ID</th>
                <th scope="col">Service Fee</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Required Prepayment</th>
                <th scope="col">Payment Paid Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $paymentSql = "SELECT * FROM payment_info WHERE booking_id = {$confirmBookingRow['booking_id']}";
                            
            $paymentResult = mysqli_query($conn, $paymentSql);
            $netTotalAmount = 0;
            $outstandingPaymentAmount = 0;
            $prepayRequiredTotalAmount = 0;
            while ($row = mysqli_fetch_assoc($paymentResult)) {
                $netTotalAmount += $row['total_amount'];
                $prepayRequiredTotalAmount += $row['total_amount'] * 0.5;
                $outstandingPaymentAmount += $row['total_amount'] - $row['paid_amount'];
                echo "<tr class='text-center'>";
                        echo "<td>{$row['id']}</td>";
                    $roomSql = "SELECT * FROM room WHERE id = {$row['room_id']}";
                    $roomResult = mysqli_query($conn, $roomSql);
                    $roomRow = mysqli_fetch_assoc($roomResult);
                        echo "<td>{$roomRow['room_number']}</td>";
                    $bookingSql = "SELECT * FROM roombook WHERE id = {$row['booking_id']}";
                    $bookingResult = mysqli_query($conn, $bookingSql);
                    $bookingRow = mysqli_fetch_assoc($bookingResult);
                        echo "<td>{$bookingRow['Name']}</td>";
                        echo "<td>{$row['booking_id']}</td>";
                    $serviceSql = "SELECT COALESCE(SUM(price), 0) AS total_service_fee FROM service_fee WHERE id = {$row['service_fee_id']}";
                    $serviceResult = mysqli_query($conn, $serviceSql);
                    $serviceRow = mysqli_fetch_assoc($serviceResult);
                        echo "<td>{$serviceRow['total_service_fee']}</td>";
                    $extrabedSql = "SELECT COALESCE(SUM(price), 0) AS price FROM bedtype WHERE id = {$roomRow['extra_bed']}";
                    $extrabedResult = mysqli_query($conn, $extrabedSql);
                    $extrabedRow = mysqli_fetch_assoc($extrabedResult);
                        echo "<td>".number_format(($roomRow['price'] + $extrabedRow['price']) * $roomRow['duration'], 0)." MMK</td>";
                    $paymentType = "SELECT * FROM payment_type WHERE id = {$row['payment_type']}";
                    $paymentTypeResult = mysqli_query($conn, $paymentType);
                    $paymentTypeRow = mysqli_fetch_assoc($paymentTypeResult);
                        echo "<td>{$paymentTypeRow['name']}</td>";
                        echo "<td>".number_format($row['total_amount'] * 0.5, 0)." MMK</td>";
                        echo "<td>{$row['paid_amount']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr> 
                <td colspan="8" class="text-end"><strong>Total Amount:</strong></td>
                <td><?= number_format($netTotalAmount, 0) ?> MMK</td>
            </tr>
            <tr> 
                <td colspan="8" class="text-end"><strong>OuOutstanding Balance Amount:</strong></td>
                <td><?= number_format($netTotalAmount, 0) ?> MMK</td>
            </tr>
            <tr> 
                <td colspan="8" class="text-end"><strong>Required Prepayment:</strong></td>
                <td><?= number_format($prepayRequiredTotalAmount, 0) ?> MMK</td>
            </tr>
        </tfoot>
    </table>
    <?php
        }
    ?>
</div>

</body>

<script>

</script>

</html>