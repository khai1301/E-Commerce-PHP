<?php 
    include('connection.php');
    session_start();
    if(!isset($_SESSION['logged_in'])) {
        header('location: ../checkout.php?message=Please login or register to place an order');
        exit;
    } else {
        if(isset($_POST['place_order'])) {
            //store user info
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $total = $_SESSION['total'];
            $status = "not paid";
            $user_id = $_SESSION['user_id'];
            $order_date = date('Y-m-d H:i:s');
    
            $sql = "INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                    VALUES ($total, '$status', $user_id, $phone, '$city', '$address', '$order_date')";
            $stmt = $conn -> query($sql);
            $order_id = $conn -> insert_id;
            
            //get cart
            foreach($_SESSION['cart'] as $key => $product) {
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_image = $product['product_image'];
                $product_price = $product['product_price'];
                $product_quantity = $product['product_quantity'];
                $sql = "INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                        VALUES ($order_id, $product_id, '$product_name', '$product_image', $product_price, $product_quantity, $user_id, '$order_date')";
                $stmt = $conn -> query($sql);
            }
            if($stmt){
                header('location: ../payment.php?order_status=order placed successfully');
    
            } else {
                echo "failed";
            }
        }
    }
?>