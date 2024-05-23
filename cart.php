<?php
    session_start();
    include('server/connection.php');
    if(isset($_POST['add_to_cart'])){
        //if user has already add product to cart
        if(isset($_SESSION['cart'])) {
            $product_arr_ids =  array_column($_SESSION['cart'], "product_id");
            if( !in_array($_POST['product_id'], $product_arr_ids)) {
                //the first of this product in cart
                $product_id = $_POST['product_id'];
                $product_arr = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity']
                );

                $_SESSION['cart'][$product_id] = $product_arr;
            } else {
                //has this product in cart
                echo '<script>alert("product has already in cart")</script>';
            }

        } else {
            //if this is first cart
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];
            $productArr = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );
            $_SESSION['cart'][$product_id] = $productArr;

        }
        calTotal();
    }else if(isset($_POST['remove_product'])) {
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
        calTotal();
    }else if(isset($_POST['edit_quantity'])){
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];
        $product_arr = $_SESSION['cart'][$product_id];
        $product_arr['product_quantity'] = $product_quantity;
        $_SESSION['cart'][$product_id] = $product_arr;
        calTotal();
    } else {
        // header('location: single_product.php');
    }
    function calTotal() {
        $total=0;
        foreach($_SESSION['cart'] as $key => $product) {
            $quantity = $product['product_quantity'];
            $price = $product['product_price'];
            $total += $quantity * $price;
        }
        $_SESSION['total'] = $total;
    }
    // session_destroy();
?>
<?php include('layouts/header.php') ?>
    <!-- Cart -->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach($_SESSION['cart'] as $key => $product) { ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $product['product_image'] ?>" alt="">
                        <div>
                            <p><?php echo $product['product_name'] ?></p>
                            <small><span>$</span><?php echo $product['product_price'] ?></small>
                            <br>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>" id="">
                                <input type="submit" href="" name="remove_product" class="remove-btn" value="Remove">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="cart.php" method="POST">
                        <input type="number" value="<?php echo $product['product_quantity'] ?>" name="product_quantity" id="">
                        <input type="hidden" value="<?php echo $product['product_id'] ?>" name="product_id" id="">
                        <input type="submit" value="Edit" name="edit_quantity" href="" class="edit-btn">
                    </form>
                </td>
                <td>
                    <span>$</span>
                    <span class="productPrice"><?php echo $product['product_price']*$product['product_quantity'] ?></span>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td class="totalPrice">$ <?php echo $_SESSION['total'] ?></td>
                </tr>
            </table>
        </div>
        <div class="checkout-container">
            <form action="checkout.php" method="POST">
                <input type="submit" name="checkout" value="Checkout" class="btn checkout-btn">
            </form>
        </div>
    </section>
    <!-- footer -->
<?php include('layouts/footer.php') ?>