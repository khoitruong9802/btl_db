<?php 
include '../../../config.php';


function deleteCustomer($id) {
    $customerdeletesql = "CALL delete_customer(". $id .")";

    $result = mysqli_query($conn, $customerdeletesql);
    return $result;
}


?>