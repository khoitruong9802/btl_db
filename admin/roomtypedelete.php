<?php

include '../config.php';

$id = $_GET['id'];

$roomtypedeletesql = "DELETE FROM roomtype WHERE id = $id";

$result = mysqli_query($conn, $roomtypedeletesql);

header("Location:roomtype.php");

?>