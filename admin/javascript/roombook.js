var detailpanel = document.getElementById("guestdetailpanel");

openmodel = (modelpanel) => {
    modelpanel.style.display = "flex";
}
closemodel = (modelpanel) => {
    modelpanel.style.display = "none";
}
editOpenmodelArg = (modelpanel, bookingId) => {
    modelpanel.style.display = "flex";
    // Fetch booking data
    fetch('actions/php/get_booking_info.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: bookingId
        })
    })
        .then(response => response.json())
        .then(data => {
             if (bookingId) {
                    const newUrl = `${window.location.pathname}?ID=${encodeURIComponent(bookingId)}`;
                    window.history.pushState({ path: newUrl }, '', newUrl);

                    // Optional: trigger something
                    console.log("URL changed to: " + window.location.href);
                }
                editLoadRooms(); // Load rooms when opening the edit modal
            // Populate fields
            document.getElementById('editBookingId').value = data.id; // Use .value for input
            document.getElementById('editNameInput').value = data.Name;
            document.getElementById('editPhoneInput').value = data.Phone;
            document.getElementById('editNationalInput').value = data.National;
            document.getElementById('editCinInput').value = data.cin;
            document.getElementById('editCoutInput').value = data.cout;
            document.getElementById('editMealInput').checked = data.Breakfast == 1 ? true : false;

            
            const status_container = document.querySelector('.edit-status');
            status_container.innerHTML = '';
            const status_icon = document.createElement('i');
            const status_label = document.createElement('i');
            const edit_icon = document.createElement('i');
            
            status_label.className = 'edit_booking_status_label';
            status_label.textContent = `${data.stat == 2 ? 'Confirmed' : data.stat == 0 ? 'Cancelled' : data.stat == 3 ? 'Staying' : 'Booking'}`;
            status_label.style.fontSize = '12px';
            status_icon.className = 'fa fa-circle';
            status_icon.style.color = data.stat == 2 ? '#28a745' : data.stat == 0 ? '#dc3545' : data.stat == 3 ? '#34c759' : '#ffc107';
            status_icon.style.marginLeft = '5px';
            status_icon.style.fontSize = '12px';
            status_icon.style.cursor = 'pointer';
            edit_icon.className = 'fa fa-pencil';
            edit_icon.style.color = 'blue';
            edit_icon.style.fontSize = '12px';
            edit_icon.style.cursor = 'pointer';
            edit_icon.style.marginLeft = '5px';
            edit_icon.onclick = () => {
                edit_icon.onclick = () => {
                    // Toggle between label and dropdown
                    const edit_status_dropdown = document.querySelector('.edit-status-dropdown');
                    if (edit_status_dropdown) {
                        // If dropdown exists, revert to label view
                        status_container.innerHTML = '';
                        status_container.appendChild(status_label);
                        status_container.appendChild(status_icon);
                        status_container.appendChild(edit_icon);
                    } else {
                        // If dropdown does not exist, create it
                        const edit_status_dropdown = document.createElement('select');
                        edit_status_dropdown.className = 'edit-status-dropdown';
                        status_container.innerHTML = ''; // Clear previous content
                        status_container.appendChild(edit_status_dropdown);
                        status_container.appendChild(status_icon);
                        status_container.appendChild(edit_icon);
                        // Populate dropdown with options
                        edit_status_dropdown.innerHTML = `
                            <option value="" selected>Select Status</option>
                            <option value="0">Cancelled</option>
                            <option value="1">Booking</option>
                            <option value="2">Confirmed</option>
                            <option value="3">Staying</option>
                        `;
                        edit_status_dropdown.defaultValue = data.stat; // Set default value to current status
                        // Style the dropdown
                        edit_status_dropdown.style.fontSize = '12px';
                        edit_status_dropdown.style.marginLeft = '5px';
                        edit_status_dropdown.style.padding = '2px 5px';
                        edit_status_dropdown.style.border = '1px solid #ccc';
                        edit_status_dropdown.style.borderRadius = '4px';
                        edit_status_dropdown.style.cursor = 'pointer';
                        edit_status_dropdown.style.width = '150px';
                        edit_status_dropdown.style.backgroundColor = '#f8f9fa';
                        edit_status_dropdown.style.color = '#495057';
                        edit_status_dropdown.style.transition = 'background-color 0.3s, color 0.3s';
                        edit_status_dropdown.onmouseover = function() {
                            this.style.backgroundColor = '#e9ecef';
                            this.style.color = '#212529';
                        };
                        edit_status_dropdown.onmouseout = function() {
                            this.style.backgroundColor = '#f8f9fa';
                            this.style.color = '#495057';
                        };
                        // Handle status change
                        edit_status_dropdown.onchange = function() {
                            const newStatus = this.value;
                            // status_label.textContent = `${newStatus == 1 ? 'Confirmed' : newStatus == 2 ? 'Cancelled' : 'Pending'}`;
                            status_label.textContent = `${newStatus == 0 ? 'Cancelled' : newStatus == 1 ? 'Booking' : newStatus == 2 ? 'Confirmed' : newStatus == 3 ? 'Staying' : 'Deleted'}`;
                            status_icon.style.color = newStatus == 0 ? '#dc3545' : newStatus == 1 ? '#ffc107' : newStatus == 2 ? '#34c759' : newStatus == 3 ? '#34c759' : '#ff8c00';
                            
                            // Revert back to label view
                            status_container.innerHTML = '';
                            status_container.appendChild(status_label);
                            status_container.appendChild(status_icon);
                            status_container.appendChild(edit_icon);
                        };
                    }
                }
            };
            status_container.appendChild(status_label);
            status_container.appendChild(status_icon);
            status_container.appendChild(edit_icon);

            
            
            updateDuration();
            
            // Add more fields as needed
            // Populate reservation info if needed
        });
}
//EDIT BOOKING MODEL LOAD ROOMS
async function editLoadRooms(){
    const room_response = await fetch('actions/php/edit_get_room.php');
    const rooms = await room_response.json();
    const container = document.querySelector('.edit-room-grid');
    container.innerHTML = ''; // Clear existing content
    
    const booking_id = document.getElementById('editBookingId').value;
    const booking_response = await fetch(`actions/php/get_booking_data.php?id=${booking_id}`);
    const booking_data = await booking_response.json();

    rooms.forEach(async room => {
        const label = document.createElement('label');
        label.className = 'edit-room-icon-label';
        label.style.userSelect = 'none';
        label.onmousedown = () => false;
        label.onselectstart = () => false;

        const input = document.createElement('input');
        input.type = 'checkbox';
        input.name = 'edit-selected_rooms_count';
        input.value = room.room_number;
        input.style.display = 'none';

        
        const div = document.createElement('div');
        div.className = 'edit-room-icon';
        div.title = `Room ${room.room_number}`;
        div.innerHTML = `<i class="fa fa-bed"></i><br>${room.room_number}<br><small>${room.type}</small>`;

        if (room.booked) {
            if(room.booking_id === document.getElementById('editBookingId').value){
                input.checked = true;
                input.disabled =  false;
                div.style.backgroundColor = '#e6f0ff';
                div.style.borderColor =  '#007bff';
            }
            else{
                input.checked = true;
                input.disabled =  true;
                div.style.backgroundColor = '#e6f0ff';
                div.style.borderColor =  '#ff0000';
            }
        }else{
            if (booking_data?.rooms?.includes(room.room_number)) {
                input.checked = true;
                div.style.backgroundColor = '#e6f0ff';
                div.style.borderColor =  '#007bff';
                console.log(booking_data?.selected_rooms);
            }
        }
       
        

        label.appendChild(input);
        label.appendChild(div);
        container.appendChild(label);
    });

    
    
    document.querySelectorAll('.edit-room-icon-label input[type="checkbox"]').forEach(function(checkbox) {
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

    document.querySelectorAll('.edit-room-icon-label input[type="radio"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.edit-room-icon').forEach(function(icon) {
                icon.style.borderColor = '#b0c4de';
                icon.style.background = '#f8fafc';
            });
            if (radio.checked) {
                radio.nextElementSibling.style.borderColor = '#007bff';
                radio.nextElementSibling.style.background = '#e6f0ff';
            }
        });
    });

    function toBurmeseNumber(n) {
        const burmeseDigits = ['၀','၁','၂','၃','၄','၅','၆','၇','၈','၉'];
        return String(n).split('').map(d => burmeseDigits[d] || d).join('');
    }
    function updateSelectedRoomCount() {
        const checked = document.querySelectorAll('.edit-room-icon-label input[type="checkbox"]:checked').length;
        const countDiv = document.getElementById('edit-selected-room-count');
        if (checked > 0) {
            let selectedRooms = Array.from(document.querySelectorAll('.edit-room-icon-label input[type="checkbox"]:checked')).map(cb => cb.value);
            countDiv.textContent = 'ရွေးထားသော အခန်းအရေအတွက် - ' + toBurmeseNumber(checked) + ' ခန်း (' + selectedRooms.join(', ') + ')';

            countDiv.style.color = 'green';
        } else {
            countDiv.textContent = '‌ရွေးထားသော အခန်းအရေအတွက် မရှိပါ';
            countDiv.style.color = 'red';
        }
    }
    document.querySelectorAll('.edit-room-icon-label input[type="checkbox"]').forEach(function(cb) {
        cb.addEventListener('change', updateSelectedRoomCount);
    });
    updateSelectedRoomCount();
}


//search bar logic using js
const searchFun = () =>{
    let filter = document.getElementById('search_bar').value.toUpperCase();

    let myTable = document.getElementById("table-data");

    let tr = myTable.getElementsByTagName('tr');

    for(var i = 0; i< tr.length;i++){
        let td = tr[i].getElementsByTagName('td')[1];

        if(td){
            let textvalue = td.textContent || td.innerHTML;

            if(textvalue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }

}
