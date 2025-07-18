<?php

include '../config.php';
session_start();

// page redirect
$usermail="";
$usermail=$_SESSION['usermail'];
if($usermail == true){

}else{
  header("location: http://localhost/Hotel-Management-System/index.php");
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
    <div id="loading" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 220px;">
        <div style="position: relative; width: 60px; height: 60px; margin: 0 auto;">
            <svg class="spinner" viewBox="0 0 30 30" style="width:60px; height:60px; position:absolute; top:0; left:0; z-index:1;">
                <defs>
                    <linearGradient id="spinner-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#bfa14a"/>
                        <stop offset="100%" stop-color="#8c6d1f"/>
                    </linearGradient>
                </defs>
                <circle
                    cx="15"
                    cy="15"
                    r="13"
                    fill="none"
                    stroke="url(#spinner-gradient)"
                    stroke-width="1"
                    stroke-linecap="round"
                    stroke-dasharray="25"
                    stroke-dashoffset="10">
                    <animateTransform
                        attributeName="transform"
                        type="rotate"
                        from="0 15 15"
                        to="360 15 15"
                        dur="1.2s"
                        repeatCount="indefinite"/>
                </circle>
            </svg>
            <img src="../image/mrlogo.png" alt="Logo" style="position:absolute; top:50%; left:50%; width:36px; height:36px; transform:translate(-50%,-50%) scale(1); border-radius:50%; z-index:2; animation: logo-zoom 1.5s infinite alternate;">
            <style>
            @keyframes logo-zoom {
                0% { transform: translate(-50%,-50%) scale(1);}
                100% { transform: translate(-50%,-50%) scale(1.18);}
            }
            .spinner {
                animation: spinner-rotate 1.2s linear infinite;
            }
            @keyframes spinner-rotate {
                100% { transform: rotate(360deg);}
            }
            </style>
        </div>  
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 80px;">
            <span class="gradient-text" style="font-size:1.2rem;">ခဏစောင့်ပေးပါ...</span>
        </div>
    </div>
    

    <!-- mobile view -->
    <div id="mobileview">
        <sapn>Admin Panel ကို Mobile ဖုန်းဖြင့် အသုံးမပြုနိုင်ပါ။</span>
        <h5 style="color: red;">Diesktop Computer ဖြင့်သာအသုံးပြုပေးပါရန်။</h5>
    </div>
  
    <!-- nav bar -->
    <nav class="uppernav glass-blur" style="height:70px; border-radius: 0 0 0 0; position: relative; background: #fff; box-shadow: 0 8px 32px 0 rgba(10,24,61,0.25); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);">
        <div class="logo gold-gradient-logo-bg" style="background: transparent; box-shadow: none; border-radius: 0 0 40px 0;">
            <div style="position: relative; width: 120px; height: 120px; background: transparent;">
            <img class="navlogo reflection-animate zoom-animate" src="../image/mrlogo.png" width="100" height="100" alt="Mount Royal Logo" style="border-radius: 24px; background: transparent; object-fit: cover; width: 120px; height: 120px; animation: zoom-perspective 2.5s ease-in-out infinite; box-shadow: none !important;">

            <style>
            @keyframes zoom-perspective {
                0% {
                    transform: perspective(400px) scale(1) rotateY(0deg);
                    box-shadow: 0 4px 24px rgba(76,175,80,0.12);
                }
                20% {
                    transform: perspective(400px) scale(1.08) rotateY(8deg);
                    box-shadow: 0 8px 32px rgba(76,175,80,0.18);
                }
                50% {
                    transform: perspective(400px) scale(1.15) rotateY(-8deg);
                    box-shadow: 0 12px 40px rgba(76,175,80,0.22);
                }
                80% {
                    transform: perspective(400px) scale(1.08) rotateY(8deg);
                    box-shadow: 0 8px 32px rgba(76,175,80,0.18);
                }
                100% {
                    transform: perspective(400px) scale(1) rotateY(0deg);
                    box-shadow: 0 4px 24px rgba(76,175,80,0.12);
                }
            }
            </style>
            
        </div>
            <p class="wave-text" style="font-size:1.3rem; background: linear-gradient(90deg, #bfa14a 0%, #ffd700 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-fill-color: transparent; margin-left: 16px;">
                <span class="gold-gradient-animate dark-gold-reflect">Mount Royal</span>
                <style>
                .dark-gold-reflect {
                    color: #bfa14a;
                    font-weight: bold;
                    position: relative;
                    background: linear-gradient(90deg, #bfa14a 0%, #ffd700 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    text-fill-color: transparent;
                    animation: gold-reflect-anim 2.5s linear infinite;
                }
                .dark-gold-reflect::after {
                    content: "";
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(120deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0.05) 80%);
                    opacity: 0.7;
                    pointer-events: none;
                    mix-blend-mode: lighten;
                    animation: gold-reflect-gloss 2.5s linear infinite;
                }
                @keyframes gold-reflect-anim {
                    0% { filter: brightness(1) drop-shadow(0 0 6px #bfa14a); }
                    50% { filter: brightness(1.15) drop-shadow(0 0 16px #ffd700); }
                    100% { filter: brightness(1) drop-shadow(0 0 6px #bfa14a); }
                }
                @keyframes gold-reflect-gloss {
                    0% { left: -100%; opacity: 0.5; }
                    50% { left: 100%; opacity: 0.9; }
                    100% { left: -100%; opacity: 0.5; }
                }
                </style>
            </p>
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
            background: #fff !important;
        }
        .uppernav {
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
            <li class="pagebtn"><i class="fas fa-bed" onclick="document.getElementById('iframe2').contentWindow.location.reload();"></i>&nbsp&nbsp&nbsp Booking</li>
            <li class="pagebtn"><i class="fas fa-wallet" onclick="document.getElementById('iframe3').contentWindow.location.reload();"></i>&nbsp&nbsp&nbsp Payment</li>            
            <li class="pagebtn"><i class="fas fa-house"  onclick="alert('Under Development');"></i>&nbsp&nbsp&nbsp Rooms</li>
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
