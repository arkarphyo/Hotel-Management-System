// Function to fetch bookings and update the table
// function confirmBookingBtn(phpfile, dataparam) {
//     $.getJSON(phpfile, function(data) {
//         $(`#${dataparam}`).value(data);
//     });
//     location.reload();
// }
// setInterval(fetchBookings, 3000); // Refresh every 3 seconds

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
        location.reload();
    })
    .catch(error => {
                     
        console.error('Error:', error);
        alert('Failed to confirm booking.');
        return JSON.stringify({"status": "error", "message": "Failed to confirm booking."});
        // Handle errors here  
    });
}

function setBookingBtn(Name, National, Phone, RoomType, RoomNos, Bed, NoofRoom, Meal, cin, cout) {
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
    })
    .catch(error => {
        console.error('Fetching Set Booking Error:', error);
        alert('Failed to fetch booking model.');
    });
}
