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
    <?php include "./models/setprice-model.php"; ?>
    <?php include "./models/setroomtype-model.php"; ?>
    <?php include "./models/setroomnumber-model.php"; ?>
    <!-- ================================================= -->
    <div class="searchsection d-flex justify-content-between  px-3 py-2">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        
        <button class="adduser" id="adduser" onclick="openmodel(setroomtypemodel)"><i class="fa-solid fa-house-window"></i> Set Type </button>
        <button class="adduser" id="adduser" onclick="openmodel(setroomnumbermodel)"><i class="fa-solid fa-input-numeric"></i> Set Number </button>
        <button class="adduser" id="adduser" onclick="openmodel(setpricemodel)"><i class="fa-solid fa-money-check-dollar"></i> Set Price </button>
        <button class="adduser" id="adduser" onclick="openmodel(setbookingmodel)"><i class="fa-solid fa-tickets-perforated"></i> Set Booking </button>
        <form action="./exportdata.php" method="post">
            <button class="excel-btn" id="excel-btn" name="exportexcel" type="submit"><i class="fa-solid fa-file-excel white-icon">  </i>Export Excel</button>
        </form>
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $roombooktablesql = "SELECT * FROM roombook";
            $roombookresult = mysqli_query($conn, $roombooktablesql);
            $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered table-hover" id="table-data">
            <thead>
                <tr class="text-center align-middle">
                    <th scope="col" >NO</th>
                    <th scope="col">အမည်အမည်</th>
                    <th scope="col">နိုင်ငံသား</th>
                    <th scope="col">ဖုန်းနံပါတ်</th>
                    <th scope="col">အခန်းမျိုးအစား</th>
                    <th scope="col">အိပ်ယာအမျိုးအစား</th>
                    <th scope="col">အခန်းနံပါတ် </th>
                    <th scope="col">Check-In</th>
                    <th scope="col">Check-Out</th>
                    <th scope="col">နေထိုင်မည့် ရက်အရေအတွက် </th>
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
                    <td><?php echo $res['NoofRoom'] ?></td>
                    <td><?php echo $res['cin'] ?></td>
                    <td><?php echo $res['cout'] ?></td>
                    <td><?php echo $res['nodays'] ?></td>
                    <td><?php echo $res['stat'] ?></td>
                    
                    <td class="action">
                        <?php
                            if($res['stat'] == "Confirm")
                            {
                                echo " ";
                            }
                            else
                            {
                                echo "<a href='roomconfirm.php?id=". $res['id'] ."'><button class='btn btn-success'>Confirm</button></a>";
                            }
                        ?>
                        <a href="roombookedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                    </td>
                    <td class="action" >
                        
                        <a href="roombookdelete.php?id=<?php echo $res['id'] ?>"><button class='btn btn-danger'>Delete</button></a>
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



</html>
