<?php

include '../../config.php';

// fetch room data
$id = $_GET['id'];

if (isset($_POST['addservice'])) {

    $service_id = $_POST['servicename'];
    $numberofservice = $_POST['numberservice'];
    $payment = $_POST['paymentstatus'];
    $current_date = date("Y-m-d");
    $staff_id = 1;



    $sql = "INSERT INTO serviceuseinfo(useday, rent_id, staff_id, payment_status) VALUES ('$current_date','$id', '$staff_id','$payment')";

    $insert_service = mysqli_query($conn, $sql);


    $sql =
        'SELECT AUTO_INCREMENT
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = "bluebirdhotel"
        AND TABLE_NAME = "serviceuseinfo"';
    $result = mysqli_query($conn, $sql);
    $serviceinfo_id = $result->fetch_assoc();
    $serviceinfo_id = $serviceinfo_id["AUTO_INCREMENT"] - 1;

    $sql = "INSERT INTO serviceuse(serviceuse_id, service_id, numberofservice) VALUES ('$serviceinfo_id','$service_id','$numberofservice')";

    $equal = mysqli_query($conn, $sql);

    if ($equal) {
        // header("Location: rentroomdetail.php");
    } else {
        // Check data
        echo "<script>swal({
                title: 'Fill the proper details',
                icon: 'error',
            });
            </script>";
    }
}

$sql = "SELECT roomrentinfo.checkinday, roomrentinfo.numberofchildren, roomrentinfo.numberofadult, customer.name, room.roomnumber 
FROM roomrentinfo 
JOIN roombookinfo ON roomrentinfo.book_id = roombookinfo.id 
JOIN customer ON roombookinfo.customer_id = customer.id 
JOIN assignroom ON roombookinfo.id = assignroom.order_id
JOIN room ON assignroom.room_id = room.id
WHERE roomrentinfo.id = '$id'";

$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $rentroom_arr[] = $row;
    }
}


$sql = "SELECT * FROM service";
$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $service_arr[] = $row;
    }
}


$sql = "SELECT service.name, service.cost, serviceuse.numberofservice, serviceuseinfo.payment_status
FROM roomrentinfo
JOIN serviceuseinfo ON serviceuseinfo.rent_id = roomrentinfo.id
JOIN serviceuse ON serviceuse.serviceuse_id = serviceuseinfo.id
JOIN service ON serviceuse.service_id = service.id
WHERE roomrentinfo.id = '$id'";

$list_service_arr = mysqli_query($conn, $sql);

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
    <link rel="stylesheet" href="rentroom.css">
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

        #editpanel .rentroomdetailpanelform {
            height: 620px;
            width: 1170px;
            background-color: #ccdff4;
            border-radius: 10px;
            /* temp */
            position: relative;
            top: 20px;
            animation: rentroominfoform .3s ease;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div id="editpanel">
        <form method="POST" class="rentroomdetailpanelform">

            <div class="head">
                <h3>EDIT RESERVATION</h3>
                <a href="./rentroom.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>

            <div class="middle">
                <div class="rentroominfo">
                    <h4>Services</h4>
                    <div class="addroomsection">
                        <form action="" method="POST">
                            <div class="d-flex flex-row align-items-center">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row align-items-center">
                                        <label class="mx-2" for="bed">Service: </label>
                                        <select name="servicename" class="form-control selectinput" required>
                                            <option value selected></option>
                                            <?php
                                            foreach ($service_arr as $key => $value) :
                                                echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                                            //close your tags!!
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <label class="mx-2" for="troom">Number: </label>
                                        <input type="text" name="numberservice" class="form-control" required>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <label class="mx-2" for="troom">Payment status: </label>
                                        <select name="paymentstatus" class="form-control selectinput" required>
                                            <option value selected>Payment</option>
                                            <option value=1>True</option>
                                            <option value=0>False</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mx-2" name="addservice" style="border-radius: 20px; height:fit-content">Add Service</button>
                            </div>
                        </form>
                    </div>
                    <div style="overflow: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Service</th>
                                    <th scope="col">Unit price</th>
                                    <th scope="col">Num</th>
                                    <th scope="col">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($res = mysqli_fetch_array($list_service_arr)) {
                                ?>
                                    <tr>
                                        <td><?php echo $res['name'] ?></td>
                                        <td><?php echo $res['cost'] ?></td>
                                        <td><?php echo $res['numberofservice'] ?></td>
                                        <td><?php echo $res['payment_status'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Rent Room Details</h4>
                    <div>
                        <h5>Customer: <?php echo $rentroom_arr[0]['name'] ?></h5>
                        <h5>Check in day: <?php echo $rentroom_arr[0]['checkinday'] ?> </h5>
                        <h5>Room:<?php foreach ($rentroom_arr as $key => $value) :
                                        echo '<label class="btn btn-outline-danger">' . $value["roomnumber"] . '</label>';
                                    endforeach; ?> </h5>
                    </div>
                </div>

            </div>
        </form>
    </div>
</body>

</html>