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
     <link
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
      />
    <!-- boot -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/room.css">
</head>

<body>

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
						</div>
                    </div>";
            } else if ($id == "Deluxe Room") {
                echo "<div class='roombox roomboxdelux'>
                        <div class='text-center no-boder'>
                        <i class='fa fa-bed-front fa-4x mb-2'></i>
                        <p>" . $row['room_number'] ." </p>
                        <h3>" . $row['type'] . "</h3>
                        <div class='mb-1'>" . $row['bedding'] . "</div>
                    </div>
                    </div>";
            } else if ($id == "Guest House") {
                echo "<div class='roombox roomboguest'>
                <div class='text-center no-boder'>
                <i class='fa fa-bed-front fa-4x mb-2'></i>
                            <p>" . $row['room_number'] ." </p>  
							<h3>" . $row['type'] . "</h3>
                            <div class='mb-1'>" . $row['bedding'] . "</div>
					</div>
            </div>";
            } else if ($id == "Single Room") {
                echo "<div class='roombox roomboxsingle'>
                        <div class='text-center no-boder'>
                        <i class='fa fa-bed fa-4x mb-2'></i>
                        <span>" . $row['room_number'] ." </span>
                        <h3>" . $row['type'] . "</h3>
                        <div class='mb-1'>" . $row['bedding'] . "</div>
                    </div>
                    </div>";
            }
        }
        ?>
    </div>

</body>

</html>