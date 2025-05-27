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