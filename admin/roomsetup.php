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
    <link rel="stylesheet" href="../assets/font-awesome/css/all.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/brands.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/duotone.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/sharp-solid.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/sharp-regular.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/sharp-light.css"/>
    <script src="../assets/font-awesome/js/pro.min.js"></script>
     <!-- <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css"
      >
      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone.css"
      />
      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/brands.css"
      /> -->
    <!-- boot -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/room.css">
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            
            <label for="nroom">Room No :</label>
            <select name="nroom" class="form-control">
                <option value selected></option>
                <option value="101">101</option>
                <option value="102">102</option>
                <option value="103">103</option>
                <option value="104">104</option>
                <option value="201">201</option>
                <option value="202">202</option>
                <option value="203">203</option>
                <option value="204">204</option>
                <option value="205">205</option>
                <option value="206">206</option>
                <option value="301">301</option>
                <option value="302">302</option>
                <option value="401">401</option>
                <option value="402">402</option>


                
            </select>

            <label for="troom">Type :</label>
            <select name="troom" class="form-control">
                <option value selected></option>
                <option value="Honeymoon Room">Honeymoon Room</option>
                <option value="Family Room">Family Room</option>
                <option value="Guest House">Guest House</option>
                <option value="Single Room">Normal Room</option>
            </select>

            <label for="bed">Bed :</label>
            <select name="bed" class="form-control">
                <option value selected></option>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Triple">Triple</option>
                <option value="Quad">Quad</option>
                <option value="Triple">None</option>
            </select>

            <button type="submit" class="btn btn-success" name="addroom">Add Room</button>
        </form>

        <?php
        if (isset($_POST['addroom'])) {
            $room_number = $_POST['nroom'];
            $typeofroom = $_POST['troom'];
            $typeofbed = $_POST['bed'];

            $sql = "INSERT INTO room(room_number,type,bedding) VALUES ('$room_number','$typeofroom', '$typeofbed')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: room.php");
            }
        }
        ?>
    </div>

    <div class="room">
        <?php
        $sql = "select * from room";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
            $id = $row['type'];
            if ($id == "Superior Room") {
                echo "<div class='roombox roomboxsuperior'>
						<div class='text-center no-boder'>
                            <i class='fa-sharp fa-bed  fa-4x mb-2'></i>
                            <p>" . $row['room_number'] ." </p>
							<h3>" . $row['type'] . "</h3>
                            <div class='mb-1'>" . $row['bedding'] . "</div>
                            <a href='roomdelete.php?id=". $row['id'] ."'><button class='btn btn-danger'>Delete</button></a>
						</div>
                    </div>";
            } else if ($id == "Deluxe Room") {
                echo "<div class='roombox roomboxdelux'>
                        <div class='text-center no-boder'>
                        <i class='fa fa-bed-front fa-4x mb-2'></i>
                        <p>" . $row['room_number'] ." </p>
                        <h3>" . $row['type'] . "</h3>
                        <div class='mb-1'>" . $row['bedding'] . "</div>
                        <a href='roomdelete.php?id=". $row['id'] ."'><button class='btn btn-danger'>Delete</button></a>
                    </div>
                    </div>";
            } else if ($id == "Guest House") {
                echo "<div class='roombox roomboguest'>
                <div class='text-center no-boder'>
                <i class='fa fa-bed-front fa-4x mb-2'></i>
                            <p>" . $row['room_number'] ." </p>  
							<h3>" . $row['type'] . "</h3>
                            <div class='mb-1'>" . $row['bedding'] . "</div>
                            <a href='roomdelete.php?id=". $row['id'] ."'><button class='btn btn-danger'>Delete</button></a>
					</div>
            </div>";
            } else if ($id == "Single Room") {
                echo "<div class='roombox roomboxsingle'>
                        <div class='text-center no-boder'>
                        <i class='fa fa-bed fa-4x mb-2'></i>
                        <span>" . $row['room_number'] ." </span>
                        <h3>" . $row['type'] . "</h3>
                        <div class='mb-1'>" . $row['bedding'] . "</div>
                        <a href='roomdelete.php?id=". $row['id'] ."'><button class='btn btn-danger'>Delete</button></a>
                    </div>
                    </div>";
            }
        }
        ?>
    </div>

</body>

</html>