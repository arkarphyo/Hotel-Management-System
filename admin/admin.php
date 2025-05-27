<?php

include '../config.php';
session_start();

// page redirect
$usermail="";
$usermail=$_SESSION['usermail'];
if($usermail == true){

}else{
  header("location: http://localhost/hotelmanage_system/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <!-- loading bar -->
    <script src="../dist/pace-js/pace.min.js"></script>
    
    <link rel="stylesheet" href="../admin/widget/css/datepicker.css">   
    <link rel="stylesheet" href="../css/flash.css">
    <!-- fontowesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/all.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/brands.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/duotone.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/sharp-solid.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/sharp-regular.css"/>
    <link rel="stylesheet" href="../assets/font-awesome/css/sharp-light.css"/>
    <script src="../assets/font-awesome/js/pro.min.js"></script>
    <title>Mount Royal - Admin Dashboard</title>
</head>

<body>


    <!-- Loading screen -->
    <div id="loading">
         <svg class="spinner" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" fill="none" stroke="#4CAF50" stroke-width="5" stroke-linecap="round"/>
        </svg>  
        <h3 class="gradient-text">ခဏစောင့်ပေးပါ...</h3>

    </div>

    <!-- mobile view -->
    <div id="mobileview">
        <sapn>Admin Panel ကို Mobile ဖုန်းဖြင့် အသုံးမပြုနိုင်ပါ။</span>
        <h5 style="color: red;">Diesktop Computer ဖြင့်သာအသုံးပြုပေးပါရန်။</h5>
    </div>
  
    <!-- nav bar -->
    <nav class="uppernav">
        <div class="logo">
            <img class="bluebirdlogo" src="../image/mrlogo.png" width="100" height="100" alt="logo">
            <p>Mount Royal</p>
        </div>
        <div class="logout">
        <a href="../logout.php"><button class="btn btn-primary">Logout</button></a>
        </div>
    </nav>
    <nav class="sidenav">
        <ul>
            <li class="pagebtn active"><img src="../image/icon/dashboard.png">&nbsp&nbsp&nbsp Dashboard</li>
            <li class="pagebtn"><i class="fas fa-bed"></i>&nbsp&nbsp&nbsp Booking</li>
            <li class="pagebtn"><i class="fas fa-wallet"></i>&nbsp&nbsp&nbsp Payment</li>            
            <li class="pagebtn"><i class="fas fa-house"></i>&nbsp&nbsp&nbsp Rooms</li>
            <li class="pagebtn"><i class="fas fa-house"></i>&nbsp&nbsp&nbsp Setup Room</li>
            <li class="pagebtn"><i class="fas fa-clipboard-list"></i>&nbsp&nbsp&nbsp Reservation</li>
            <li class="pagebtn"><i class="fas fa-concierge-bell"></i>&nbsp&nbsp&nbsp Service</li>
            <li class="pagebtn"><i class="fas fa-file-alt"></i>&nbsp&nbsp&nbsp Report</li>
            <li class="pagebtn"><i class="fas fa-user-tie"></i>&nbsp&nbsp&nbsp Staff</li>
            <li class="pagebtn"><i class="fas fa-star"></i>&nbsp&nbsp&nbsp Feedback</li>
            <li class="pagebtn"><i class="fas fa-gear"></i>&nbsp&nbsp&nbsp Settings</li>
            <li class="pagebtn"><i class="fas fa-question"></i>&nbsp&nbsp&nbsp FAQ</li>
        </ul>
    </nav>

    <!-- main section -->
     
    <div class="mainscreen">
        <iframe class="frames frame1 active" src="./dashboard.php" frameborder="0"></iframe>
        <iframe class="frames frame2" src="./roombook.php" frameborder="0"></iframe>
        <iframe class="frames frame3" src="./payment.php" frameborder="0"></iframe>
        <iframe class="frames frame4" src="./room.php" frameborder="0"></iframe>
        <iframe class="frames frame6" src="./roomsetup.php" frameborder="0"></iframe>
        <iframe class="frames frame5" src="./staff.php" frameborder="0"></iframe>
    </div>
</body>

<script src="./javascript/script.js"></script>
<script src="../admin/widget/js/datepicker.js"></script>

<!-- JS to hide loading screen when page is ready -->
<script>
  window.addEventListener('load', function () {
    document.getElementById("loading").style.display = "none";
    document.getElementById("mainscreen").style.display = "block";
  });
</script>


</html>
