$(document).on('click', '.edit-booking-btn', function() {
    var bookingId = $(this).data('booking-id');
    $.ajax({
        url: 'editbooking.php',
        type: 'GET',
        data: { booking_id: bookingId },
        dataType: 'json',
        success: function(data) {
            if (!data.error) {
                $('#editBookingModal input[name="guest_name"]').val(data.guest_name);
                $('#editBookingModal input[name="room_number"]').val(data.room_number);
                $('#editBookingModal input[name="check_in"]').val(data.check_in);
                $('#editBookingModal input[name="check_out"]').val(data.check_out);
                // ...populate other fields as needed...
                $('#editBookingModal').modal('show');
            } else {
                alert('Booking not found!');
            }
        }
    });
});