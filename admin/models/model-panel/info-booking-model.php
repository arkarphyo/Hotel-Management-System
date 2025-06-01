<div class="modelinfo">
                    <h4>Booking Information</h4>
                    <input type="text" name="Name" placeholder="အမည်" required>
                    <input type="phone" name="Phone" placeholder="ဖုန်းနံပါတ်" required>


                    <input type="text" name="National" class="selectinput" list="nationalList" placeholder="နိုင်ငံသားရွေးပါ" required autocomplete="off" id="nationalInput">
                    <datalist id="nationalList">
                        <?php
                            foreach($countries as $key => $value):
                                echo '<option value="'.$value.'">';
                            endforeach;
                        ?>
                    </datalist>
                    <input type="text" name="Meal" class="selectinput" list="mealList" placeholder="အစားအစာရွေးပါ" required autocomplete="off" id="mealInput">
                    <datalist id="mealList">
                        <?php 
                            $sql = "SELECT * FROM meal";
                            $result = mysqli_query($conn, $sql);
                            echo '<option value="အစားအစာရွေးပါ">';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="'.$row['name'].'">';
                                }
                            } else {
                                echo '<option value="အစားစာ မပါ">';
                            }
                        ?>
                    </datalist>
                    
                    <div class="datesection">
                        <span>
                            <label for="cin">Check-In</label>
                            <input name="cin" type="date" required>
                        </span>
                        <span>
                            <label for="cout">Check-Out</label>
                            <input name="cout" type="date" required>
                        </span>
                    </div>
                </div>
                <style>
                .modelinfo {
                    width: 100%;
                    background-color: rgba(255, 255, 255, 0.752);
                    padding: 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    box-sizing: border-box;
                }
                .modelinfo input,
                .modelinfo select {
                    width: 100%;
                    max-width: 350px;
                    margin-bottom: 12px;
                    padding: 8px 12px;
                    border-radius: 6px;
                    border: 1.2px solid #b0c4de;
                    font-size: 16px;
                    box-sizing: border-box;
                }
                .modelinfo h4 {
                    margin-bottom: 18px;
                    color: #111f49;
                    font-size: 20px;
                    text-align: center;
                }
                .modelinfo .datesection {
                    display: flex;
                    gap: 16px;
                    width: 100%;
                    max-width: 350px;
                    justify-content: space-between;
                }
                .modelinfo .datesection span {
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 0;
                }
                .modelinfo .datesection label {
                    margin-bottom: 4px;
                    font-size: 14px;
                    color: #222;
                }
                @media (max-width: 900px) {
                    .modelinfo {
                        padding: 12px 6px;
                    }
                    .modelinfo input,
                    .modelinfo select {
                        max-width: 100%;
                        font-size: 15px;
                    }
                    .modelinfo .datesection {
                        flex-direction: column;
                        gap: 8px;
                        max-width: 100%;
                    }
                }
                @media (max-width: 600px) {
                    .modelinfo {
                        padding: 6px 2px;
                    }
                    .modelinfo input,
                    .modelinfo select {
                        font-size: 14px;
                        padding: 7px 8px;
                    }
                    .modelinfo h4 {
                        font-size: 16px;
                        margin-bottom: 10px;
                    }
                    .modelinfo .datesection {
                        flex-direction: column;
                        gap: 6px;
                        max-width: 100%;
                    }
                }
                </style>