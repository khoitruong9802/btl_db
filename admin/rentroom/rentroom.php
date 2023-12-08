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

$sql = "SELECT roomrentinfo.id, roomrentinfo.checkinday, roomrentinfo.numberofchildren, roomrentinfo.numberofadult, customer.name 
FROM roomrentinfo 
JOIN roombookinfo ON roomrentinfo.book_id = roombookinfo.id 
JOIN customer ON roombookinfo.customer_id = customer.id";
$reql = mysqli_query($conn, $sql);

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
    <link rel="stylesheet" href="./rentroom.css">
    <title>BlueBird - Admin</title>
</head>

<body>
    <!-- rentroomdetailpanel -->
    <div id="rentroomdetailpanel">
        

        <!-- ==== rent room php ====-->
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
        }
        ?>
    </div>


    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
        $roombooktablesql = "SELECT * FROM roombookinfo";
        $roombookresult = mysqli_query($conn, $roombooktablesql);
        $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Rent Room Id</th>
                    <th scope="col">Checkin Date</th>
                    <th scope="col">Customer name</th>
                    <th scope="col">Children</th>
                    <th scope="col">Adult</th>
                    <th scope="col" class="action">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($reql)) {
                ?>
                    <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['checkinday'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['numberofchildren'] ?></td>
                        <td><?php echo $res['numberofadult'] ?></td>
                        <td class="action">
                            <?php
                            
                                echo "<a href='roompayment.php?id=" . $res['id'] . "'><button class='btn btn-success'>Payment</button></a>";
                            
                            ?>
                            <a href="rentroomdetail.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Detail</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./rentroom.js"></script>



</html>