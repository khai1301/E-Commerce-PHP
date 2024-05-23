<?php
    include('connection.php');
    $sql = "SELECT * FROM products LIMIT 4";
    $result = $conn->query($sql);
?>