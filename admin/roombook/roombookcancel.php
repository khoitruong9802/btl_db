<?php

include '../../config.php';

$id = $_GET['id'];

$sql = "UPDATE roombookinfo SET status = 2 WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

header("Location:roombook.php");

?>