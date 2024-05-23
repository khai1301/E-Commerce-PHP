<?php
    session_start();
    include('server/connection.php');
    if(!isset($_SESSION['logged_in'])) {
        header('location: login.php');
        exit;
    }
    if(isset($_GET['logout'])) {
        if(isset($_SESSION['logged_in'])){
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            header('location: login.php');
            exit;
        }
    }

    if(isset($_POST['change_password'])) {
        $password = $_POST['password'];
        $confirmPassword= $_POST['confirmPassword'];
        $user_email = $_SESSION['user_email'];

        if($password !== $confirmPassword) {
            header('location: account.php?error=Confirmation password is wrong');
        } else if(strlen($password) < 6) {
            header('location: account.php?error=The password must be at least');
        } else {
            $sql = $conn->prepare("UPDATE users SET user_password=? WHERE user_email= ?") ;
            $sql->bind_param('ss', md5($password),$user_email);

            if($sql->execute()) {
                header('location: account.php?message=Change Password Successfully');
            } else {
                header('location: account.php?message=Change password failed');
            }
        }
    }

    //get orders
    if(isset($_SESSION['logged_in'])) {
        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $orders = $stmt->get_result();

    }
?>
<?php include('layouts/header.php') ?>
    <!-- account -->
    <section class="my-5 py-5">
        <p style="color: green;"><?php if(isset($_GET['message'])) { echo $_GET['message'];} ?></p>
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p><?php if(isset($_GET['register_success'])) { echo $_GET['register_success'];} ?></p>
                <p><?php if(isset($_GET['login_success'])) { echo $_GET['login_success'];} ?></p>
                <h3 class="font-weight-bold">
                    Account info
                </h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name: <span><?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?></span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} ?></span></p>
                    <p><a href="#orders" id="order-btn">Your orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Log Out</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form action="account.php" id="account-form" method="POST">
                    <p><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
                    <p><?php if(isset($_GET['message'])) {echo $_GET['message'];} ?></p>
                    <h3>Change password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="account-password" name="password"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" class="btn" name="change_password" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- orders -->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
            <h2 class="font-weight-bolde text-center">Your Orders</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Order Id</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>
            <?php while($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <span><?php echo $row['order_id'] ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_cost'] ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_status'] ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_date'] ?></span>
                    </td>
                    <td>
                        <form action="order_details.php" method="POST">
                            <input type="hidden" name="order_status" value="<?php echo $row['order_status'] ?>" id="">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>" id="">
                            <input type="submit" class="btn order-details-btn" name="order_detail_btn" value="Details" id="">
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>


    </section>
    <!-- footer -->
<?php include('layouts/footer.php') ?>