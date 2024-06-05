<?php
include './common/class.php';
$page_name = "Cart";
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location='index.php';</script>";
}
$cart = mysqli_query($connection, "SELECT *from tbl_cart where `user_id`='{$_SESSION['user_id']}'") or die($connection);
$cartDetails = mysqli_fetch_all($cart);
$countCart = mysqli_num_rows($cart);
if (isset($_POST['clear_cart'])) {
    $query = mysqli_query($connection, "DELETE FROM `tbl_cart` WHERE `user_id`='{$_SESSION['user_id']}'");
    if ($query) {
        echo "<script>alert('Your Cart is Empty.')</script>";
    } else {
        echo "<script>alert('Try After Some Time.')</script>";
    }
}
if (isset($_POST['check_out'])) {
    $order_date    = date('Y-m-d');
    $order_time = date('H:i:s');
    $user_id = $_SESSION['user_id'];
    $total_amount = $_POST['total_amount'];
    $order_status = "Pending";
    $payment_method = 1;
    $order = mysqli_query($connection, "INSERT INTO `tbl_order_master`(`order_date`, `order_time`, `user_id`, `total_amount`, `order_status`, `payment_method`) VALUES ('$order_date','$order_time','$user_id','$total_amount','$order_status','$payment_method')");
    if ($order) {
        $order_id = mysqli_insert_id($connection);
        $cart = mysqli_query($connection, "SELECT *from tbl_cart where `user_id`='{$_SESSION['user_id']}'") or die($connection);
        $cartDetails = mysqli_fetch_all($cart);
        foreach ($cartDetails as $cartDetail) {
            $product = mysqli_query($connection, "SELECT *from tbl_product_master where `product_id`='{$cartDetail[3]}'") or die($connection);
            $productDetails = mysqli_fetch_assoc($product);
            $seller_id = $cartDetail[2];
            $product_id = $cartDetail[3];
            $product_qty = $cartDetail[4];
            $total_amount = $cartDetail[4] * $productDetails["product_price"];
            $order = mysqli_query($connection, "INSERT INTO `tbl_order_details`(`order_id`, `product_id`, `product_qty`, `total_amount`,`seller_id`) VALUES ('$order_id','$product_id','$product_qty','$total_amount','$seller_id')");
        }
        $query = mysqli_query($connection, "DELETE FROM `tbl_cart` WHERE `user_id`='{$_SESSION['user_id']}'");
        echo "<script>alert('Order Place Successfully');window.location='cart.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.min.css">
</head>

<body>
    <div class="page-wrapper">
        <?php
        include './theme-part/header-top.php';
        ?>

        <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active">Shopping Cart</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-12 pr-lg-12 mb-6">
                            <?php
                            if ($countCart > 0) {
                            ?>
                                <table class="shop-table cart-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name"><span>Product</span></th>
                                            <th></th>
                                            <th class="product-price"><span>Price</span></th>
                                            <th class="product-quantity"><span>Quantity</span></th>
                                            <th class="product-subtotal"><span>Subtotal</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subTotal = 0;
                                        foreach ($cartDetails as $cartDetail) {
                                            $product = mysqli_query($connection, "SELECT *from tbl_product_master where `product_id`='{$cartDetail[3]}'") or die($connection);
                                            $productDetails = mysqli_fetch_assoc($product);
                                        ?>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <div class="p-relative">
                                                        <a href="product-details.php?id=<?php echo $productDetails['product_id']; ?>">
                                                            <figure>
                                                                <img src="<?php echo $image_upload_path . $productDetails['product_image']; ?>" alt="product" style="width: 100px;height: 113px;">
                                                            </figure>
                                                        </a>
                                                        <button type="submit" class="btn btn-close"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </td>
                                                <td class="product-name">
                                                    <a href="product-details.php?id=<?php echo $productDetails['product_id']; ?>">
                                                        <?php echo $productDetails['product_name'] ?>
                                                    </a>
                                                </td>
                                                <td class="product-price">
                                                    <span class="amount"><?php echo $rupee_symbol . $productDetails["product_price"]; ?></span>
                                                </td>
                                                <form method="POST">
                                                    <td class="product-quantity">
                                                        <div class="input-group">
                                                            <input type="hidden" value="<?php echo $cartDetail[0]; ?>" name="cart_id">
                                                            <input type="hidden" value="<?php echo $productDetails["product_quantity"]; ?>" name="product_quantity">
                                                            <input class="text-center" type="number" value="<?php echo $cartDetail[4]; ?>" name="update_quantity" min="1" style="width: 62px;">
                                                            <input type="submit" class="btn btn-primary" name="update_cart">
                                                        </div>
                                                    </td>
                                                </form>
                                                <td class="product-subtotal">
                                                    <span class="amount"><?php echo $rupee_symbol . $productDetails["product_price"]; ?></span>
                                                </td>
                                            </tr>
                                        <?php
                                            $subTotal += ($productDetails["product_price"] * $cartDetail[4]);
                                        }
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail"></td>
                                            <td class="product-name"></td>
                                            <td class="product-price"></td>
                                            <td class="product-name">Sub total</td>
                                            <td class="product-subtotal">
                                                <span class="amount"><?php echo $rupee_symbol . $subTotal; ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="cart-action mb-6">
                                    <a href="shop.php" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                    <form method="POST">
                                        <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button>
                                    </form>
                                    <!-- <form method="POST">
                                        <button type="submit" class="btn btn-rounded btn-update" name="update_cart" value="Update Cart">Update Cart</button>
                                    </form> -->
                                    <form method="POST" class="form contact-us-form">
                                        <input type="hidden" value="<?php echo $subTotal ?>" name="total_amount" id="total_amount">
                                        <!-- <div class="form-group">
                                            <select name="payment_method" id="payment_method" class="form-control" required>
                                                <?php
                                                $paymentMethods = mysqli_query($connection, "SELECT *From tbl_payment_method");
                                                $paymentMethod = mysqli_fetch_all($paymentMethods);
                                                foreach ($paymentMethod as $payMethod) {
                                                ?>
                                                    <option value="<?php echo $payMethod[0] ?>"><?php echo $payMethod[1] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div> -->
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-rounded btn-update" name="check_out" value="Check Out">
                                        </div>


                                    </form>
                                </div>
                            <?php
                            } else {
                            ?>
                                <h2>No Record Found.</h2>
                                <div class="cart-action mb-6">
                                    <a href="shop.php" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                </div>
                            <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
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
    <!-- End of Sticky Footer -->

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

    <!-- Plugin JS File -->
    <?php
    include './theme-part/footer-script.php';
    ?>
    <!-- Plugin JS File -->
    <?php
    if (isset($_POST['update_cart'])) {
        $cart_id = $_POST['cart_id'];
        $product_quantity = $_POST['product_quantity'];
        $update_quantity = $_POST['update_quantity'] == 0 ? 1 : $_POST['update_quantity'];
        if ($product_quantity >= $update_quantity) {
            $update = mysqli_query($connection, "UPDATE `tbl_cart` SET `product_qty`='{$update_quantity}' WHERE `cart_id`='{$cart_id}'");
            echo "<script>alert('Cart Updated Successfully');window.location='cart.php';</script>";
        } else {
            echo "<script>alert('You Can Update Only $product_quantity');</script>";
        }
    }

    ?>
</body>

</html>