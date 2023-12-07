<?php

include '../../config.php';

$id = $_GET['id'];

$servicedeletesql = "DELETE FROM service WHERE id = $id";

$result = mysqli_query($conn, $servicedeletesql);

header("Location:service.php");

?>