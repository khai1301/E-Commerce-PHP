<?php
    session_start();
    include('server/connection.php');
    if(isset($_SESSION['logged_in'])){
        header('location: account.php');
        exit;
    }
    if(isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //check confirmpass
        if($password !== $_POST['confirmPassword']) {
            header('location: register.php?register_error=Confirmation password is wrong');
        } 
        //check length pass
        else if(strlen($password) < 6) {
            header('location: register.php?register_error=The password must be at least 6 character');
        } else {
        //check duplicate user
            $sql = "SELECT count(*) FROM users where user_email='$email'";
            $stmt = $conn -> query($sql);
            $row = $stmt->fetch_assoc(); // Lấy hàng kết quả
            $count = $row['count(*)']; // Lấy giá trị của cột COUNT(*)
            if($count > 0 ) {
                header('location: register.php?register_error=This email exists');
            } else {
                $sql1 = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$name', '$email', md5($password))";
                $stmt1 = $conn ->query($sql1);
                if($stmt1) {
                    $user_id = $stmt1 -> insert_id;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?register_success=Register Successfully');
                } else {
                    header('location: register.php?register_error=Could not create a new account');
                }
            }

        }

    }
?>
<?php include('layouts/header.php') ?>
    <!-- register -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
                <p><?php if(isset($_GET['register_error'])) { echo $_GET['register_error']; } ?></p>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email"
                        required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="register-password" name="password"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control" id="register-btn" name="register" value="Register">
                </div>
                <div class="form-group">
                    <a href="login.php" id="login" class="btn">Login Here</a>
                </div>
            </form>
        </div>
    </section>
    <!-- footer -->
    <?php include('layouts/footer.php') ?>