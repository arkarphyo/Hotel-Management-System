
<div class="modelinfo">
            <h4 style="font-size: 16px;">Booking Information</h4>
                    <input type="input" name="ID" id="editBookingId" value="" disabled>
                    <input type="text" name="Name" id="editNameInput" placeholder="အမည်" required style="padding: 5px 8px;">
                    <input type="phone" name="Phone" id="editPhoneInput" placeholder="ဖုန်းနံပါတ်" required  style="padding: 5px 8px;">


                    <input type="text" name="National" id="editNationalInput" class="selectinput" list="nationalList" placeholder="နိုင်ငံသားရွေးပါ" required autocomplete="off" id="nationalInput"  style="padding: 5px 8px;">
                    <datalist id="editNationalList">
                        <?php
                            foreach($countries as $key => $value):
                                echo '<option value="'.$value.'">';
                            endforeach;
                        ?>
                    </datalist>
                     <div style="display: flex; align-items: center; gap: 8px; width: 100%; max-width: 350px; margin-bottom: 12px;">
                        <label for="editMealInput" style="margin: 0; font-size: 16px; cursor: pointer; display: flex; align-items: center;">
                            <input type="checkbox" name="Meal" id="editMealInput" style="margin-right: 8px; accent-color: #ffb300; width: 22px; height: 22px; min-width: 22px; min-height: 22px; cursor: pointer; vertical-align: middle;" onchange="toggleMealIconColor(this)">
                            <!-- Breakfast logo with people icon SVG -->
                            <svg id="mealIconSvg" width="22" height="22" viewBox="0 0 22 22" style="vertical-align: middle; margin-right: 6px;" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Plate -->
                                <circle cx="11" cy="11" r="9" stroke="#ffb300" stroke-width="2" fill="#fffbe6"/>
                                <!-- Egg white -->
                                <ellipse cx="11" cy="12" rx="3.2" ry="2.2" fill="#fff"/>
                                <!-- Egg yolk -->
                                <circle id="editEggYolk" cx="11" cy="12" r="0.9" fill="#ffb300"/>
                                <!-- Toast/Bread -->
                                <rect x="7" y="7.5" width="5" height="2.5" rx="1.2" fill="#ffe0a3" stroke="#ffb300" stroke-width="0.6"/>
                                <!-- Steam lines for hot breakfast -->
                                <path d="M9.5 6.5c0-.7.7-1.2 1.5-1.2s1.5.5 1.5 1.2" stroke="#b0c4de" stroke-width="0.5" stroke-linecap="round"/>
                            </svg>
                            <script>
                            function toggleMealIconColor(checkbox) {
                                var yolk = document.getElementById('editEggYolk');
                                if (checkbox.checked) {
                                    yolk.setAttribute('fill', '#ff9800'); // checked color
                                } else {
                                    yolk.setAttribute('fill', '#ffb300'); // normal color
                                }
                            }
                            </script>
                            အစားအစာရွေးပါ
                        </label>
                    </div>
                    
                    <div class="datesection">
                        <span>
                            <input name="cin" id="editCinInput" type="text" required placeholder="Check In Date (dd-MM-yyyy)" 
                                onclick="showDatePicker(this)" 
                                onblur="formatDateInput(this)"
                                onkeydown="if(event.code==='Space' || event.key===' '){showDatePicker(this);}">
                        </span>
                        <span>
                            <input name="cout" id="editCoutInput" type="text" required placeholder="Check Out Date" 
                                onclick="showDatePicker(this)" 
                                onblur="formatDateInput(this)"
                                onkeydown="if(event.code==='Space' || event.key===' '){showDatePicker(this);}">
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

