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
    <nav class="uppernav glass-blur" style="height:70px; border-radius: 0 0 0 0;">
        <div class="logo">
            <img class="bluebirdlogo" src="../image/mrlogo.png" width="60" height="60" alt="logo" style="margin-right:10px;">
            <p class="wave-text" style="font-size:1.3rem; background: linear-gradient(90deg, #bfa14a 0%, #ffd700 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-fill-color: transparent;">
                <span style="font-size: 1.1rem; background: linear-gradient(90deg, #bfa14a 0%, #ffd700 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent; text-fill-color: transparent;">Mount Royal</span>
                <script>
                    // Gradient gold reflection animation every 3 seconds
                    function animateWaveText() {
                        const p = document.querySelector('.wave-text');
                        const text = "Mount Royal";
                        p.innerHTML = '';
                        for (let i = 0; i < text.length; i++) {
                            const span = document.createElement('span');
                            span.textContent = text[i];
                            span.style.animationDelay = (i * 0.08) + 's';
                            p.appendChild(span);
                        }
                        // Remove animation after it's done so it can be triggered again
                        setTimeout(() => {
                            p.innerHTML = text;
                        }, 1200);
                    }

                    function goldReflection() {
                        const p = document.querySelector('.wave-text');
                        p.style.background = 'linear-gradient(90deg, #FFD700 20%, #FFF8DC 50%, #FFD700 80%)';
                        p.style.webkitBackgroundClip = 'text';
                        p.style.webkitTextFillColor = 'transparent';
                        p.style.backgroundClip = 'text';
                        p.style.textFillColor = 'transparent';
                        p.style.transition = 'background 0.5s';
                        setTimeout(() => {
                            p.style.background = '';
                            p.style.webkitBackgroundClip = '';
                            p.style.webkitTextFillColor = '';
                            p.style.backgroundClip = '';
                            p.style.textFillColor = '';
                        }, 1200);
                    }

                    animateWaveText();
                    setInterval(() => {
                        animateWaveText();
                        goldReflection();
                    }, 3000);
                </script>
            </p>
            <style>
                .wave-text {
                    display: inline-block;
                    font-size: 1.3rem !important;
                    font-weight: bold;
                    color: #222;
                    letter-spacing: 2px;
                    margin: 0;
                    text-shadow: 0 2px 8px rgba(255,255,255,0.4);
                }
                .wave-text span {
                    display: inline-block;
                    animation: wave 1s ease-in-out;
                    animation-iteration-count: 1;
                }
                @keyframes wave {
                    0% { transform: translateY(0); }
                    20% { transform: translateY(-12px); color: #4CAF50; }
                    40% { transform: translateY(0); color: #2196F3; }
                    100% { transform: translateY(0); color: #222; }
                }
            </style>
        </div>
        
            <button class="glass-btn" onclick="logout()">Logout</button>
            <style>
            .glass-btn {
                padding: 10px 28px;
                font-size: 1rem;
                border-radius: 10px;
                border: none;
                background: rgba(255,255,255,0.18);
                color: #222;
                font-weight: 600;
                box-shadow: 0 4px 24px 0 rgba(31,38,135,0.18);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                cursor: pointer;
                position: relative;
                overflow: hidden;
                transition: background 0.3s, color 0.3s;
            }
            .glass-btn::before {
                content: "";
                position: absolute;
                top: -40%;
                left: -60%;
                width: 220%;
                height: 180%;
                background: linear-gradient(120deg, rgba(255,255,255,0.45) 0%, rgba(255,255,255,0.05) 80%);
                opacity: 0.7;
                transform: skewY(-8deg) translateX(-60px);
                animation: glass-btn-reflect-move 3.5s linear infinite;
                filter: blur(1.5px);
                pointer-events: none;
            }
            @keyframes glass-btn-reflect-move {
                0% {
                    transform: skewY(-8deg) translateX(-60px);
                    opacity: 0.7;
                }
                60% {
                    opacity: 0.9;
                }
                100% {
                    transform: skewY(-8deg) translateX(60px);
                    opacity: 0.7;
                }
            }
            .glass-btn:hover {
                background: rgba(255,255,255,0.28);
                color: #4CAF50;
            }
            </style>
        <script>
            function logout() {
            window.location.href = "../logout.php";
            }
        </script>
        <div class="glass-reflection"></div>
    </nav>
    <style>
        .uppernav.glass-blur {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            height: 110px;
            background: rgba(255,255,255,0.15);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 0 0 24px 24px;
            border: 1px solid rgba(255,255,255,0.18);
            overflow: hidden;
        }
        .uppernav .logo {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .uppernav .logo p {
            font-size: 2rem;
            font-weight: bold;
            color: #222;
            letter-spacing: 2px;
            margin: 0;
            text-shadow: 0 2px 8px rgba(255,255,255,0.4);
        }
        .uppernav .logout button {
            padding: 10px 28px;
            font-size: 1rem;
            border-radius: 8px;
            border: none;
            background: linear-gradient(90deg, #4CAF50 60%, #2196F3 100%);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(76,175,80,0.15);
            cursor: pointer;
            transition: background 0.3s;
        }
        .uppernav .logout button:hover {
            background: linear-gradient(90deg, #2196F3 60%, #4CAF50 100%);
        }
        .glass-reflection {
            pointer-events: none;
            position: absolute;
            top: -40px;
            left: -60px;
            width: 180%;
            height: 80px;
            background: linear-gradient(120deg, rgba(255,255,255,0.35) 0%, rgba(255,255,255,0.05) 80%);
            opacity: 0.7;
            transform: skewY(-8deg) translateX(-60px);
            animation: glass-reflect-move 3.5s linear infinite;
            filter: blur(2px);
        }
        @keyframes glass-reflect-move {
            0% {
                transform: skewY(-8deg) translateX(-60px);
                opacity: 0.7;
            }
            60% {
                opacity: 0.9;
            }
            100% {
                transform: skewY(-8deg) translateX(100px);
                opacity: 0.7;
            }
        }
    </style>
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
