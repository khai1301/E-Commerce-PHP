<?php
    include('server/connection.php');
    if(isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $sql = "SELECT * FROM products where product_id =".$product_id;
        $result = $conn->query($sql);
    }else {
        header('location: index.php');
    }
?>
<?php include('layouts/header.php') ?>
    <!-- single product -->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
            <?php while($row = $result->fetch_assoc()) {?>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <img src="assets/imgs/<?php echo $row['product_image'] ?>" alt="" class="img-fluid w-100" id="mainImg">
                        <div class="small-img-group">
                            <div class="small-img-col">
                                <img src="assets/imgs/<?php echo $row['product_image'] ?>" width="100%" alt="" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="assets/imgs/<?php echo $row['product_image2'] ?>" width="100%" alt="" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="assets/imgs/<?php echo $row['product_image3'] ?>" width="100%" alt="" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="assets/imgs/<?php echo $row['product_image4'] ?>" width="100%" alt="" class="small-img">
                            </div>
                        </div>
                    </div>  
            
            <div class="col-lg-6 col-md-12 col-12">
                <h6>Men/Shoes</h6>
                <h3 class="py-4"><?php echo $row['product_name'] ?></h3>
                <h2>$<?php echo $row['product_price'] ?></h2>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>" id="">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>" id="">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>" id="">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>" id="">
                    <input type="number" value="1" name="product_quantity"  id="">
                    <button class="buy-btn" type="submit" name="add_to_cart">Add to cart</button>
                </form>
                <h4 class="mt-5 mb-5">Product details</h4>
                <span><?php echo $row['product_description'] ?></span>
            </div>
            <?php }?>
        </div>
    </section>
    <!-- related product -->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Product</h3>
            <hr class="mx-auto">
            <p>Here we can see related products</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="./assets/imgs/shoe.png" alt="" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Sports shoe</h5>
                <h4 class="p-price">$200</h4>
                <button class="but-btn">buy now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="./assets/imgs/shoe.png" alt="" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Sports shoe</h5>
                <h4 class="p-price">$200</h4>
                <button class="but-btn">buy now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="./assets/imgs/shoe.png" alt="" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Sports shoe</h5>
                <h4 class="p-price">$200</h4>
                <button class="but-btn">buy now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="./assets/imgs/shoe.png" alt="" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Sports shoe</h5>
                <h4 class="p-price">$200</h4>
                <button class="but-btn">buy now</button>
            </div>
        </div>
    </section>
    <!-- footer -->
    <!--fontawesome-->
    
    <script>
        var mainImg = document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");
        for (let i = 0; i < smallImg.length; i++) {
            smallImg[i].onclick = function () {
                mainImg.src = smallImg[i].src;
            }

        }
    </script>
<?php include('layouts/footer.php') ?>