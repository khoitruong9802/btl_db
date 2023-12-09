<?php
    include '../../config.php';

    $id = $_GET["id"];

    $sql ="SELECT assignroom.room_id
    FROM assignroom
    INNER JOIN roombookinfo ON assignroom.order_id = roombookinfo.id WHERE roombookinfo.id = $id;";

    $result = mysqli_query($conn,$sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>