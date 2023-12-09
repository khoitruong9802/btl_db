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
    <link rel="stylesheet" href="./discount.css">
    <title>BlueBird - Admin</title>
</head>

<body>
    <!-- discountdetailpanel -->

    <div id="discountdetailpanel">
        <form action="" method="POST" class="discountdetailpanelform">
            <div class="head">
                <h3>discount</h3>
                <i class="fa-solid fa-circle-xmark" onclick="adddiscountclose()"></i>
            </div>
            <div class="middle">
                <div class="discountinfo">
                    <h4>discount information</h4>
                    <input type="number" name="salepercent" placeholder="Enter salepercent (0-100)" required>
                    <input type="number" name="maxsale" placeholder="Enter maxsale" required>
                    <input type="date" name="expiredate" placeholder="Enter expiredate" required>
                </div>

            </div>
            <div class="footer">
                <button class="btn btn-success" name="discountdetailsubmit">Submit</button>
            </div>
        </form> 

        <!-- ==== room book php ====-->
        <?php       
            if (isset($_POST['discountdetailsubmit'])) {
                $salepercent = $_POST['salepercent'];
                $maxsale = $_POST['maxsale'];
                $expiredate = $_POST['expiredate'];

                if ($salepercent < 0 || $salepercent > 100) {
                    echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
                }
                else{
                    $sql = "INSERT INTO discount_code(salepercent,maxsale,expiredate) VALUES ('$salepercent','$maxsale','$expiredate')";
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
        <button class="adduser" id="adduser" onclick="adddiscountopen()"><i class="fa-solid fa-bookmark"></i> Add</button>
        <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form>
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $roombooktablesql = "SELECT * FROM `discount_code`";
            $roombookresult = mysqli_query($conn, $roombooktablesql);
            $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Sale Percent</th>
                    <th scope="col">Max sale</th>
                    <th scope="col">Expire date</th>
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
                    <td><?php echo $res['salepercent'] ?></td>
                    <td><?php echo $res['maxsale'] ?></td>
                    <td><?php echo $res['expiredate'] ?></td>
                    <td class="action">
                        <a href="discountedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                        <a href="discountdelete.php?id=<?php echo $res['id'] ?>"><button class='btn btn-danger'>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
<script src="discount.js"></script>



</html>