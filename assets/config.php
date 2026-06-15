<?php
    $server = "localhost";
   
    $user = "root";
    $password = "";
    $db = "school_sms";
    
    $conn = mysqli_connect($server, $user, $password, $db);

    if (!$conn) {
        header('Location: ../errors/error.html');
        exit();
    }


?>