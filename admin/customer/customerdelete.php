<?php

include '../../config.php';

$id = $_GET['id'];

$customerdeletesql = "DELETE FROM customer WHERE id = $id";

$result = mysqli_query($conn, $customerdeletesql);

header("Location:customer.php");

?>