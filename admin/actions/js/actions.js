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

// Confirm booking function
function confirmBookingBtn(bookingId){
    Swal.fire({
        title: 'Confirm Booking',
        text: "Are you sure you want to confirm this booking?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm it!'
    }).then((result) => {
        if (result.isConfirmed) { 
            // Call the function to confirm the booking
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
        }})
}

// Cancel booking function
function cancelBookingBtn(bookingId){
    Swal.fire({
        title: 'Deleted Booking',
        text: "Are you sure you want to delete this booking?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) { 
            // Call the function to confirm the booking
            fetch(`../admin/actions/php/booking_delete.php`, {
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
            title: data.status === 'success' ? `#ID ${bookingId}: Booking deleted` : 'Error',
            text: data.message || (data.status === 'success' ? 'The booking has been deleted!' : 'Failed to confirm booking.'),
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
        alert(`Failed to delete booking.${error}`);
        return JSON.stringify({"status": "error", "message": "Failed to delete booking."});
        // Handle errors here  
    });
        }})
}


// Set booking button function
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
    const Meal = document.getElementById('mealInput').checked ? 1 : 0;
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

    fetch('../admin/actions/php/booking_set.php', {
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
        Swal.fire({
            icon: 'success',
            title: 'Booking Successful',
            text: 'The booking has been set successfully!',
            confirmButtonText: 'OK'
        }).then((result) => {
            // Optionally, you can redirect or perform another action
            // For example, reload the page to see the updated bookings
            if (result.isConfirmed) {
             location.reload();
            }
        });

    })
    .catch(error => {
        console.error('Fetching Set Booking Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `Failed to set booking model data. ${error}`,
            confirmButtonText: 'OK'
        })
        alert('Failed to fetch booking model data.', cin);
    });
}
