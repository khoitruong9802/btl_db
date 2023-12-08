<?php

include '../../config.php';

$id = $_GET['id'];

$deletesql = "DELETE FROM roombookinfo WHERE id = $id";

$result = mysqli_query($conn, $deletesql);

header("Location:roombook.php");

?>