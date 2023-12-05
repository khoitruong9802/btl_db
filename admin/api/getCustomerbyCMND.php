<?php
    include '../../config.php';

    $CMND = $_GET['id'];
    $sql ="Select * from customer where cmnd = '$CMND'";
    $re = mysqli_query($conn,$sql);

    // $num_rows = mysqli_num_rows($re);

    // if ($num_rows == 0) {
    //     echo "Khong co ket qua phu hop";
    // } else {
    //     while($row=mysqli_fetch_array($re)){
    //         print_r($row);
    //     }
    // }

    if ($re->num_rows > 0) {
        $row = $re->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No matching record found.']);
    }
?>