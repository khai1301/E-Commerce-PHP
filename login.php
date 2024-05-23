<?php
    session_start();
    include('server/connection.php');
    if(isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit;
    }

    if(isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT user_id, user_name, user_email, user_password FROM users where user_email=? AND user_password = ?";
        $stmt = $conn -> prepare($sql);
        $stmt->bind_param('ss', $email, $password);

        if($stmt->execute()) {
            $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
            if($stmt->fetch()){
                
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;
                header('location: account.php?login_success=Login successfully');
            } else {
                header('location: login.php?error=could not verify your account');
            }
        } else {
            header('location: login.php?error=login failed');

        }

    }

?>
<?php include('layouts/header.php') ?>
    <!-- login -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="" id="login-form" method="POST" action="login.php">
                <p><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control" id="login-btn" value="Login" name="login_btn">
                </div>
                <div class="form-group">
                    <a href="register.html" id="register-url" class="btn">Register Here</a>
                </div>
            </form>
        </div>
    </section>
    <!-- footer -->
    <?php include('layouts/footer.php') ?>