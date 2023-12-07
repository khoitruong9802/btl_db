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
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./customer.css">
    <title>BlueBird - Admin</title>
</head>

<body>
    <!-- customerdetailpanel -->

    <div id="customerdetailpanel">
        <form action="" method="POST" class="customerdetailpanelform">
            <div class="head">
                <h3>customer</h3>
                <i class="fa-solid fa-circle-xmark" onclick="addcustomerclose()"></i>
            </div>
            <div class="middle">
                <div class="customerinfo">
                    <h4>customer information</h4>
                    <input type="text" name="Name" placeholder="Enter customer name" required>
                    <input type="text" name="CMND" placeholder="Enter CMND" required>
                    <input type="text" name="Gender" placeholder="Enter gender" required>
                    <input type="text" name="Address" placeholder="Enter address" required>
                    <input type="text" name="Country" placeholder="Enter country" required>
                </div>

            </div>
            <div class="footer">
                <button class="btn btn-success" name="customerdetailsubmit">Submit</button>
            </div>
        </form> 

        <!-- ==== room book php ====-->
        <?php       
            if (isset($_POST['customerdetailsubmit'])) {
                $Name = $_POST['Name'];
                $CMND = $_POST['CMND'];
                $Gender = $_POST['Gender'];
                $Address = $_POST['Address'];
                $Country = $_POST['Country'];

                if (false) {
                    echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
                }
                else{
                    $sta = "NotConfirm";
                    $sql = "INSERT INTO customer(name,cmnd,gender,address,country) VALUES ('$Name','$CMND','$Gender','$Address','$Country')";
                    $result = mysqli_query($conn, $sql);

                    // if($f1=="NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Superior Room is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($f2=="NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'customer House is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($f3 == "NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Si Room is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($f4 == "NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Deluxe Room is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($result = mysqli_query($conn, $sql))
                    // {
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
        <button class="adduser" id="adduser" onclick="addcustomeropen()"><i class="fa-solid fa-bookmark"></i> Add</button>
        <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form>
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $roombooktablesql = "SELECT * FROM `customer`";
            $roombookresult = mysqli_query($conn, $roombooktablesql);
            $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">CMND</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Country</th>
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
                    <td><?php echo $res['gender'] ?></td>
                    <td><?php echo $res['address'] ?></td>
                    <td><?php echo $res['country'] ?></td>
                    <td class="action">
                        <a href="customeredit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                        <a href="customerdelete.php?id=<?php echo $res['id'] ?>"><button class='btn btn-danger'>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./customer.js"></script>



</html>
