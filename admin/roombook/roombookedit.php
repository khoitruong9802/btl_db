<?php

include '../../config.php';

$sql = "SELECT room.id, room.roomnumber, room.roomtype, roomtype.name
FROM room
INNER JOIN roomtype ON room.roomtype = roomtype.id WHERE room.status = 1";
$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $room_arr[] = $row;
    }
}

// fetch room data
$id = $_GET['id'];

$sql = "Select * from roombookinfo where id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $CustomerID = $row['customer_id'];
    $Checkin = $row['echeckinday'];
    $Checkout = $row['echeckoutday'];
    $Bookday = $row['bookday'];
    $NumberChild = $row['numberofchildren'];
    $NumberAdult = $row['numberofadult'];
    $StaffID = 1;
    $Status = 1;
}

if (isset($_POST['roombookdetailedit'])) {
    $CustomerID = $_POST['CustomerID'];
    $Checkin = $_POST['Checkin'];
    $Checkout = $_POST['Checkout'];
    $Bookday = $_POST['Bookday'];
    $NumberChild = $_POST['NumberChild'];
    $NumberAdult = $_POST['NumberAdult'];
    $StaffID = 1;
    $Status = 1;

    $sql = "UPDATE roombookinfo SET status = '$Status',echeckinday = '$Checkin',echeckoutday='$Checkout',bookday='$Bookday'
    ,numberofchildren = '$NumberChild',numberofadult='$NumberAdult',customer_id='$CustomerID',staff_id='$StaffID' WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    if (true) {
        header("Location:roombook.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../css/roombook.css">
    <style>
        #editpanel {
            position: fixed;
            z-index: 1000;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            background-color: #00000079;
        }

        #editpanel .guestdetailpanelform {
            height: 620px;
            width: 1170px;
            background-color: #ccdff4;
            border-radius: 10px;
            /* temp */
            position: relative;
            top: 20px;
            animation: guestinfoform .3s ease;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div id="editpanel">
        <form method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>EDIT SERVICE</h3>
                <a href="./service.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Book information</h4>
                    <select name="CustomerID" class="selectinput" required>
                        <option value selected>Select customer</option>
                        <?php
                        foreach ($customer_arr as $key => $value) :
                            echo '<option value="' . $value["id"] . '">' . $value["name"] . " - " . $value["cmnd"] . '</option>';
                        //close your tags!!
                        endforeach;
                        ?>
                    </select>
                    <div class="datesection">
                        <span>
                            <label for="Checkin"> Check-In</label>
                            <input id="checkinday" name="Checkin" type="date" onchange="search_room()">
                        </span>
                        <span>
                            <label for="Checkout"> Check-Out</label>
                            <input id="checkoutday" name="Checkout" type="date" onchange="search_room()">
                        </span>
                        <input type="date" id="hiddenDateInput" name="Bookday" hidden>
                    </div>
                    <input type="text" name="NumberChild" placeholder="Enter the number of children" required>
                    <input type="text" name="NumberAdult" placeholder="Enter the number of adult" required>
                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Add room</h4>
                    <select class="selectinput" id="room-type-selected" onchange="search_room()">
                        <option value="-1" selected>All room</option>
                        <?php
                        foreach ($type_of_room_arr as $key => $value) :
                            echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                        //close your tags!!
                        endforeach;
                        ?>
                    </select>
                    <div id="display-list-room" style="overflow: auto;">
                        <?php
                        foreach ($room_arr as $key => $value) :
                            echo '<input type="checkbox" class="btn-check' . ' hideroom type' . $value["roomtype"] . '" id="cbroom' . $value["id"] . '" name="room' . $value["id"] . '" autocomplete="off">';
                            echo '<label class="btn btn-outline-danger' . ' hideroom type' . $value["roomtype"] . '" id="lbroom' . $value["id"] . '" for="cbroom' . $value["id"] . '" room' . $value["id"] . '>P.' . $value["roomnumber"] . '</label>';
                        //close your tags!!
                        endforeach;
                        ?>

                    </div>

                </div>

            </div>
            <div class="footer">
                <button class="btn btn-success" name="roombookdetailedit">Edit</button>
            </div>
        </form>
    </div>
</body>

</html>