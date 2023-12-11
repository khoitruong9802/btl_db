<?php
    include '../../config.php';

    $data = json_decode(file_get_contents("php://input"));

    $sql = "CALL total_service_use('$data->begin_date', '$data->end_date')";

    $result = mysqli_query($conn,$sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>