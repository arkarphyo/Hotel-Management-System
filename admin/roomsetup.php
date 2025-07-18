<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/all.css"/>
    <script src="../assets/font-awesome/js/pro.min.js"></script>
    <!-- Bootstrap -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="javascript/roomSetup.js"></script>
    <script src="actions/js/actions.js"></script>
    <link rel="stylesheet" href="css/room.css">
</head>

<body>

    <div class="room">

        <div style="margin:50px;" id="roomContainer" class=".gridroom" ></div>
        <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <label for="search" style="color:white;"><i class="fa-solid fa-search" style="margin-right:10px; color:white;"></i>Search Room No:</label>
                        <input type="search" class="form-control" id="search" placeholder="Search by room no" onchange="searchRoom()">
                    </div>
                    <div class="col">
                        <label for="roomFilterStatus" style="color:white;"><i class="fa-solid fa-filter" style="margin-right:10px;"></i>Room Status:</label>
                        <select class="form-select" id="roomFilterStatus" onchange="filterRoom()">
                            <option value="">All</option>
                            <option value="1">Staying</option>
                            <option value="0">Not Staying</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="roomFilterType" style="color:white"><i class="fa-solid fa-filter" style="margin-right:10px;"></i>Room Type:</label>
                        <select class="form-select" id="roomFilterType" onchange="filterRoom()">
                            <option value="">All</option>
                            <?php
                                $sql = "SELECT * FROM roomtype";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                    }
                                } else {
                                    echo '<option value="">No room types available</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- <div class="col px-3">
                <button class="btn btn-primary"  type="button" onclick="addEditBed('')">Add Bed</button>
            </div> -->
            <div class="col px-3">
                <button class="btn btn-primary" type="button"  onclick="createOpenModel('roomModal');">Add Room</button>
            </div>  
        </nav>
        

        <!-- Create FormModal -->
        <div class="modal show" id="roomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: none; padding-right: 15px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="createCloseModel('roomModal');"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="roomno" class="form-label">Room No  <span  style="color:red;">(Required)</span></label>
                                <input type="text" class="form-control" id="roomno" name="roomno" placeholder="Room No" required>
                            </div>
                            <div class="mb-3">
                                <label for="roomtype" class="form-label">Room Type  <span style="color:red;">(Required)</span></label>
                                <select class="form-select" id="roomtype" name="roomtype" required>
                                    <option value="">Select Room Type</option>
                                    <?php
                                    $sql = "SELECT * FROM roomtype";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bedtype" class="form-label">Bed Type  <span style="color:red;">(Required)</span></label>
                                <select class="form-select" id="bedtype" name="bedtype" required>
                                    <option value="">Select Bed</option>
                                    <?php
                                    $sql = "SELECT * FROM bedtype";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            
                            <div class="mb-3">
                                <label for="extrabed" class="form-label">Extra Bed Type  <span style="color:red;">(Required)</span></label>
                                <select class="form-select" id="extrabed" name="extrabed" required>
                                    <option value="0">None</option>
                                    <?php
                                    $sql = "SELECT * FROM bedtype";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="roomprice" class="form-label">Room Price  <span style="color:red;">(Required)</span></label>
                                <input type="number" class="form-control" id="roomprice" name="roomprice" placeholder="Room Price" min="0" step="0.01" oninput="this.value = Math.abs(this.value)" required>

                            </div>
                            
                            <div class="mb-3">
                                <label for="roomcapacity" class="form-label">Room Capacity</label>
                                <input type="number" class="form-control" id="roomcapacity" name="roomcapacity" placeholder="Room Capacity" min="1" step="1">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="createRoom();">Add Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

                                
        <!-- Edit FormModal -->
        <div class="modal show" id="editRoomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: none; padding-right: 15px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="createCloseModel('editRoomModal');"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="editroomid" name="editroomid" placeholder="Room ID" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="editroomno" class="form-label">Room No  <span  style="color:red;">(Required)</span></label>
                                <input type="text" class="form-control" id="editroomno" name="editroomno" placeholder="Room No" required>
                            </div>
                            <div class="mb-3">
                                <label for="roomtype" class="form-label">Room Type  <span style="color:red;">(Required)</span></label>
                                <select class="form-select" id="editroomtype" name="editroomtype" required>
                                    <option value="">Select Room Type</option>
                                    <?php
                                    $sql = "SELECT * FROM roomtype";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editbedtype" class="form-label">Bed Type  <span style="color:red;">(Required)</span></label>
                                <select class="form-select" id="editbedtype" name="edutbedtype" required>
                                    <option value="">Select Bed</option>
                                    <?php
                                    $sql = "SELECT * FROM bedtype";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            
                            <div class="mb-3">
                                <label for="editextrabed" class="form-label">Extra Type  <span style="color:red;">(Required)</span></label>
                                <select class="form-select" id="editextrabed" name="editextrabed" required>
                                    <option value="0">None</option>
                                    <?php
                                    $sql = "SELECT * FROM bedtype";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="editroomprice" class="form-label">Room Price  <span style="color:red;">(Required)</span></label>
                                <input type="number" class="form-control" id="editroomprice" name="editroomprice" placeholder="Room Price" min="0" step="0.01" oninput="this.value = Math.abs(this.value)" required>

                            </div>
                            <div class="mb-3">
                                <label for="editroomcapacity" class="form-label">Room Capacity</label>
                                <input type="number" class="form-control" id="editroomcapacity" name="rooeditroomcapacitymcapacity" placeholder="Room Capacity" min="1" step="1">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="editRoom();">Add Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </div>
     <script>
        //GET ROOM
         getRoomData();
        //SEARCH ROOM
         searchRoom = () => {
            let search = document.getElementById("search").value;
            let url = "actions/php/search_room.php";
            if(search == '') {
                getRoomData();
            }else{
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    search: search
                })
            })
                .then(response => response.json())
                .then(data => {
                    let roomContainer = document.getElementById("roomContainer");
                    roomContainer.innerHTML = '';
                    data.forEach(async room => {
                       const type = room.type;
                  let boxClass = 'roombox';
                  let iconClass = '';
                  let tag = 'p';
                  
                  switch (type) {
                      case '1':
                          boxClass += ' roomboxsuperior';
                          iconClass = 'fa fa-bed-front fa-4x mb-2 ';
                          break;
                      case '2':
                          boxClass += ' roomboxdelux';
                          iconClass = 'fa fa-bed-front fa-4x mb-2';
                          break;
                      case '3':
                          boxClass += ' roomboguest';
                          iconClass = 'fa fa-bed-front fa-4x mb-2';
                          break;
                      case '4':
                          boxClass += ' roomboxsingle';
                          iconClass = 'fa fa-bed fa-4x mb-2';
                          break;
                      default:
                          return; // Skip unknown types
                  }
                  
                
                  
                
                const roomBox = document.createElement('div');
                roomBox.className = boxClass;
                roomBox.style.position = 'relative';
                roomBox.style.backgroundColor = room.status == 1 ? '#FFFFFF' : '#DDDDDD';
                roomBox.style.border = room.status == 1 ? '1px solid #34C759' : '1px solid #ccc';
                roomBox.addEventListener('mouseover', function() {
                    roomBox.style.transform = 'scale(1.05)';
                    roomBox.style.cursor = 'pointer';
                });
                roomBox.addEventListener('mouseleave', function(){
                    roomBox.style.transform = 'scale(1)';
                    roomBox.style.pointer = 'none';
                })

                roomBox.addEventListener('click', function() {
                    createOpenModel('editRoomModal');
                    document.getElementById('editroomid').value = room.id;
                    document.getElementById('editroomno').value = room.room_number;
                    document.getElementById('editroomtype').value = room.type;
                    document.getElementById('editbedtype').value = room.bedding;
                    document.getElementById('editroomprice').value = room.price;
                    document.getElementById('editroomcapacity').value = room.capacity;
                    document.getElementById('editextrabed').value = room.extra_bed;
                });
                // Create the info icon
                const infoIcon = document.createElement('i');
                    infoIcon.className = 'fa-solid fa-info-circle info-icon';
                    infoIcon.style.position = 'absolute';
                    infoIcon.style.top = '10px';
                    infoIcon.style.right = '10px';
                    infoIcon.style.cursor = 'pointer';
                    infoIcon.style.backgroundColor = 'transparent';
                // Create the info span
                const spanInfo = document.createElement('span');
                    spanInfo.className = 'info-text';
                    spanInfo.textContent = 'Room Information';
                // Create the info div
                const spanDiv = document.createElement('div');
                    spanDiv.className = 'info-container';
                    spanDiv.style.display = 'none';
                    spanDiv.style.backgroundColor = 'white';
                    spanDiv.style.border = '1px solid #ccc';
                    spanDiv.style.borderRadius = '5px';
                    spanDiv.style.padding = '10px';
                    spanDiv.style.zIndex = '1';
                    spanDiv.style.position = 'absolute';
                    spanDiv.appendChild(spanInfo);

                        // Create the staying info div
                        const stayingDiv = document.createElement('div');
                            stayingDiv.className = 'staying-info';
                            stayingDiv.textContent = room.status == 1 ? 'Staying' : 'Not Staying';
                            stayingDiv.border = '1px solid #ccc';
                            stayingDiv.style.position = 'absolute';
                            stayingDiv.style.top = '0px';
                            stayingDiv.style.left = '0px';
                            stayingDiv.style.padding = '5px 10px';
                            stayingDiv.style.borderTopLeftRadius = '12px';
                            stayingDiv.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.2)';
                            stayingDiv.style.backgroundColor = room.status == 1 ? '#34C759' : 'gray';
                            stayingDiv.style.color = '#FFF';
                            stayingDiv.style.textShadow = '1px 1px 2px rgba(0, 0, 0, 0.3)';
                            stayingDiv.style.fontSize = '12px';

                            


                        const extraBed = room.extra_bed != 0 ? ` + ${room.extra_bed_name}` : '';
                        infoIcon.addEventListener('click', (event) => {
                            spanDiv.style.display = 'block';
                            spanDiv.style.position = 'absolute';
                            spanDiv.style.top = event.clientY + 'px';
                            spanDiv.style.left = event.clientX + 'px';

                        });

                        //Check Out Button
                        const editButton = document.createElement('button');
                            editButton.className = 'btn btn-primary checkout-btn';
                            editButton.setAttribute('type', 'button');
                            editButton.textContent = 'Edit Room';
                            editButton.style.position = 'absolute';
                            editButton.style.bottom = '5px';
                            editButton.style.right = '10px';
                            editButton.style.left = '8%';
                            editButton.style.transform = 'translateX(-50%)';
                            editButton.style.border = "none";
                            // Optional: Also remove focus ring
                            editButton.style.outline = "none";
                            editButton.style.boxShadow = "none";
                            editButton.addEventListener('mousedown', function(e) {
                                const x = e.clientX - e.target.offsetLeft;
                                const y = e.clientY - e.target.offsetTop;
                                const ripple = document.createElement('span');
                                ripple.className = 'ripple';
                                ripple.style.width = e.target.offsetWidth + 'px';
                                ripple.style.left = x + 'px';
                                ripple.style.top = y + 'px';
                                e.target.appendChild(ripple);
                                setTimeout(() => ripple.remove(), 500);
                            });

                            roomBox.addEventListener('mouseenter', () => {    
                                roomBox.style.transform = 'scale(1.05)';
                                roomBox.style.animation = 'shake 0.5s ease-in-out';
                                  editButton.style.transition = 'all 0.1s ease-in-out';
                                editButton.style.opacity = '0';
                                editButton.style.transform = 'translateY(10px)';
                                setTimeout(() => {
                                    editButton.style.opacity = '1';
                                    editButton.style.transform = 'translateY(0px)';
                                }, 50);
                                
                                editButton.onclick = () => {
                                    // Add your checkout logic here
                                    console.log(`Checking out room: ${room.room_number}`);
                                };

                                roomBox.appendChild(editButton);
                            });

                            roomBox.addEventListener('mouseleave', () => {
                                roomBox.style.transform = 'scale(1)';
                                roomBox.style.animation = 'none';
                                const editButton = roomBox.querySelector('.checkout-btn');
                                if (editButton) {
                                    roomBox.removeChild(editButton);
                                }
                            });

                        
                        roomBox.innerHTML = `
                            <div class='text-center no-boder '>
                                <i style="color: ${room.type == 1 ? '#FADEAG' : room.type == 2 ? 'blue' : room.type == 3 ? 'red' : 'green'};" class='${iconClass}' ></i>
                                <${tag} style="background-color: black; border-radius: 10px; color: #fff;">${room.room_number}</${tag}>
                                <h3>${room.roomtype_name}</h3>
                                <div class='mb-1'>${room.bed_name} <i>${extraBed} </i></div>
                                ${infoIcon.outerHTML}
                            </div>
                        `; 

                        roomBox.appendChild(stayingDiv);
                        roomContainer.appendChild(spanDiv);
                        roomContainer.appendChild(roomBox);
                    });

                });
            }
         }
        //CREATE ROOM
         createRoom = () => {
            let roomno = document.getElementById("roomno").value;
            let roomtype = document.getElementById("roomtype").value;
            let bedtype = document.getElementById("bedtype").value;
            let extrabed = document.getElementById("extrabed").value;
            let roomprice = document.getElementById("roomprice").value;
            if(roomno==""||roomtype==""||bedtype==""||roomprice==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill all the fields',
                }).then((result) => {
                    if (result.isConfirmed) {
                    }
                });
            }else{ 
                fetch("actions/php/create_room.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        roomno: document.getElementById("roomno").value,
                        roomtype: document.getElementById("roomtype").value,
                        bedtype: document.getElementById("bedtype").value,
                        extrabed: document.getElementById("extrabed").value,
                        roomprice: document.getElementById("roomprice").value,
                        roomcapacity: document.getElementById("roomcapacity").value
                    })
                }).then((response) => response.json()).then((data) => {
                    if (data.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Room added successfully',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                            }            
                    });
                }
                });
            }
         };
        //EDIT ROOM
         editRoom = () => {
            let id = document.getElementById("editroomid").value;
            let roomno = document.getElementById("editroomno").value;
            let roomtype = document.getElementById("editroomtype").value;
            let bedtype = document.getElementById("editbedtype").value;
            let extrabed = document.getElementById("editextrabed").value;
            let roomprice = document.getElementById("editroomprice").value;
            if(id==""||roomno==""||roomtype==""||bedtype==""||roomprice==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill required field. Some data missing!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }else{ 
                fetch("actions/php/edit_room.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        id: document.getElementById("editroomid").value,
                        roomno: document.getElementById("editroomno").value,
                        roomtype: document.getElementById("editroomtype").value,
                        bedtype: document.getElementById("editbedtype").value,
                        extrabed: document.getElementById("editextrabed").value,
                        roomprice: document.getElementById("editroomprice").value,
                        roomcapacity: document.getElementById("editroomcapacity").value
                    })
                }).then((response) => response.json()).then((data) => {
                    if (data.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Room updated successfully',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                            }            
                    });
                }
                });
            }
         };

         
      </script>
</body>
 

</html>
