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

        <div style="margin:20px;" id="roomContainer" class=".gridroom" ></div>

        <button style="position: absolute; top: 10px; right: 10px;" class="btn btn-primary" onclick="createOpenModel('roomModal');">Add Room</button>

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
                                <label for="bedtype" class="form-label">Room Type  <span style="color:red;">(Required)</span></label>
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
                                <label for="bedtype" class="form-label">Room Type  <span style="color:red;">(Required)</span></label>
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
                                <label for="roomprice" class="form-label">Room Price  <span style="color:red;">(Required)</span></label>
                                <input type="number" class="form-control" id="roomprice" name="roomprice" placeholder="Room Price" min="0" step="0.01" oninput="this.value = Math.abs(this.value)" required>

                            </div>
                            <div class="mb-3">
                                <label for="roomcapacity" class="form-label">Room Capacity</label>
                                <input type="number" class="form-control" id="roomcapacity" name="roomcapacity" placeholder="Room Capacity" min="1" step="1">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="updateRoom();">Add Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </div>
     <script> 
         getRoomData();
         createRoom = () => {
            let roomno = document.getElementById("roomno").value;
            let roomtype = document.getElementById("roomtype").value;
            let bedtype = document.getElementById("bedtype").value;
            let roomprice = document.getElementById("roomprice").value;
            if(roomno==""||roomtype==""||bedtype==""||roomprice==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill all the fields',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
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
                                location.reload();
                            }            
                    });
                }
                });
            }
         };
      </script>
</body>
 

</html>
