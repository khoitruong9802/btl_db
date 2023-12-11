<?php
    include '../../config.php';

    $sql ="SELECT assignroom.room_id, roombookinfo.echeckinday, roombookinfo.echeckoutday
    FROM assignroom
    INNER JOIN roombookinfo ON assignroom.order_id = roombookinfo.id WHERE roombookinfo.status <> 2;";

    $result = mysqli_query($conn,$sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>