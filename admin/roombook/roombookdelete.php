<?php

include '../../config.php';

$id = $_GET['id'];

$deletesql = "DELETE FROM assignroom WHERE order_id = $id;
                DELETE FROM roombookinfo WHERE id = $id";

            
$result = mysqli_multi_query($conn, $deletesql);

header("Location:roombook.php");

?>