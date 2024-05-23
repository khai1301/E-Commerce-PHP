<?php
    session_start();
    if(isset($_POST['order_pay_btn'])) {
        $order_status = $_POST['order_status'];
        $total_order = $_POST['total_order'];
    }
?>
<?php include('layouts/header.php') ?>
    <!-- Checkout -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
            <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
                <?php $amount = strval($_SESSION['total']) ?>
                <p>Total: <?php echo "$".$_SESSION['total']?></p>
                <!-- <input type="submit" name="payment" class="btn btn-primary" value="Pay Now" id=""> -->
                <!-- <div id="paypal-button-container"></div> -->
                <form action="vnpayPayment.php" method="POST">
                    <input type="hidden" value="<?php echo $_POST['order_id'] ?>" name="order_id" id="">
                    <input type="hidden" name="amount" value="<?php echo $_SESSION['total']?>" id="">
                    <input type="submit" name="redirect" value="Thanh toán VNPay"   class="btn btn-primary" id="">
                </form>
   
            <?php } else if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
                <?php $amount = strval($total_order) ?>
                <p>Total: <?php echo "$".$total_order?></p>
                <!-- <input type="submit" name="payment" class="btn btn-primary" value="Pay Now" id=""> -->
                <!-- <div id="paypal-button-container"></div> -->
                <form action="vnpayPayment.php" method="POST">
                    <input type="submit" name="redirect" class="btn btn-primary" value="Thanh toán VNPay" id="">
                </form>
            <?php } else {?>
                <p>You don't have an order now</p>
                <?php } ?>
            
        </div>
    </section>
    <!-- paypal -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=ARQLejzr1M3Kz_4HgHcnnotguHzbBf7ACJ81bpe26H64_IsELbXzzkSYjSYUk6jQ2SRQ6MVIHIG5UJL6&currency=USD"></script>
    
    <script>
        window.paypal.Buttons({
            async createOrder() {
                try {
                    const response = await fetch("/api/orders", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    // use the "body" param to optionally pass additional order information
                    // like product ids and quantities
                    body: JSON.stringify({
                        cart: [
                        {
                            id: "YOUR_PRODUCT_ID",
                            quantity: "YOUR_PRODUCT_QUANTITY",
                        },
                        ],
                    }),
                    });
                    
                    const orderData = await response.json();
                    
                    if (orderData.id) {
                    return orderData.id;
                    } else {
                    const errorDetail = orderData?.details?.[0];
                    const errorMessage = errorDetail
                        ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                        : JSON.stringify(orderData);
                    
                    throw new Error(errorMessage);
                    }
                } catch (error) {
                    console.error(error);
                    resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                }
            },
            async onApprove(data, actions) {
                try {
                const response = await fetch(`/api/orders/${data.orderID}/capture`, {
                    method: "POST", headers: {
                    "Content-Type": "application/json",
                    },
                });
                const orderData = await response.json();
                // Three cases to handle:
                //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                //   (2) Other non-recoverable errors -> Show a failure message
                //   (3) Successful transaction -> Show confirmation or thank you message
                const errorDetail = orderData?.details?.[0];
                if(errorDetail?.issue === "INSTRUMENT_DECLINED") {
                // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                // recoverable state, per https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                return actions.restart();
                } else if(errorDetail) {
                // (2) Other non-recoverable errors -> Show a failure message
                throw new Error(`${errorDetail.description} (${orderData.debug_id})`);
                } else if(!orderData.purchase_units) {
                throw new Error(JSON.stringify(orderData));
                } else {
                // (3) Successful transaction -> Show confirmation or thank you message
                // Or go to another URL:  actions.redirect('thank_you.html');
                const transaction = orderData?.purchase_units?.[0]?.payments?.captures?.[0] || orderData?.purchase_units?.[0]?.payments?.authorizations?.[0];
                resultMessage(`Transaction ${transaction.status}: ${transaction.id}<br><br>See console for all available details`, );
                console.log("Capture result", orderData, JSON.stringify(orderData, null, 2), );
                }
                } catch (error) {
                console.error(error);
                resultMessage(`Sorry, your transaction could not be processed...<br><br>${error}`, );
                }
            },
        }).render("#paypal-button-container");
        
    </script> -->
    <!-- footer -->
    <?php include('layouts/footer.php') ?>