<?php

include '../../config.php';

$id = $_GET['id'];

$servicedeletesql = "DELETE FROM discount_code WHERE id = $id";

$result = mysqli_query($conn, $servicedeletesql);

header("Location:discount.php");

?>