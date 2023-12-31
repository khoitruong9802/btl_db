<?php

include '../../config.php';

// fetch room data
$id = $_GET['id'];

$sql ="Select * from customer where id = '$id'";
$re = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($re))
{
    $Name = $row['name'];
    $CMND = $row['cmnd'];
    $Gender = $row['gender'];
    $Address = $row['address'];
    $Country = $row['country'];
    // $Birthday = $row['birthday'];
}

if (isset($_POST['guestdetailedit'])) {
    $Name = $_POST['Name'];
    $CMND = $_POST['CMND'];
    $Gender = $_POST['Gender'];
    $Address = $_POST['Address'];
    $Country = $_POST['Country'];
    // $Birthday = $_POST['Birthday'];

    $sql = "UPDATE customer SET name = '$Name',cmnd = '$CMND',gender='$Gender',address='$Address',country='$Country' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (true) {
            header("Location:customer.php");
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
        #editpanel{
            position : fixed;
            z-index: 1000;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            background-color: #00000079;
        }
        #editpanel .guestdetailpanelform{
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
                <a href="./customer.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Customer information</h4>
                    <input type="text" name="Name" placeholder="Enter customer name" value="<?php echo $Name ?>">
                    <input type="text" name="CMND" placeholder="Enter CMND" value="<?php echo $CMND ?>">
                    <select name="Gender" class="form-control selectinput" required>
                        <option value selected>Gender</option>
                        <option value=0 <?php echo $Gender == 0 ? 'selected' : '' ?>>Male</option>
                        <option value=1 <?php echo $Gender == 1 ? 'selected' : '' ?>>Female</option>
                        <option value=2 <?php echo $Gender == 2 ? 'selected' : '' ?>>Other</option>
                    </select>
                    <input type="text" name="Address" placeholder="Enter address" value="<?php echo $Address ?>">
                    <input type="text" name="Country" placeholder="Enter country" value="<?php echo $Country ?>">
                    <!-- <input type="date" name="Birthday" value="<?php echo $Birthday ?>" required> -->

                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="guestdetailedit">Edit</button>
            </div>
        </form>
    </div>
</body>
</html>