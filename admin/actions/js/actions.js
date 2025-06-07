// Function to fetch bookings and update the table
// function confirmBookingBtn(phpfile, dataparam) {
//     $.getJSON(phpfile, function(data) {
//         $(`#${dataparam}`).value(data);
//     });
//     location.reload();
// }
// setInterval(fetchBookings, 3000); // Refresh every 3 seconds

// Ensure SweetAlert2 is loaded
if (typeof Swal === 'undefined') {
    const script = document.createElement('script');
    script.src = '../admin/widget/js/sweetalert.js';
    script.onload = () => console.log('SweetAlert2 loaded');
    document.head.appendChild(script);
}

function confirmBookingBtn(bookingId){
    fetch(`../admin/actions/php/booking_confirm.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: bookingId
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Optionally handle response data here
        Swal.fire({ 
            icon: data.status === 'success' ? 'success' : 'error',
            title: data.status === 'success' ? 'Booking Confirmed' : 'Error',
            text: data.message || (data.status === 'success' ? 'The booking has been confirmed!' : 'Failed to confirm booking.'),
            confirmButtonText: 'OK'
        }).then((result)=>{
            if (result.isConfirmed) {
                // Optionally, you can redirect or perform another action
                location.reload();
            }   
        })
        //location.reload();
    })
    .catch(error => {
                     
        console.error('Error:', error);
        alert(`Failed to confirm booking.${error}`);
        return JSON.stringify({"status": "error", "message": "Failed to confirm booking."});
        // Handle errors here  
    });
}

function setBookingBtn() {
    const Name = document.getElementById('nameInput').value;
    const National = document.getElementById('nationalInput').value;
    const Phone = document.getElementById('phoneInput').value;
    //const roomTypeValue = document.getElementById('roomTypeSelect').value;
    const RoomType = "Romm Type";
    //const roomNosValue = document.getElementById('roomNosInput').value;
    const RoomNosArray = Array.from(document.querySelectorAll('.room-icon-label input[type="checkbox"]:checked')).map(cb => cb.value);
    // Convert RoomNos array to JSON string
    const RoomNos = JSON.stringify(RoomNosArray);
    //const bedValue = document.getElementById('bedTypeSelect').value;
    const Bed = "Bed Type";
    const NoofRoom = document.querySelectorAll('.room-icon-label input[type="checkbox"]:checked').length;
    const Meal = document.getElementById('mealInput').value;
    const cin = document.getElementById('cinInput').value;
    const cout = document.getElementById('coutInput').value;
    alert(`${Name}, ${National}, ${Phone}, ${RoomType}, ${RoomNos}, ${Bed}, ${NoofRoom}, ${Meal}, ${cin}, ${cout}`);
    // Check for required fields before sending request
    if (!Name || !National || !Phone || !RoomType || !RoomNos || !Bed || !NoofRoom || !Meal || !cin || !cout) {
        // Find which fields are missing
        const missingFields = [];
        if (!Name) missingFields.push('Name');
        if (!National) missingFields.push('Nationality');
        if (!Phone) missingFields.push('Phone');
        if (!RoomType) missingFields.push('Room Type');
        if (!RoomNos) missingFields.push('Room Number');
        if (!Bed) missingFields.push('Bed');
        if (!NoofRoom) missingFields.push('Number of Rooms');
        if (!Meal) missingFields.push('Meal');
        if (!cin) missingFields.push('Check-in Date');
        if (!cout) missingFields.push('Check-out Date');
        alert('The following fields are required:\n' + missingFields.join(', '));
        return;
    }

    fetch(`/Hotel-Management-System/admin/actions/php/booking_set.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            Name: Name,
            National: National,
            Phone: Phone,
            RoomType: RoomType,
            RoomNos: RoomNos,
            Bed: Bed,
            NoofRoom: NoofRoom,
            Meal: Meal,
            cin: cin,
            cout: cout
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Optionally handle response data here
        console.log('Booking model data:', data);
        document.getElementById('setbookingmodel').style.display = 'none';
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Booking Successful',
        //     text: 'The booking has been set successfully!',
        //     confirmButtonText: 'OK'
        // })

        location.reload();
    })
    .catch(error => {
        console.error('Fetching Set Booking Error:', error);
        alert('Failed to fetch booking model data.', cin);
    });
}
