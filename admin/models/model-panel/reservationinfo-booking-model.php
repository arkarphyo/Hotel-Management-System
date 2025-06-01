 <div class="reservationinfo">
                    <h4>Reservation information</h4>
                    <!-- Grid of selectable room icons (multi-selectable) -->
                    <div class="room-grid">
                        <?php
                        $sql = "SELECT * FROM room WHERE status='0'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Each room label
                                echo '<label class="room-icon-label" onmousedown="return false;" onselectstart="return false;" style="user-select:none;">';
                                echo '<input type="checkbox" name="selected_rooms[]" value="'.$row['room_number'].'" style="display:none;" required>';
                                echo '<div class="room-icon" title="Room '.$row['room_number'].'">';
                                echo '<i class="fa fa-bed"></i><br>';
                                echo $row['room_number'].'<br><small>'.$row['type'].'</small>';
                                echo '</div>';
                                echo '</label>';
                            }
                        } else {
                            echo '<div>လွတ်လတ် နေသော အခန်းများမရှိပါ</div>';
                        }
                        ?>
                    </div>
                    <script>
                    document.querySelectorAll(".room-icon-label").forEach(function(label) {
                        label.addEventListener("contextmenu", function(e) {
                            e.preventDefault();
                            if (document.getElementById("bedTypeDialog")) return;
                            let dialog = document.createElement("div");
                            dialog.id = "bedTypeDialog";
                            dialog.style.position = "fixed";
                            dialog.style.left = "0";
                            dialog.style.top = "0";
                            dialog.style.width = "100vw";
                            dialog.style.height = "100vh";
                            dialog.style.background = "rgba(0,0,0,0.4)";
                            dialog.style.display = "flex";
                            dialog.style.alignItems = "center";
                            dialog.style.justifyContent = "center";
                            dialog.style.zIndex = "2000";
                            dialog.innerHTML = `
                                <div style="background:#fff;padding:30px 40px;border-radius:10px;box-shadow:0 2px 12px #0002;text-align:center;">
                                    <h4 style="user-select:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;">အိပ်ယာအမျိုးအစား ရွေးပါ</h4>
                                    <div style="position:relative;display:inline-block;width:180px;">
                                        <select id="bedTypeSelect" style="margin:15px 0;padding:10px 16px 10px 12px;width:100%;border-radius:6px;border:1.5px solid #b0c4de;background:#f8fafc;appearance:none;outline:none;transition:border-color 0.2s,box-shadow 0.2s;box-shadow:0 2px 8px #0001;font-size:16px;cursor:pointer;position:relative;z-index:1;">
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                            <option value="Triple">Triple</option>
                                            <option value="Quad">Quad</option>
                                            <option value="None">None</option>
                                        </select>
                                        <span style="position:absolute;right:14px;top:50%;transform:translateY(-50%);pointer-events:none;color:#007bff;font-size:18px;z-index:2;">
                                            ▼
                                        </span>
                                        <span class="ripple" style="position:absolute;left:0;top:0;width:100%;height:100%;border-radius:6px;pointer-events:none;overflow:hidden;z-index:0;"></span>
                                    </div>
                                    <br>
                                    <button id="bedTypeOkBtn" style="margin-right:10px;
                                        background: rgba(255,255,255,0.25);
                                        box-shadow: 0 4px 24px 0 rgba(31,38,135,0.12);
                                        backdrop-filter: blur(8px) saturate(180%);
                                        -webkit-backdrop-filter: blur(8px) saturate(180%);
                                        border: 1.2px solid rgba(255,255,255,0.28);
                                        border-radius: 8px;
                                        color: #007bff;
                                        font-weight: 600;
                                        font-size: 16px;
                                        padding: 8px 28px;
                                        cursor: pointer;
                                        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
                                    "
                                    onmouseover="this.style.background='rgba(0,123,255,0.12)';this.style.color='#0056b3';"
                                    onmouseout="this.style.background='rgba(255,255,255,0.25)';this.style.color='#007bff';"
                                    >OK</button>
                                    <button id="bedTypeCancelBtn" style="
                                        background: rgba(255,255,255,0.25);
                                        box-shadow: 0 4px 24px 0 rgba(31,38,135,0.12);
                                        backdrop-filter: blur(8px) saturate(180%);
                                        -webkit-backdrop-filter: blur(8px) saturate(180%);
                                        border: 1.2px solid rgba(255,255,255,0.28);
                                        border-radius: 8px;
                                        color: #dc3545;
                                        font-weight: 600;
                                        font-size: 16px;
                                        padding: 8px 28px;
                                        cursor: pointer;
                                        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
                                    "
                                    onmouseover="this.style.background='rgba(220,53,69,0.12)';this.style.color='#a71d2a';"
                                    onmouseout="this.style.background='rgba(255,255,255,0.25)';this.style.color='#dc3545';"
                                    >Cancel</button>
                                </div>
                            `;
                            document.body.appendChild(dialog);

                            dialog.querySelector("#bedTypeOkBtn").onclick = function() {
                                let bedType = dialog.querySelector("#bedTypeSelect").value;
                                let roomInput = label.querySelector("input[type=checkbox]");
                                let hidden = label.querySelector("input[type=hidden][name^=bed_type_]");
                                if (!hidden) {
                                    hidden = document.createElement("input");
                                    hidden.type = "hidden";
                                    hidden.name = "bed_type_" + roomInput.value;
                                    hidden.required = true;
                                    label.appendChild(hidden);
                                }
                                hidden.value = bedType;
                                document.body.removeChild(dialog);
                            };
                            dialog.querySelector("#bedTypeCancelBtn").onclick = function() {
                                document.body.removeChild(dialog);
                            };
                        });
                    });
                    </script>
                    <script>
                    document.querySelectorAll('.room-icon-label input[type="checkbox"]').forEach(function(checkbox) {
                        
                        checkbox.addEventListener('change', function() {
                            if (checkbox.checked) {
                                checkbox.nextElementSibling.style.borderColor = '#007bff';
                                checkbox.nextElementSibling.style.background = '#e6f0ff';
                            } else {
                                checkbox.nextElementSibling.style.borderColor = '#b0c4de';
                                checkbox.nextElementSibling.style.background = '#f8fafc';
                            }
                        });
                    });
                    </script>
                    <style>
                    .room-grid {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 10px;
                        justify-content: center;
                        margin-bottom: 15px;
                    }
                    .room-icon-label {
                        cursor: pointer;
                    }
                    .room-icon {
                        border: 2px solid #b0c4de;
                        border-radius: 8px;
                        padding: 10px 15px;
                        text-align: center;
                        background: #f8fafc;
                        transition: border-color 0.2s, background 0.2s;
                        min-width: 70px;
                    }
                    .room-icon-label input[type="radio"]:checked + .room-icon {
                        border-color: #007bff;
                        background: #e6f0ff;
                    }
                    .room-icon i.fa-bed {
                        font-size: 24px;
                        color: #007bff;
                    }

                    /* Responsive styles */
                    @media (max-width: 900px) {
                        .setbookingform {
                            width: 98%;
                            height: auto;
                            min-height: 90vh;
                            padding: 0;
                        }
                        .setbookingform .middle {
                            flex-direction: column;
                            height: auto;
                        }
                        .setbookingform .middle .modelinfo,
                        .setbookingform .middle .reservationinfo {
                            width: 100%;
                            min-width: 0;
                            padding: 10px;
                        }
                        .room-grid {
                            gap: 6px;
                        }
                    }
                    @media (max-width: 600px) {
                        .setbookingform {
                            width: 100vw;
                            min-width: 0;
                            border-radius: 0;
                            padding: 0;
                        }
                        .setbookingform .head h3 {
                            left: 0;
                            font-size: 18px;
                        }
                        .setbookingform .middle {
                            flex-direction: column;
                            height: auto;
                        }
                        .setbookingform .middle .modelinfo,
                        .setbookingform .middle .reservationinfo {
                            padding: 6px;
                        }
                        .room-icon {
                            min-width: 55px;
                            padding: 7px 5px;
                            font-size: 13px;
                        }
                        .room-icon i.fa-bed {
                            font-size: 18px;
                        }
                        .datesection span {
                            display: block;
                            margin-bottom: 8px;
                        }
                    }
                    /* Glassmorphism effect */
                    .glass-blur {
                        background: rgba(204, 223, 244, 0.45) !important;
                        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
                        backdrop-filter: blur(16px) saturate(180%);
                        -webkit-backdrop-filter: blur(16px) saturate(180%);
                        border: 1.5px solid rgba(255, 255, 255, 0.28);
                    }
                    </style>
                    <script>
                    document.querySelectorAll('.room-icon-label input[type="radio"]').forEach(function(radio) {
                        radio.addEventListener('change', function() {
                            document.querySelectorAll('.room-icon').forEach(function(icon) {
                                icon.style.borderColor = '#b0c4de';
                                icon.style.background = '#f8fafc';
                            });
                            if (radio.checked) {
                                radio.nextElementSibling.style.borderColor = '#007bff';
                                radio.nextElementSibling.style.background = '#e6f0ff';
                            }
                        });
                    });
                    </script>
                    <!-- Show selected room count in Burmese -->
                    <div id="selected-room-count" style="margin-top:10px;font-weight:bold;color:#007bff;"></div>
                    <script>
                    function toBurmeseNumber(n) {
                        const burmeseDigits = ['၀','၁','၂','၃','၄','၅','၆','၇','၈','၉'];
                        return String(n).split('').map(d => burmeseDigits[d] || d).join('');
                    }
                    function updateSelectedRoomCount() {
                        const checked = document.querySelectorAll('.room-icon-label input[type="checkbox"]:checked').length;
                        const countDiv = document.getElementById('selected-room-count');
                        if (checked > 0) {
                            countDiv.textContent = 'ရွေးထားသော အခန်းအရေအတွက် - ' + toBurmeseNumber(checked) + ' ခန်း';
                            countDiv.style.color = 'green';
                        } else {
                            countDiv.textContent = '‌ရွေးထားသော အခန်းအရေအတွက် မရှိပါ';
                            countDiv.style.color = 'red';
                        }
                    }
                    document.querySelectorAll('.room-icon-label input[type="checkbox"]').forEach(function(cb) {
                        cb.addEventListener('change', updateSelectedRoomCount);
                    });
                    updateSelectedRoomCount();
                    </script>
                  
                    
                </div>
