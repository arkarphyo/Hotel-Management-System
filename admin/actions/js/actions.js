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
    
    // alert(`${Name}, ${National}, ${Phone}, ${RoomType}, ${RoomNos}, ${Bed}, ${NoofRoom}, ${Meal}, ${cin}, ${cout}`);
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
        Swal.fire({ 
            icon: 'error',
            title: 'Error',
            text: `Please fill in all required fields: ${missingFields.join(', ')}`,
            confirmButtonText: 'OK'
        })
        return;
    }
    //alert(`Booking Details:\nName: ${Name}\nNationality: ${National}\nPhone: ${Phone}\nRoom Type: ${RoomType}\nRoom Numbers: ${RoomNos}\nBed Type: ${Bed}\nNumber of Rooms: ${NoofRoom}\nMeal: ${Meal ? 'Yes' : 'No'}\nCheck-in Date: ${cin}\nCheck-out Date: ${cout}`);
    // Check if the URL exists before sending the request

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
            cout: cout,
            stat: 1
        })
    })
    .then(response => {
        if (!response.ok) {
            // Try to get error message from response
            return response.text().then(text => {
                throw new Error(`Network response was not ok. Status: ${response.status}. Message: ${text}`);
            });
        }
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.indexOf('application/json') !== -1) {
            return response.json();
        } else {
            throw new Error('Invalid response format (not JSON)');
        }
    })
    .then(data => {
        // Log the response for debugging
        try {
            console.log('Booking set response:', data);
            document.getElementById('setbookingmodel').style.display = 'none';
            Swal.fire({
                icon: data.status === 'success' ? 'success' : 'error',
                title: data.status === 'success' ? 'Booking Successful' : 'Error',
                text: data.message || (data.status === 'success' ? 'The booking has been set successfully!' : 'Failed to set booking.'),
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        } catch (e) {
            console.error('Error handling booking set response:', e);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing the booking response.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Failed to set booking.',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    });
    
}

function editBookingBtn(){
    swal.fire({
        title: 'Edit Booking',
        text: "Are you sure you want to edit this booking?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, edit it!'
    }).then((result) => {
        if (result.isConfirmed) {
            //location.reload();
            // Check for required fields before sending request
        }
    });
   
}

// Show booking info function
function setupInfoBtn(id) {
    // You can fetch more details from the server if needed
    // For now, just show the ID in a SweetAlert
    // Fetch check-in date from server for the given booking id
    fetch(`../admin/actions/php/get_booking_data.php?id=${encodeURIComponent(id)}`)
        .then(response => response.json())
        .then(data => {
            const cinDate = data.cin || '';
            const coutDate = data.cout || '';
            Swal.fire({
                title: 'Setup Check-In Info',
                width: '40%',
                heightAuto: false, // Prevents auto height
                backdrop: 'rgba(0,0,0,0.5)',
                showCloseButton: true,
                showConfirmButton: true,
                showClass: {
                    popup: 'swal2-show',
                    backdrop: 'swal2-backdrop-show' 
                },
                customClass: {
                    popup: 'swal2-popup-custom-height'
                },
                html: `
                    <style>
                        .swal2-popup-custom-height {
                            height: 600px !important;
                            max-height: 80vh !important;
                            overflow-y: auto;
                        }
                        .swal2-form {
                            display: grid;
                            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                            gap: 16px;
                        }
                        .swal2-form .form-group {
                            display: flex;
                            flex-direction: column;
                        }
                        .swal2-form .form-group label {
                            font-weight: 500;
                            margin-bottom: 4px;
                        }
                        .swal2-form .swal2-input, 
                        .swal2-form select, 
                        .swal2-form textarea {
                            border-radius: 6px;
                            border: 1px solid #d1d5db;
                            padding: 8px 10px;
                            font-size: 1rem;
                            background: #f9fafb;
                            transition: border-color 0.2s;
                        }
                        .swal2-form .swal2-input:focus, 
                        .swal2-form select:focus, 
                        .swal2-form textarea:focus {
                            border-color: #3085d6;
                            outline: none;
                            background: #fff;
                        }
                        @media (max-width: 600px) {
                            .swal2-form {
                                grid-template-columns: 1fr;
                                gap: 8px;
                            }
                        }
                    </style>
                    <form id="checkinInfoForm" class="swal2-form">
                            <input type="text" id="bookingId" class="swal2-input" placeholder="ID" autocomplete="off" value="${id}" hidden>
                        <div class="form-group">
                            <label for="guestName">Name</label>
                            <input type="text" id="guestName" class="swal2-input" placeholder="Enter name" autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="fatName">Father's Name</label>
                            <input type="text" id="fatName" class="swal2-input" placeholder="Enter father's name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="guestAge">Age</label>
                            <input type="number" id="guestAge" class="swal2-input" placeholder="Enter age" min="0" autocomplete="bday">
                        </div>
                        <div class="form-group">
                            <label for="guestGender">Gender</label>
                            <input type="text" id="guestGender" class="swal2-input" placeholder="Male, Female, Other" list="genderList" autocomplete="sex">
                            <datalist id="genderList">
                                <option value="Male">
                                <option value="Female">
                                <option value="Other">
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="nrcNo">NRC No</label>
                            <input type="text" id="nrcNo" class="swal2-input" placeholder="Enter NRC number" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="work">Work</label>
                            <input type="text" id="work" class="swal2-input" placeholder="Enter occupation" autocomplete="organization-title">
                        </div>
                        <div class="form-group">
                            <label for="indate">Check-In Date</label>
                            <input type="date" id="indate" class="swal2-input" autocomplete="off" value="${cinDate}">
                        </div>
                        <div class="form-group">
                            <label for="outdate">Check-Out Date</label>
                            <input type="date" id="outdate" class="swal2-input" autocomplete="off" value="${coutDate}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" class="swal2-input" placeholder="Enter address" autocomplete="street-address" rows="2" style="resize:vertical"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea id="remark" class="swal2-input" placeholder="Enter remark" autocomplete="off" rows="2" style="resize:vertical"></textarea>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                focusConfirm: false,
                preConfirm: () => {
                    const bookingId = id;
                    const guestName = document.getElementById('guestName').value;
                    const fatName = document.getElementById('fatName').value;
                    const guestAge = document.getElementById('guestAge').value;
                    const guestGender = document.getElementById('guestGender').value;
                    const nrcNo = document.getElementById('nrcNo').value;
                    const work = document.getElementById('work').value;
                    const indate = document.getElementById('indate').value;
                    const outdate = document.getElementById('outdate').value;
                    const address = document.getElementById('address').value;
                    const remark = document.getElementById('remark').value;
                    if (!guestName || !fatName || !guestAge || !guestGender || !nrcNo || !work || !indate || !outdate || !address || !remark) {
                        Swal.showValidationMessage('Please fill all fields');
                        return false;
                    }
                    return { bookingId,guestName, fatName, guestAge, guestGender, nrcNo, work, indate, outdate, address, remark };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // You can handle the form data here
                    console.log('Check-In Info:', result.value);
                    fetch('../admin/actions/php/checkin_info_set.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            booking_id: result.value.bookingId,
                            name: result.value.guestName,
                            fat_name: result.value.fatName,
                            age: result.value.guestAge,
                            gender: result.value.guestGender,
                            nrc_no: result.value.nrcNo,
                            work: result.value.work,
                            indate: result.value.indate,
                            outdate: result.value.outdate,
                            address: result.value.address,
                            remark: result.value.remark
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status !== 'success') {
                            Swal.fire('Error', data.message || `Failed to save check-in info. ${data.booking_id}`, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error saving check-in info:', error);
                        Swal.fire('Error', 'Failed to save check-in info.', 'error');
                    });
                    Swal.fire('Saved!', 'Check-in info has been updated.', 'success').then(() => {
                        location.reload(); // Reload the page to reflect changes
                    });
                    
                }
            });
        })
        .catch(() => {
            Swal.fire('Error', 'Failed to fetch check-in date.', 'error');
        });
    
}

function editBookingSaveBtn() {
    const bookingId = document.getElementById('editBookingId').value;
    const Name = document.getElementById('editNameInput').value;
    const National = document.getElementById('editNationalInput').value;
    const Phone = document.getElementById('editPhoneInput').value;
    //const roomTypeValue = document.getElementById('roomTypeSelect').value;
    const RoomType = "Romm Type";
    //const roomNosValue = document.getElementById('roomNosInput').value;
    const RoomNosArray = Array.from(document.querySelectorAll('.edit-room-icon-label input[type="checkbox"]:checked')).map(cb => cb.value);
    // Convert RoomNos array to JSON string
    const RoomNos = JSON.stringify(RoomNosArray);
    //const bedValue = document.getElementById('bedTypeSelect').value;

    const Bed = "Bed Type";
    const NoofRoom = document.querySelectorAll('.edit-room-icon-label input[type="checkbox"]:checked').length;
    const Meal = document.getElementById('editMealInput').checked ? 1 : 0;
    const cin = document.getElementById('editCinInput').value;
    const cout = document.getElementById('editCoutInput').value;
    const stat = document.querySelector('.edit_booking_status_label').textContent.trim(); // Get the status from the label, default to 'Pending'
    const saveData = JSON.stringify({
        bookingId: bookingId,
        name: Name,
        national: National,
        phone: Phone,
        room_type: RoomType,
        room_nos: RoomNos,
        bed: Bed,
        noof_room: NoofRoom,
        meal: Meal,
        cin: cin,
        cout: cout,
        stat: stat == 'Booking' ? 1 : stat == 'Cancelled' ? 0 : stat == 'Confirmed' ? 2 : stat == 'Staying' ? 3 : 0
        
    });
    
    fetch('../admin/actions/php/booking_edit.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: saveData
    }).then(response => {
        if (!response.ok) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update booking. Please try again later.',
                confirmButtonText: 'OK'
            });
            throw new Error('Network response was not ok');
        }else{
            return response.json();
        }
    }).then(data => {
        // Handle the response data
        console.log('Booking edit response:', data);
        if(data.status === 'success'){
            Swal.fire({
                icon: 'success',
                title: 'Booking Updated',
                text: 'The booking has been updated successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload(); // Reload the page to reflect changes
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Failed to update booking. ${data.message}`,
                confirmButtonText: 'OK'
            }).then((confirm) => {
                if (confirm) {
                }
            });
        }}).catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `Failed to update booking. ${error.message}`,
            confirmButtonText: 'OK'
        });
    });
    // Check if the URL exists before sending the request
}

// Validate check-in info form
function validateCheckinInfoForm() {
    const form = document.getElementById('checkinInfoFrom');
    if (!form) return false;

    let missingFields = [];
    // Loop through all input/select/textarea elements
    Array.from(form.elements).forEach(el => {
        if (
            (el.tagName === 'INPUT' || el.tagName === 'SELECT' || el.tagName === 'TEXTAREA') &&
            el.type !== 'button' && el.type !== 'submit' && el.type !== 'reset' &&
            !el.disabled && el.required !== false
        ) {
            if (!el.value || (el.type === 'checkbox' && !el.checked)) {
                missingFields.push(el.name || el.id || 'Unnamed field');
            }
        }
    });

    if (missingFields.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `Please fill in all required fields: ${missingFields.join(', ')}`,
            confirmButtonText: 'OK'
        });
        return false;
    }
    return true;
}

// Example usage: attach to form submit
// const checkinForm = document.getElementById('checkinInfoFrom');
// if (checkinForm) {
//     checkinForm.addEventListener('submit', function(e) {
//         if (!validateCheckinInfoForm()) {
//             e.preventDefault();
//         }
//     });
// }
