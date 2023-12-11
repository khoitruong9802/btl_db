<?php

include '../../config.php';

$sql = "SELECT * FROM pay_method";
$re = mysqli_query($conn, $sql);

if (mysqli_num_rows($re) > 0) {
    while ($row = mysqli_fetch_assoc($re)) {
        $paymethod_arr[] = $row;
    }
}

// fetch room data
$id = $_GET['id'];

$sql = "SELECT room_payment($id) AS result";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $subtotal_cost = $row['result'];
}

if (isset($_POST['payment-action'])) {
    $Checkout = $_POST['Checkout'];
    $extra = $_POST['extra'];
    $vat = $_POST['vat'];
    $subtotal = $_POST['subtotal'];
    $total = $_POST['total'];
    $discount = NULL;
    $paymethod = $_POST['paymethod'];
    $recept_id = 1;

    $sql = "INSERT INTO `bill` (`checkoutday`, `extra`, `vat`, `subtotal`, `total`, `rentid`, `discountcode`, `paymethod_id`, `recept_id`) 
    VALUES ('$Checkout', '$extra', '$vat', '$subtotal', '$total', '$id', NULL, '$paymethod', '$recept_id')";
    $paymentresult = mysqli_query($conn, $sql);

    if ($paymentresult) {
            header("Location:rentroom.php");
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
                <h3>PAYMENT</h3>
                <a href="./rentroom.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Payment information</h4>
                    <input type="text" value="Rent room id: <?php echo $id ?>" readonly>
                    <input type="number" name="extra" id="extra-cost" placeholder="Enter extra cost" onchange="caculate_total_cost()" required>
                    <input type="number" name="vat" id="vat-cost" placeholder="Enter VAT cost" onchange="caculate_total_cost()" required>
                    <input type="text" name="discount" id="discount-code" placeholder="Enter discount code" onchange="caculate_total_cost()">
                    <select name="paymethod" class="selectinput" required>
                        <option value selected>Select payment method</option>
                        <?php
                        foreach ($paymethod_arr as $key => $value) :
                            echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                        //close your tags!!
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Cost</h4>
                    <label for="checkoutday">Check out day</label>
                    <input id="checkoutday" name="Checkout" type="date" readonly>
                    <label for="subtotal-payment">Subtotal</label>
                    <input type="number" id="subtotal-payment" name="subtotal" value="<?php echo $subtotal_cost?>" readonly>
                    <label for="subtotal-payment">Total</label>
                    <input type="number" id="total-payment" name="total" value="<?php echo $subtotal_cost?>" readonly>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="payment-action">Confirm</button>
            </div>
        </form>
    </div>
    <script src="./rentroom.js"></script>
</body>
</html>