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
    <!-- boot -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="../dist/font-awesome/css/all.min.css"/>
	<!-- css for table and search bar -->
	<link rel="stylesheet" href="css/roombook.css">

</head>
<body>
	<div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $paymanttablesql = "SELECT * FROM payment";
            $paymantresult = mysqli_query($conn, $paymanttablesql);

            $nums = mysqli_num_rows($paymantresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Bed Type</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check In</th>
					<th scope="col">No of Day</th>
                    <th scope="col">No of Room</th>
					<th scope="col">Meal Type</th>
                    <th scope="col">Room Rent</th>
                    <th scope="col">Bed Rent</th>
                    <th scope="col">Meals</th>
					<th scope="col">Total Bill</th>
                    <th scope="col">Action</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
            <?php
            while ($res = mysqli_fetch_array($paymantresult)) {
            ?>
                <tr>
                    <td><?php echo $res['id'] ?></td>
                    <td><?php echo $res['Name'] ?></td>
                    <td><?php echo $res['RoomType'] ?></td>
                    <td><?php echo $res['Bed'] ?></td>
					<td><?php echo $res['cin'] ?></td>
                    <td><?php echo $res['cout'] ?></td>
					<td><?php echo $res['noofdays'] ?></td>
                    <td><?php echo $res['NoofRoom'] ?></td>
                    <td><?php echo $res['meal'] ?></td>
                    <td><?php echo $res['roomtotal'] ?></td>
					<td><?php echo $res['bedtotal'] ?></td>
					<td><?php echo $res['mealtotal'] ?></td>
					<td><?php echo $res['finaltotal'] ?></td>
                    <td class="action">
                        <a href="invoiceprint.php?id= <?php echo $res['id']?>"><button class="btn btn-primary"><i class="fa-solid fa-print"></i>Print</button></a>
						<a href="paymantdelete.php?id=<?php echo $res['id']?>"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>

<script>
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

</script>

</html>