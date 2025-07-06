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
    fetch('actions/php/get_booking_info.php?id=' + bookingId)
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


            
            
            updateDuration();
            
            // Add more fields as needed
            // Populate reservation info if needed
        });
}
//EDIT BOOKING MODEL LOAD ROOMS
async function editLoadRooms(){
    const response = await fetch('actions/php/edit_get_room.php');
    const rooms = await response.json();
    const container = document.querySelector('.edit-room-grid');
    container.innerHTML = ''; // Clear existing content

    

    rooms.forEach(room => {
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
            if(room.booking_id === `${document.getElementById('editBookingId').value}`){
                input.checked = true;
                div.style.backgroundColor = '#e6f0ff';
                div.style.borderColor =  '#007bff';
            }else{
                input.disabled =  true;
                div.querySelector('i').style.color = '#b0c4de';
                div.querySelector('small').style.color =  '#b0c4de';
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
