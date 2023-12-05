<?php
session_start();
include '../../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="room.css">
</head>

<body>
    <div id="roomdetailpanel">
        <form action="" method="POST" class="roomdetailpanelform">
            <div class="head">
                <h3>Room Information</h3>
                <i class="fa-solid fa-circle-xmark" onclick="addroomclose()"></i>
            </div>
            <div class="middle">
                <div class="roominfo">
                    <input type="text" name="RoomNumber" placeholder="Enter room number" required>
                    <input type="text" name="Floor" placeholder="Enter Floor" required>
                    <input type="text" name="RoomType" placeholder="Enter Type Room" required>
                </div>

            </div>
            <div class="footer">
                <button class="btn btn-success" name="roomdetailsubmit">Submit</button>
            </div>
        </form>

        <!-- ==== room book php ====-->
        <?php
        if (isset($_POST['roomdetailsubmit'])) {

            // Hard code
            $RoomNumber = $_POST['RoomNumber'];
            $Floor = $_POST['Floor'];
            $RoomType = $_POST['RoomType'];
            $Status = false;
            if (false) {
                echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
            } else {
                $sta = "NotConfirm";
                $sql = "INSERT INTO room(status,roomnumber,floor, roomtype) VALUES ('$Status','$RoomNumber','$Floor','$RoomType')";
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
                // }
            }
        }
        ?>
    </div>


    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button class="adduser" id="adduser" onclick="addroomopen()"><i class="fa-solid fa-bookmark"></i> Add</button>
        <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form>
    </div>


    <div class="room">
        <?php
        $sql = "select * from room";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
            $status = $row['status'] ? "Available" : "Not Available";
            $id = $row['roomtype'];
            if ($id == 0) {
                echo "<div class='roombox roomboxsuperior'>
						<div class='text-center no-boder'>
                            <i class='fa-solid fa-bed fa-4x mb-2'></i>
							<h3>" . $row['roomtype'] . "</h3>
                            <div class='mb-1'>" . $status . "</div>
                            <a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>
						</div>
                    </div>";
            } else if ($id == 1) {
                echo "<div class='roombox roomboxdelux'>
                        <div class='text-center no-boder'>
                        <i class='fa-solid fa-bed fa-4x mb-2'></i>
                        <h3>" . $row['roomtype'] . "</h3>
                        <div class='mb-1'>" . $status . "</div>
                        <a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>
                    </div>
                    </div>";
            } else if ($id == 2) {
                echo "<div class='roombox roomboguest'>
                <div class='text-center no-boder'>
                <i class='fa-solid fa-bed fa-4x mb-2'></i>
							<h3>" . $row['roomtype'] . "</h3>
                            <div class='mb-1'>" . $status . "</div>
                            <a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>
					</div>
            </div>";
            } else if ($id == 3) {
                echo "<div class='roombox roomboxsingle'>
                        <div class='text-center no-boder'>
                        <i class='fa-solid fa-bed fa-4x mb-2'></i>
                        <h3>" . $row['roomtype'] . "</h3>
                        <div class='mb-1'>" . $status . "</div>
                        <a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a>
                    </div>
                    </div>";
            }
        }
        ?>
    </div>
    <script src="./room.js"></script>

</body>

</html>