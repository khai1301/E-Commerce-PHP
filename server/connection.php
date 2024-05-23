<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "E-commerce_PHP";
    $conn = mysqli_connect($servername, $username, $password, $databaseName); 
    if($conn -> connect_error) {
        die("Connect failed: ".$conn->connect_error);
    }
    

?>