<?php 
    include('connection.php');
    $sql = "SELECT * FROM products where product_category = 'coat' ";
    $result = $conn->query($sql);

?>