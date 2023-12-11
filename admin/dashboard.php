<?php
session_start();
include '../config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Database hotel - Admin</title>
</head>

<body>

    <!-- ================================================= -->
    <div class="searchsection">
        <input type="date" name="begin-date" id="begin-date" onchange="search_number_service()">
        <input type="date" name="end-date" id="end-date" onchange="search_number_service()">
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Service name</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>

            <tbody id="display-service-num">
            </tbody>
        </table>
    </div>
</body>
<script src="./javascript/dashboard.js"></script>



</html>