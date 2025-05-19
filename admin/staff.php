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
    <!-- fontowesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css"/>
    <!-- boot -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/room.css">
    <style>
        .roombox{
            background-color: #d1d7ff;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <label for="troom">Name :</label>
            <input type="text" name="staffname" class="form-control">

            <label for="bed">Work :</label>
            <select name="staffwork" class="form-control">
                <option value selected></option>
                <option value="Manager">Manager</option>
                <option value="Cook">Cook</option>
                <option value="Helper">Helper</option>
                <option value="cleaner">cleaner</option>
                <option value="weighter">weighter</option>
            </select>

            <button type="submit" class="btn btn-success" name="addstaff">Add Room</button>
        </form>

        <?php
        if (isset($_POST['addstaff'])) {
            $staffname = $_POST['staffname'];
            $staffwork = $_POST['staffwork'];

            $sql = "INSERT INTO staff(name,work) VALUES ('$staffname', '$staffwork')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: staff.php");
            }
        }
        ?>
    </div>


    <!-- here room add because room.php and staff.php both css is similar -->
    <div class="room">
    <?php
        $sql = "select * from staff";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
                echo "<div class='roombox'>
						<div class='text-center no-boder'>
                            <i class='fa fa-users fa-5x'></i>
							<h3>" . $row['name'] . "</h3>
                            <div class='mb-1'>" . $row['work'] . "</div>
                            <a href='staffdelete.php?id=". $row['id'] ."'><button class='btn btn-danger'>Delete</button></a>
						</div>
                    </div>";
        }
        ?>
    </div>

</body>

</html>