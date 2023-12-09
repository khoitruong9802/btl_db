<?php

include '../../config.php';

$id = $_GET['id'];

$servicedeletesql = "DELETE FROM pay_method WHERE id = $id";

$result = mysqli_query($conn, $servicedeletesql);

header("Location:paymethod.php");

?>