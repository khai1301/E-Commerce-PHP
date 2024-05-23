<?php
    include('server/connection.php');
    if(isset($_POST['search'])) {
        $stmt = $conn -> prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
        $stmt->bind_param("si", $_POST['category'], $_POST['price']);
        $stmt->execute();
        $product = $stmt -> get_result();
    } else {
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $product = $stmt->get_result();
    }
?>
<?php include('layouts/header.php') ?>
    <!-- left section -->
    <section id="search" class="my-5 py-5 ms-2">
        <div class="container mt-5 py-5">
            <h3>Search Product</h3>
            <hr>
        </div>
        <form action="shop.php" method="POST">
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Category</p>
                    <div class="form-check">
                        <input type="radio" value="shoes" class="form-check-input" name="category" id="category_one">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Shoes
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" value="coats" class="form-check-input" name="category" id="category_two">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Coats
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" value="bags" class="form-check-input" name="category" id="category_three">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Bags
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Price</p>
                    <input type="range" class="form-range w-50" max="1000" name="price" value="100" id="customRange2" name="" id="">
                    <div class="w-50">
                        <span style="float: left;">1</span>
                        <span style="float: right;">1000</span>
                    </div>
                </div>
            </div>
            <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
        </form>
    </section>
    <!-- feature -->
    <section id="shop" class="my-5 py-5">
        <div class="container mt-5 py-5">
            <h3>Our products</h3>
            <hr class="">
            <p>Here we can check out our products</p>
        </div>
        <div class="row mx-auto container">
            <?php while($row = $product->fetch_assoc()) { ?>
            <div onclick="window.location.href='single_product.html'"
                class="product text-center col-lg-3 col-md-4 col-sm-12">
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
                <button class="but-btn"><a href="<?php echo "single_product.php?product_id=".$row['product_id'] ?>">buy now</a></button>
            </div>
            <?php }?>
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5">
                    <li class="page-item"><a href="#" class="page-link">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- footer -->
    <?php include('layouts/footer.php') ?>