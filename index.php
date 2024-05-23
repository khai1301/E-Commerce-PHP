<?php include('layouts/header.php') ?>
    <!--Home-->
    <section id="home">
        <div class="container">
            <h5>New arrivals</h5>
            <h1>Best prices this season</h1>
            <p>Eshop offers the best product for the most affordable prices</p>
            <button>Shop now</button>
        </div>
    </section>
    <!-- brand -->
    <section id="brand" class="container">
        <div class="row">
            <img src="../EcommerceProject/assets/imgs/nike.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
            <img src="../EcommerceProject/assets/imgs/nike.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
            <img src="../EcommerceProject/assets/imgs/nike.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
            <img src="../EcommerceProject/assets/imgs/nike.jpg" class="img-fluid col-lg-3 col-md-6 col-sm-12" alt="">
        </div>
    </section>
    <!-- new -->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="./assets/imgs/nike.jpg" class="img-fluid" alt="">
                <div class="details">
                    <h2>Nike nike shoes beautiful</h2>
                    <button class="text-uppercase">Shop now</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="./assets/imgs/nike.jpg" class="img-fluid" alt="">
                <div class="details">
                    <h2>Nike nike shoes beautiful</h2>
                    <button class="text-uppercase">Shop now</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="./assets/imgs/nike.jpg" class="img-fluid" alt="">
                <div class="details">
                    <h2>Nike nike shoes beautiful</h2>
                    <button class="text-uppercase">Shop now</button>
                </div>
            </div>
        </div>
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="./assets/imgs/nike.jpg" class="img-fluid" alt="">
                <div class="details">
                    <h2>Nike nike shoes beautiful</h2>
                    <button class="text-uppercase">Shop now</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="./assets/imgs/nike.jpg" class="img-fluid" alt="">
                <div class="details">
                    <h2>Nike nike shoes beautiful</h2>
                    <button class="text-uppercase">Shop now</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="./assets/imgs/nike.jpg" class="img-fluid" alt="">
                <div class="details">
                    <h2>Nike nike shoes beautiful</h2>
                    <button class="text-uppercase">Shop now</button>
                </div>
            </div>
        </div>
    </section>
    <!-- feature -->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Featured</h3>
            <hr class="mx-auto">
            <p>Here we can check out our featured products</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php include('server/get_featured_products.php'); ?>
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="./assets/imgs/<?php echo $row['product_image'] ?>" alt="" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price'] ?></h4>
                <a href="<?php echo "single_product.php?product_id=". $row['product_id'] ?>"><button class="but-btn">buy now</button></a>
            </div>
            <?php };
            ?>
        </div>
    </section>
    <!-- banner -->
    <section id="banner" class="my-5">
        <div class="container">
            <h4>mid season's sale</h4>
            <h1>autumn collection <br> up to 30% off</h1>
            <button class="text-uppercase">
                shop now
            </button>
        </div>
    </section>
    <!-- Clothes -->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Dresses & Coats</h3>
            <hr class="mx-auto">
            <p>Here we can check out our amazing clothes</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php include('server/get_coats.php') ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <?php while($row = $result->fetch_assoc()) { ?>
                <img src="./assets/imgs/<?php echo $row['product_image'] ?>" alt="" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
                <h4 class="p-price">$<?php echo $row['product_price'] ?></h4>
                <a href="<?php echo "single_product.php?product_id=". $row['product_id'] ?>"><button class="but-btn">buy now</button></a>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- watches -->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>watches</h3>
            <hr class="mx-auto">
            <p>Here we can check out our amazing clothes</p>
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
    <!-- Shoes -->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Shoes</h3>
            <hr class="mx-auto">
            <p>Here we can check out our amazing clothes</p>
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
<?php include('layouts/footer.php') ?>