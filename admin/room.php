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
    <script src="../assets/font-awesome/js/pro.min.js"></script>
    <!-- Bootstrap -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="javascript/roombook.js"></script>
    <script src="javascript/room.js"></script>
    <link rel="stylesheet" href="css/room.css">
</head>

<body>

    <div class="room">

      <div id="roomContainer" class=".gridroom"></div>
      
    </div>
    <script> 
         getRoomData();
        
      </script>

</body>

</html>
