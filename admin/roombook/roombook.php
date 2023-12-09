<?php
session_start();
include '../../config.php';

$sql = "SELECT id, name, cmnd FROM customer";
$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $customer_arr[] = $row;
    }
}

$sql = "SELECT id, name FROM roomtype";
$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $type_of_room_arr[] = $row;
    }
}

$sql = "SELECT room.id, room.roomnumber, room.roomtype, roomtype.name
FROM room
INNER JOIN roomtype ON room.roomtype = roomtype.id WHERE room.status = 1";
$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $room_arr[] = $row;
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
    <link rel="stylesheet" href="./roombook.css">
    <title>BlueBird - Admin</title>
</head>

<body>
    <!-- guestdetailpanel -->
    <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>RESERVATION</h3>
                <i class="fa-solid fa-circle-xmark" onclick="roombookclose()"></i>

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
                    <select class="selectinput" id="room-type-selected" onchange="search_room_type()">
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
                        foreach ($room_arr as $key => $value):
                            echo '<input type="checkbox" class="btn-check' . ' hideroom type' . $value["roomtype"] . '" id="cbroom' . $value["id"] . '" name="room' . $value["id"] . '" autocomplete="off">';
                            echo '<label class="btn btn-outline-danger' . ' hideroom type' . $value["roomtype"] . '" id="lbroom' . $value["id"] . '" for="cbroom' . $value["id"] . '" room' . $value["id"] . '>P.' . $value["roomnumber"] . '</label>';
                        //close your tags!!
                        endforeach;
                        ?>
                        
                    </div>

                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="booking_submit">Submit</button>
            </div>
        </form>

        <!-- ==== room book php ====-->
        <?php
        if (isset($_POST['booking_submit'])) {

            $CustomerID = $_POST['CustomerID'];
            $Checkin = $_POST['Checkin'];
            $Checkout = $_POST['Checkout'];
            $Bookday = $_POST['Bookday'];
            $NumberChild = $_POST['NumberChild'];
            $NumberAdult = $_POST['NumberAdult'];
            $StaffID = 1;
            $Status = 1;

            if (false) {
                // Check data
                echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
            } else {
                $sql = "INSERT INTO roombookinfo(status,echeckinday,echeckoutday,bookday,numberofchildren,numberofadult,customer_id,staff_id) 
                VALUES ('$Status','$Checkin','$Checkout','$Bookday','$NumberChild','$NumberAdult','$CustomerID','$StaffID')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<script>swal({
                                title: 'Reservation successful',
                                icon: 'success',
                            });
                        </script>";
                } else {
                    echo "<script>swal({
                                    title: 'Something went wrong',
                                    icon: 'error',
                                });
                        </script>";
                }
            }
            $sql = 
            'SELECT AUTO_INCREMENT
            FROM information_schema.TABLES
            WHERE TABLE_SCHEMA = "bluebirdhotel"
            AND TABLE_NAME = "roombookinfo"';
            $result = mysqli_query($conn, $sql);
            $book_id_index = $result->fetch_assoc();
            $book_id_index = $book_id_index["AUTO_INCREMENT"] - 1;

            $room_list = array(); 
            foreach ($_POST as $room => $value) {
                if (substr($room, 0, 4) == "room") {
                    $room_list[] = (int)substr($room, 4);
                }
            }
            $sql = "INSERT INTO assignroom(order_id, room_id) VALUES";
            foreach ($room_list as $value) {
                $sql .= "('$book_id_index','$value'),";
            }
            $sql = substr($sql, 0, -1);
            $result = mysqli_query($conn, $sql);
        }
        ?>
    </div>

    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button class="adduser" id="adduser" onclick="roombookopen()"><i class="fa-solid fa-bookmark"></i> Add</button>
        <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form>
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
        $roombooktablesql = "SELECT r.*, c.name, c.cmnd FROM roombookinfo AS r 
                            INNER JOIN customer AS c ON r.customer_id = c.id";
        $roombookresult = mysqli_query($conn, $roombooktablesql);
        $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Customer</th>
                    <th scope="col">CMND</th>
                    <!-- <th scope="col">Staff id</th> -->
                    <th scope="col">Check in</th>
                    <th scope="col">Check out</th>
                    <th scope="col">Bookday</th>
                    <th scope="col">Children</th>
                    <th scope="col">Adult</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="action">Action</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($roombookresult)) {
                ?>
                    <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['cmnd'] ?></td>
                        <td><?php echo $res['echeckinday'] ?></td>
                        <td><?php echo $res['echeckoutday'] ?></td>
                        <td><?php echo $res['bookday'] ?></td>
                        <td><?php echo $res['numberofchildren'] ?></td>
                        <td><?php echo $res['numberofadult'] ?></td>
                        <td><?php echo $res['status'] ?></td>
                        <td class="action">
                            <a href="roomcheckin.php?id=<?php echo $res['id'] ?>"><button style="display: inline;" class="btn btn-success">Check In</button></a>
                            <a href="roombookedit.php?id=<?php echo $res['id'] ?>"><button style="display: inline;" class="btn btn-primary">Edit</button></a><br>
                            <a href="roombookcancel.php?id=<?php echo $res['id'] ?>"><button style="display: inline;" class='btn btn-warning'>Cancel</button></a>
                            <a href="roombookdelete.php?id=<?php echo $res['id'] ?>"><button style="display: inline;" class='btn btn-danger'>Delete</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./roombook.js"></script>



</html>