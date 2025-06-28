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
    <!-- boot -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js" ></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/all.css" />
    <!-- sweet alert -->
    <script src="../dist/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/roombook.css">
    <title>Mount Royal - Room Book</title>
</head>

<body>

    <?php include "./models/setbooking-model.php"; ?>
    <?php include "./models/editbooking-model.php"; ?>
    <!-- ================================================= -->
    <div class="searchsection d-flex justify-content-between align-items-center px-3 py-1" style="height:40px; min-height: 40px; margin:0;">
        <!-- SEARCH BAR -->
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()" style="height:30px;">
        <!-- SET BOOKING BUTTON -->
        <button class="adduser" id="adduser" onclick="openmodel(setbookingmodel)" style="height:32px;"><i class="fa-solid fa-tickets-perforated"></i> Set Booking </button>
        <!-- EXPORT EXCEL BUTTON -->
        <form action="./exportdata.php" method="post" class="mb-0">
            <button class="excel-btn" id="excel-btn" name="exportexcel" type="submit" style="height:32px;"><i class="fa-solid fa-file-excel white-icon"></i> Export Excel</button>
        </form>
    </div>
    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $roombooktablesql = "SELECT * FROM roombook ORDER BY id DESC";
            $roombookresult = mysqli_query($conn, $roombooktablesql);
            $nums = mysqli_num_rows($roombookresult);
        ?>
        
        <table class="table table-bordered table-hover" id="table-data">
            <thead>
            <tr class="text-center align-middle">
                <th scope="col" >NO</th>
                <th scope="col">အမည်</th>
                <th scope="col">နိုင်ငံသား</th>
                <th scope="col">ဖုန်းနံပါတ်များ</th>
                <th scope="col">အခန်းမျိုးအစား</th>
                <th scope="col">အိပ်ယာအမျိုးအစား</th>
                <th scope="col">အခန်းနံပါတ် </th>
                <th scope="col">Check-In</th>
                <th scope="col">Check-Out</th>
                <th scope="col">Duration</th>
                <th scope="col">Status</th>
                <th scope="col" colspan ="2" class="action">Action</th>
                <!-- <th>Delete</th> -->
            </tr>
            </thead>

            <tbody>
            <?php
            while ($res = mysqli_fetch_array($roombookresult)) {
            ?>
            <tr class="text-center align-middle">
                <td><?php echo $res['id'] ?></td>
                <td><?php echo $res['Name'] ?></td>
                <td><?php echo $res['National'] ?></td>
                <td><?php echo $res['Phone'] ?></td>
                <td><?php echo $res['RoomType'] ?></td>
                <td><?php echo $res['Bed'] ?></td>
                <td>
                    <?php
                        $roomNos = $res['RoomNos'];
                        // Check if it's a JSON array
                        $roomNosArr = json_decode($roomNos, true);
                        if (is_array($roomNosArr)) {
                            foreach ($roomNosArr as $roomNo) {
                                echo "<span style='background: linear-gradient(90deg, #232526, #0f2027); color: #fff; border-radius: 8px; padding: 2px 8px; margin: 2px; display: inline-block; font-size: 0.95em;'>" . htmlspecialchars($roomNo) . "</span> ";
                            }
                        } else {
                            echo "<span>".htmlspecialchars($roomNos)."</span>";
                        }
                    ?>
                </td>
                <td><?php echo $res['cin'] ?></td>
                <td><?php echo $res['cout'] ?></td>
                <td><?php echo $res['nodays'] ?></td>
                <td><?php 
                    if($res['stat'] == "1")
                    {
                        // Fetch count from checkn_info for this booking
                        $id = $res['id'];
                        $badgeCount = 0;
                        $badgeSql = "SELECT COUNT(*) as cnt FROM checkn_info WHERE booking_id = $id";
                        $badgeResult = mysqli_query($conn, $badgeSql);
                        if ($badgeResult && $row = mysqli_fetch_assoc($badgeResult)) {
                            $badgeCount = (int)$row['cnt'];
                        }
                        $badgeHtml = "<span class='badge bg-warning text-dark position-absolute top-0 start-100 translate-middle rounded-pill' style='font-size:0.75em;'>!</span>";
                        if ($badgeCount > 0) {
                            $badgeHtml = "<span class='badge bg-warning text-dark position-absolute top-0 start-100 translate-middle rounded-pill' style='font-size:0.75em;'>$badgeCount</span>";
                        }
                        echo "<button class='btn btn-success position-relative' onclick='setupInfoBtn(".$res['id'].")'>Setup Info $badgeHtml</button>";
                    }else if($res['stat'] == "2")
                    {
                          echo "<span style='color: red; text-shadow: 1px 1px 2px #dc3545;'>Cancelled</span>";
                    }   
                    else
                    {
                       echo "<button class='btn btn-success' onclick=confirmBookingBtn(".$res['id'].")>Confirm</button>";
                    }
                ?></td>
                
                <td class="action">
                    <button class="btn btn-primary" onclick="editOpenmodelArg(editbookingmodel,<?php echo $res['id']; ?>) ">Edit</button>
                </td>
                <td class="action">
                    <?php
                        if ($res['stat'] == "2") {
                            echo "<button class='btn btn-danger' disabled>Cancel</button>";
                        } else {
                            echo "<button class='btn btn-danger' onclick=cancelBookingBtn(".$res['id'].")>Cancel</button>";
                        }
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        
        
    </div>
</body>
<script src="./javascript/roombook.js"></script>
<script src="actions/js/actions.js"></script>



</html>
