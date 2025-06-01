<!-- setbookingmodel start -->
      
<style>

    #setbookingmodel{
        position : fixed;
        z-index: 1000;
        height: 100%;
        width: 100%;
        display: none;
        /* display: flex; */
        justify-content: center;
        /* align-items: center; */
        background-color: #00000079;
    }

    #setbookingmodel .setbookingform{
        height: 90vh;
        min-height: 400px;
        max-height: 98vh;
        box-sizing: border-box;
        width: 80%;
        background-color: #ccdff4;
        border-radius: 10px;  
        /* temp */
        position: relative;
        top: 20px;
        animation: modelinfoform .3s ease;
    }


    .setbookingform .head{
        /* width: 100%; */
        padding: 0 10px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .setbookingform .head h3{
        color: #111f49;
        position: relative;
        left: 40%;
        margin-top: 10px;
    }
    .setbookingform .head i{
        font-size: 25px;
        cursor: pointer;
    }

    .setbookingform .middle{
        width: 100%;
        height: 500px;
        margin: 10px 0 0 0;
        display: flex;
    }

    .setbookingform .middle .modelinfo{
        width: 100%;
        background-color: rgba(255, 255, 255, 0.752);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .setbookingform .middle .reservationinfo{
        
        width: 100%;
        background-color: rgba(255, 255, 255, 0.752);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .setbookingform .footer{
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

    <div id="setbookingmodel">
        <form action="" method="POST" class="setbookingform glass-blur">
            <div class="head">
                <h3>BOOKING</h3>
                <i class="fa-solid fa-circle-xmark" onclick="closemodel(setbookingmodel)"></i>
            </div>
            <div class="middle">
                <?php include(__DIR__ . '/model-panel/info-booking-model.php'); ?>

                <div class="line"></div>
                
                <?php include(__DIR__ . '/model-panel/reservationinfo-booking-model.php'); ?>
            </div>
            <?php include(__DIR__ . '/model-panel/footer-booking-model.php'); ?>
        </form>
    </div>
    <script src="actions/js/actions.js"></script>
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
