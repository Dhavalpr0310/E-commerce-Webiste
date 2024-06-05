<?php
include './common/class.php';
if (isset($_GET['id'])) {
    $product = mysqli_query($connection, "SELECT *from tbl_product_master where product_id='{$_GET['id']}'");
    $productDetails = mysqli_fetch_assoc($product);
    $seller = mysqli_query($connection, "SELECT *from tbl_seller");
    $sellerDetails = mysqli_fetch_all($seller);
    $page_name = "{$productDetails['product_name']}";
    $category = mysqli_query($connection, "SELECT *from tbl_category where category_id='{$productDetails['category_id']}'");
    $categoryDetails = mysqli_fetch_assoc($category);
    $brand = mysqli_query($connection, "SELECT *from tbl_brand where brand_id='{$productDetails['brand_id']}'");
    $brandDetails = mysqli_fetch_assoc($brand);
    $feedback = mysqli_query($connection, "SELECT *from tbl_feedback where product_id='{$productDetails['product_id']}'");
    $feedbackCount = mysqli_num_rows($feedback);
    $feedbackDetails = mysqli_fetch_all($feedback);
} else {
    header("location:shop.php");
}
if (isset($_SESSION['user_id'])) {
    $titleCartButton = "Add to Cart";
    $titleFeedBackButton = "Submit Review";
    $disable = "";
} else {
    $titleCartButton = "Please Login First";
    $titleFeedBackButton = "Please Login First";
    $disable = "disabled";
}
if (isset($_POST['rating'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $seller_id = $_POST['seller_id'];
    $feedback_date = date('Y-m-d');
    $feedback_rating = $_POST['feedback_rating'];
    $feedback_message = $_POST['feedback_message'];
    $feedback_subject = $_POST['feedback_subject'];
    $find = mysqli_query($connection, "SELECT *from tbl_feedback where `user_id`='{$user_id}' and `product_id`='{$product_id}'");
    $findCount = mysqli_num_rows($find);
    if ($findCount > 0) {
        $insert = mysqli_query($connection, "UPDATE `tbl_feedback` SET `user_id`='{$user_id}',`product_id`='$product_id',`seller_id`='{$seller_id}',`feedback_date`='{$feedback_date}',`feedback_subject`='{$feedback_subject}',`feedback_rating`='{$feedback_rating}',`feedback_message`='{$feedback_message}' WHERE `user_id`='{$user_id}' and `product_id`='{$product_id}'");
    } else {
        $insert = mysqli_query($connection, "INSERT INTO `tbl_feedback`(`user_id`, `product_id`, `seller_id`, `feedback_date`, `feedback_rating`, `feedback_message`,`feedback_subject`) VALUES ('{$user_id}', '{$product_id}', '{$seller_id}', '{$feedback_date}','{$feedback_rating}', '{$feedback_message}','{$feedback_subject}')");
    }
    if ($insert) {
        echo "<script>alert('Feed Back Send Successfully');window.location='product-details.php?id={$_GET['id']}';</script>";
    } else {
        echo "<script>alert('Try after some time');</script>";
    }
}
if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $seller_id = $_POST['seller_id'];
    $product_qty = 1;
    if ($_POST['product_quantity'] > 0) {
        $find = mysqli_query($connection, "SELECT *from tbl_cart where `user_id`='{$user_id}' and `product_id`='{$product_id}'");
        $findCount = mysqli_num_rows($find);
        if ($findCount > 0) {
            $insert = mysqli_query($connection, "UPDATE `tbl_cart` SET `user_id`='{$user_id}',`product_id`='$product_id',`seller_id`='{$seller_id}',`product_qty`='{$product_qty}' WHERE `user_id`='{$user_id}' and `product_id`='{$product_id}'");
        } else {
            $insert = mysqli_query($connection, "INSERT INTO `tbl_cart`(`user_id`, `seller_id`, `product_id`, `product_qty`) VALUES ('{$user_id}', '{$seller_id}', '{$product_id}', '{$product_qty}')");
        }
        if ($insert) {
            echo "<script>alert('Add to Cart Successfully');window.location='product-details.php?id={$_GET['id']}';</script>";
        } else {
            echo "<script>alert('Try after some time');</script>";
        }
    } else {
        echo "<script>alert('Product Out off stock');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <!-- Swiper's CSS -->
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.min.css">
</head>

<body>
    <div class="page-wrapper">
        <!-- Start of Header -->
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->


        <!-- Start of Main -->
        <main class="main mb-10 pb-1">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav container">
                <ul class="breadcrumb bb-no">
                    <li><a href="index.php">Home</a></li>
                    <li><?php echo $productDetails['product_name'] ?></li>
                </ul>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="">
                            <div class="product product-single row">
                                <div class="col-md-4 mb-6">
                                    <div class="product-gallery product-gallery-sticky">
                                        <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                                            <div class="swiper-wrapper row cols-1 gutter-no">
                                                <div class="swiper-slide">
                                                    <figure class="product-image">
                                                        <!-- 455 × 512 -->
                                                        <img src="<?php echo $image_upload_path . $productDetails['product_image']; ?>" data-zoom-image="<?php echo $image_upload_path . $productDetails['product_image']; ?>" alt="<?php echo $productDetails['product_name'] ?>" title="<?php echo $productDetails['product_name'] ?>" width="800" height="900">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" class="product-gallery-btn product-image-full"><i class="w-icon-zoom"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                        <h1 class="product-title"><?php echo $productDetails['product_name'] ?></h1>
                                        <div class="product-bm-wrapper">
                                            <div class="product-meta">
                                                <div class="product-categories">
                                                    Category:
                                                    <span class="product-category"><a href="#"><?php echo $categoryDetails['category_name'] ?></a></span>
                                                </div>
                                                <div class="product-categories">
                                                    Manufacture By :
                                                    <span class="product-category"><a href="#"><?php echo $brandDetails['brand_name'] ?></a></span>
                                                </div>
                                                <?php
                                                if ($productDetails['product_quantity'] < 5) {
                                                ?>
                                                    <div class="product-categories" style="color: red;">
                                                        Available Stock : <?php echo $productDetails['product_quantity'] ?>
                                                    </div>
                                                <?php

                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <hr class="product-divider">

                                        <div class="product-price"><ins class="new-price"><?php echo $rupee_symbol . $productDetails["product_price"]; ?></ins></div>

                                        <div class="ratings-container">
                                            (<?php echo $feedbackCount; ?> Reviews)
                                        </div>

                                        <div class="product-short-desc">
                                            <?php echo $productDetails["product_details"]; ?>
                                        </div>

                                        <hr class="product-divider">
                                        <form method="POST">
                                            <div class="fix-bottom product-sticky-content sticky-content">
                                                <div class="product-form container">
                                                    <input type="hidden" name="product_quantity" value="<?php echo $productDetails['product_quantity']; ?>">
                                                    <!-- <div class="product-qty-form">
                                                        <div class="input-group">
                                                            <input class="quantity form-control" type="number" name="product_qty" id="product_qty" min="1" max="5">
                                                            
                                                            <button class="quantity-plus w-icon-plus"></button>
                                                            <button class="quantity-minus w-icon-minus"></button>
                                                        </div>

                                                    </div> -->
                                                    <?php
                                                    if ($productDetails["is_seller_all"] == 1) {
                                                    ?>
                                                        <div class="mr-3">
                                                            <select class="form-control" name="seller_id" id="seller_id">
                                                                <option value="1">Any of the Best</option>
                                                                <?php
                                                                foreach ($sellerDetails as $sellerDetail) {
                                                                ?>
                                                                    <option value="<?php echo $sellerDetail[0]; ?>"><?php echo $sellerDetail[1]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <button class="btn btn-primary <?php echo $disable ?>" type="submit" name="add_to_cart">
                                                        <i class="w-icon-cart"></i>
                                                        <span><?php echo $titleCartButton ?></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#product-tab-description" class="nav-link active">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#feedback-tab-description" class="nav-link">Customer Reviews (<?php echo $feedbackCount ?>)</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="product-tab-description">
                                        <div class="row mb-4">
                                            <div class="col-md-12 mb-5">
                                                <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                                <?php echo $productDetails["product_details"]; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="feedback-tab-description">
                                        <div class="row mb-4">
                                            <div class="col-md-12 mb-5">
                                                <div class="tab-pane" id="product-tab-reviews">
                                                    <div class="row mb-4">
                                                        <div class="col-xl-12 col-lg-12 mb-4">
                                                            <div class="review-form-wrapper">
                                                                <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                                    Review</h3>
                                                                <form method="POST" class="review-form">
                                                                    <input type="text" name="feedback_subject" id="feedback_subject" class="form-control" placeholder="Feed Back Subject">
                                                                    <?php
                                                                    if ($productDetails["is_seller_all"] == 1) {
                                                                    ?>
                                                                        <select class="form-control" name="seller_id">
                                                                            <option value="0">Select seller</option>
                                                                            <?php
                                                                            foreach ($sellerDetails as $sellerDetail) {
                                                                            ?>
                                                                                <option value="<?php echo $sellerDetail[0]; ?>"><?php echo $sellerDetail[1]; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <div class="rating-form">
                                                                        <select name="feedback_rating" id="feedback_rating" required="" class="form-control">
                                                                            <option value="0">Your Rating Of This Product</option>
                                                                            <option value="5">Perfect(5)</option>
                                                                            <option value="4">Good(4)</option>
                                                                            <option value="3">Average(3)</option>
                                                                            <option value="2">Not that bad(2)</option>
                                                                            <option value="1">Very poor(1)</option>
                                                                        </select>
                                                                    </div>
                                                                    <textarea cols="30" rows="6" placeholder="Write Your Review Here..." class="form-control" id="feedback_message" name="feedback_message"></textarea>
                                                                    <button type="submit" class="btn btn-dark <?php echo $disable ?>" <?php echo $disable ?> name="rating"><?php echo $titleFeedBackButton ?></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if ($feedbackCount > 0) {
                                                        ?>
                                                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="show-all">
                                                                        <ul class="comments list-style-none">
                                                                            <?php
                                                                            foreach ($feedbackDetails as $feedbackDetail) {
                                                                                $user = mysqli_query($connection, "SELECT *from tbl_user_master where `user_id`='{$feedbackDetail[1]}'");
                                                                                $fetchUser = mysqli_fetch_assoc($user);
                                                                            ?>
                                                                                <li class="comment">
                                                                                    <div class="comment-body">
                                                                                        <figure class="comment-avatar">
                                                                                            <img src="assets/images/agents/1-100x100.png" alt="Commenter Avatar" width="90" height="90">
                                                                                        </figure>
                                                                                        <div class="comment-content">
                                                                                            <h4 class="comment-author">
                                                                                                <a href="#"><?php echo $fetchUser['user_name'] ?></a>
                                                                                                <span class="comment-date"><?php echo $feedbackDetail[4] ?></span>
                                                                                            </h4>
                                                                                            <div class="ratings-container comment-rating">
                                                                                                <?php
                                                                                                for ($i = 1; $i <= 5; $i++) {
                                                                                                    if ($feedbackDetail[6] >= $i) {
                                                                                                        $styleStar = "style='color: #F29934;'";
                                                                                                    } else {
                                                                                                        $styleStar = "";
                                                                                                    }
                                                                                                ?>
                                                                                                    <i class="fas fa-star" <?php echo $styleStar ?>></i>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                            <p><?php echo $feedbackDetail[7] ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="show-all">
                                                                        <h3 class="title tab-pane-title font-weight-bold mb-1">(<?php echo $feedbackCount ?>) Customer Reviews</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
        <?php
        include './theme-part/footer.php';
        ?>
        <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Start of Sticky Footer -->
    <?php
    include './theme-part/header.php';
    ?>
    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <?php
    include './theme-part/mobile-menu.php';
    ?>
    <!-- End of Mobile Menu -->



    <?php
    include './theme-part/footer-script.php';
    ?>

    <!-- Swiper JS -->
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.min.js"></script>
</body>

</html>