<div class="modelinfo">
                    <h4 style="font-size: 16px;">Booking Information</h4>
                    <input type="text" name="Name" id="nameInput" placeholder="အမည်" required style="padding: 5px 8px;">
                    <input type="phone" name="Phone" id="phoneInput" placeholder="ဖုန်းနံပါတ်" required  style="padding: 5px 8px;">


                    <input type="text" name="National" id="nationalInput" class="selectinput" list="nationalList" placeholder="နိုင်ငံသားရွေးပါ" required autocomplete="off" id="nationalInput"  style="padding: 5px 8px;">
                    <datalist id="nationalList">
                        <?php
                            foreach($countries as $key => $value):
                                echo '<option value="'.$value.'">';
                            endforeach;
                        ?>
                    </datalist>
                    <input type="text" name="Meal" id="mealInput" class="selectinput" list="mealList" placeholder="အစားအစာရွေးပါ" required autocomplete="off" id="mealInput"  style="padding: 5px 8px;">
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
                            <input name="cin" id="cinInput" type="text" required placeholder="Check In Date (dd-MM-yyyy)" onclick="showDatePicker(this)" onblur="formatDateInput(this)">
                        </span>
                        <span>
                            <input name="cout" id="coutInput" type="text" required  placeholder="Check Out Date"  onclick="showDatePicker(this)" onblur="formatDateInput(this)">
                        </span>
                    </div>
                </div>

                
                            <script>
                            function formatDateInput(input) {
                                // Only format if input type is text and value is not empty
                                if (input.type === 'text' && input.value) {
                                    var val = input.value.trim();
                                    // If already in dd-MM-yyyy, do nothing
                                    if (/^\d{2}-\d{2}-\d{4}$/.test(val)) return;
                                    // If in yyyy-mm-dd, convert to dd-MM-yyyy
                                    var match = val.match(/^(\d{4})-(\d{2})-(\d{2})$/);
                                    if (match) {
                                        input.value = match[3] + '-' + match[2] + '-' + match[1];
                                        return;
                                    }
                                    // If in MM/dd/yyyy, convert to dd-MM-yyyy
                                    match = val.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
                                    if (match) {
                                        input.value = match[2] + '-' + match[1] + '-' + match[3];
                                        return;
                                    }
                                    // If in dd/MM/yyyy, convert to dd-MM-yyyy
                                    match = val.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
                                    if (match) {
                                        input.value = match[1] + '-' + match[2] + '-' + match[3];
                                        return;
                                    }
                                    // If in yyyy.MM.dd, convert to dd-MM-yyyy
                                    match = val.match(/^(\d{4})\.(\d{2})\.(\d{2})$/);
                                    if (match) {
                                        input.value = match[3] + '-' + match[2] + '-' + match[1];
                                        return;
                                    }
                                    // If in dd.MM.yyyy, convert to dd-MM-yyyy
                                    match = val.match(/^(\d{2})\.(\d{2})\.(\d{4})$/);
                                    if (match) {
                                        input.value = match[1] + '-' + match[2] + '-' + match[3];
                                        return;
                                    }
                                }
                            }
                            </script>
                            <script>
                            function showDatePicker(input) {
                                // Use browser's date picker if available
                                if (input.type !== 'date') {
                                    try {
                                        input.type = 'date';
                                        input.focus();
                                        input.addEventListener('blur', function revertType() {
                                            input.type = 'text';
                                            input.removeEventListener('blur', revertType);
                                        });
                                    } catch (e) {
                                        // fallback: do nothing
                                    }
                                }
                            }
                            </script>
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