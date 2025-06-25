<!-- editbookingmodel start -->
      
<style>

    #editbookingmodel{
        position : fixed;
        z-index: 1000;
        height: 70vh;
        width: 100%;
        display: none;
        /* display: flex; */
        justify-content: center;
        /* align-items: center; */
        background-color: #00000079;
    }

    #editbookingmodel .editbookingform{
        height: 70vh;
        min-height: 300px;
        max-height: 70vh;
        box-sizing: border-box;
        width: 80%;
        background-color: #ccdff4;
        border-radius: 10px;  
        /* temp */
        position: relative;
        top: 20px;
        bottom: 20px;
        animation: modelinfoform .3s ease;
    }


    .editbookingform .head{
        /* width: 100%; */
        padding: 0 10px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .editbookingform .head h3{
        color: #111f49;
        position: relative;
        left: 40%;
        margin-top: 10px;
    }
    .editbookingform .head i{
        font-size: 25px;
        cursor: pointer;
    }

    .editbookingform .middle{
        width: 100%;
        margin: 10px 0 0 0;
        display: flex;
    }

    .editbookingform .middle .modelinfo{
        width: 100%;
        background-color: rgba(255, 255, 255, 0.752);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .editbookingform .middle .reservationinfo{
        
        width: 100%;
        background-color: rgba(255, 255, 255, 0.752);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .editbookingform .footer{
        height: 50px;
        display: flex;
        justify-content: center;
        margin: 10px;
    }

    @keyframes setbookingform{
        0%{
            transform: translateY(50px);
        }
    }


</style>

    <div id="editbookingmodel">
        <form action="" method="POST" class="editbookingform glass-blur macbook-popup" style="height: 75vh; min-height: 250px; max-height:85vh; animation: macbookPopup 0.4s cubic-bezier(.4,0,.2,1); box-shadow: 0 16px 48px rgba(0,0,0,0.22); border-radius: 18px 18px 18px 18px/18px 18px 18px 18px;">
            <div class="head" style="height: 32px; padding: 0 12px; border-radius: 18px 18px 0 0; background: linear-gradient(90deg, #e3e6ea 0%, #cfd8e3 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; align-items: center;">
                <h3 style="font-size: 1.1rem; margin: 0 auto; position: static; flex: 1; text-align: center; color: #222d3b;"><span id="bookingId"></span> - EDIT BOOKING</h3>
                <i class="fa-solid fa-circle-xmark" style="font-size: 20px; transition: transform 0.18s cubic-bezier(.4,0,.2,1), color 0.18s; color: #6b7280;" 
                   onmouseover="this.style.transform='scale(1.18) rotate(8deg)'; this.style.color='#e74c3c';" 
                   onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.color='#6b7280';" 
                   onclick="closemodel(editbookingmodel)">
                </i>
            </div>
            <div class="middle" style="height: 70vh; max-height: 70vh;">
                <?php include(__DIR__ . '/edit-booking-model-panel/info-booking-model.php'); ?>

                <div class="line"></div>
                
                <?php include(__DIR__ . '/edit-booking-model-panel/reservationinfo-booking-model.php'); ?>
            </div>
            <div class="footer" style="position: absolute; bottom: 0; left: 0; width: 100%;">
                <?php include(__DIR__ . '/edit-booking-model-panel/footer-booking-model.php'); ?>
            </div>
        </form>
    </div>
    <style>
    @keyframes macbookPopup {
        0% {
            opacity: 0;
            transform: scale(0.95) translateY(40px);
            box-shadow: 0 0 0 rgba(0,0,0,0);
        }
        60% {
            opacity: 1;
            transform: scale(1.02) translateY(-8px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.18);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        }
    }
    .macbook-popup {
        animation: macbookPopup 0.4s cubic-bezier(.4,0,.2,1);
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        transition: box-shadow 0.2s;
    }
    </style>
    <!-- setbookingmodel end -->
    <script src="actions/js/actions.js"></script>
    <script>
    // Attach ripple effect to dynamically created bedTypeSelect dropdowns
    document.addEventListener('mousedown', function(e) {
        if (e.target && e.target.id === 'bedTypeSelect') {
            var select = e.target;
            var wrapper = select.parentElement;
            var ripple = wrapper.querySelector('.ripple');
            var rect = wrapper.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var circle = document.createElement('span');
            circle.style.position = 'absolute';
            circle.style.left = (x - 50) + 'px';
            circle.style.top = (y - 50) + 'px';
            circle.style.width = circle.style.height = '100px';
            circle.style.background = 'rgba(0,123,255,0.18)';
            circle.style.borderRadius = '50%';
            circle.style.transform = 'scale(0)';
            circle.style.opacity = '1';
            circle.style.pointerEvents = 'none';
            circle.style.transition = 'transform 0.4s cubic-bezier(.4,0,.2,1),opacity 0.6s';
            ripple.appendChild(circle);
            setTimeout(function() {
                circle.style.transform = 'scale(2.5)';
                circle.style.opacity = '0';
            }, 10);
            setTimeout(function() {
                if (circle.parentNode) ripple.removeChild(circle);
            }, 600);
        }
    });
    </script>
    <!-- setbookingmodel end -->
