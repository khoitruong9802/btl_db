<?php
include '../models/indexModel.php';

$action = $_GET['action'];

if ($action === 'deleteCustomer') {
    deleteAction();
}
function deleteAction() {
    $id = $_GET['id'];
    
    deleteCustomer($id);
    
    // header("Location:customer.php");
}


?>