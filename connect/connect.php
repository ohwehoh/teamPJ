<?php
    $host = "localhost";
    $user = "ohwehoh";
    $pass = "rtras3yw^^";
    $db = "ohwehoh";
    $connect = new mysqli($host, $user, $pass, $db);
    $connect -> set_charset("utf8");

    if(mysqli_connect_errno()){
        //echo "DATABASE Connect False";
    } else {
        //echo "DATABASE Connect True";
    }
?>