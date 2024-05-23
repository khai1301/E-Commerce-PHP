<?php
    include('server/connection.php');
    if(isset($_POST['order_detail_btn']) && isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];
        $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $order_details = $stmt->get_result();

        $total_order = calTotal($order_details);
    } else {
        header('location: account.php');
        exit;
    }

    function calTotal($order_details) {
        $total=0;
        foreach($order_details as $row) {
            $product_price = $row['product_price'];
            $product_quantity = $row['product_quantity'];
            $total += $product_price*$product_quantity;
        }
        return $total;
    }
?>
<?php include('layouts/header.php') ?>
    <!-- orders -->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
            <h2 class="font-weight-bolde text-center">Your Orders</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php foreach($order_details as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image'] ?>" alt="">
                            <div class="">
                                <p class="mt-3"><?php echo $row['product_name'] ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span><?php echo $row['product_price'] ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['product_quantity'] ?></span>
                    </td>
                </tr>
            <?php } ?>

        </table>
        <?php if($order_status == "not paid") { ?>
            <form action="payment.php" method="POST" style="float: right;">
                <input type="hidden" name="total_order" value="<?php echo $total_order ?>" id="">
                <input type="hidden" name="order_status" value="<?php echo $order_status ?>" id="">
                <input type="hidden" name="order_id" value="<?php echo $order_id ?>" id="">
                <input type="submit" class="btn btn-primary" name="order_pay_btn" value="Pay now" id="">
            </form>
        <?php } ?>


    </section>
    <!-- footer -->
    <?php include('layouts/footer.php') ?>