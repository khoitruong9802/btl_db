<?php

include '../../config.php';

// fetch room data
$id = $_GET['id'];

$sql = "SELECT c.name, c.cmnd FROM roombookinfo AS r
        INNER JOIN customer AS c ON r.customer_id = c.id WHERE r.id = $id";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $CustomerName = $row['name'];
    $CustomerCMND = $row['cmnd'];
}

if (isset($_POST['checkinsubmit'])) {
    $Checkin = $_POST['Checkin'];
    $NumberChild = $_POST['NumberChild'];
    $NumberAdult = $_POST['NumberAdult'];
    $BookID = $id;
    $StaffID = 1;

    $sql = "INSERT INTO roomrentinfo(checkinday,numberofchildren,numberofadult,book_id,staff_id) 
    VALUES ('$Checkin','$NumberChild','$NumberAdult','$BookID','$StaffID')";

    $result = mysqli_query($conn, $sql);

    $sql = "UPDATE roombookinfo SET status = 1 WHERE id = '$id'";
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
                <h3>CHECK IN</h3>
                <a href="./roombook.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Confirm information</h4>
                    <input type="text" value="Name: <?php echo $CustomerName ?> - CMND: <?php echo $CustomerCMND ?>" readonly>
                    <input id="CheckInDay" name="Checkin" type="date" hidden>
                    <input id="display-checkinday" type="text" value="" readonly>
                    <input type="text" name="NumberChild" placeholder="Enter the number of children" required>
                    <input type="text" name="NumberAdult" placeholder="Enter the number of adult" required>
                </div>

            </div>
            <div class="footer">
                <button class="btn btn-success" name="checkinsubmit">Check In</button>
            </div>
        </form>
    </div>
    <script>
        let today = new Date();
        let formattedDate = today.toISOString().split('T')[0];
        document.getElementById("CheckInDay").value = formattedDate;
        document.getElementById("display-checkinday").value = "Check In Day: " + formattedDate;
    </script>
</body>

</html>