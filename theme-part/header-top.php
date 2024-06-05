<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left" style="font-size: 16px;">
                <p class="welcome-msg">Welcome to <?php echo $project_title ?></p>
            </div>
            <div style="align-items: center;">
                
            </div>
            <div class="header-right pr-0" style="font-size: 16px;">
                <?php
                if (isset($_SESSION['user_email'])) {
                ?>
                    <a href="my-account.php" class="d-lg-show">My Account</a>
                    <span class="delimiter d-lg-show">|</span>
                    <a href="log-out.php" class="ml-0">Log out</a>
                <?php
                } else {
                ?>
                    <a href="login.php" class="d-lg-show"><i class="w-icon-account"></i>Sign In</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="registration.php" class="ml-0">Register</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left flex-1">
                    <div class="dropdown category-dropdown has-border mr-2" data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                <?php
                                $categories = mysqli_query($connection, "SELECT *from tbl_category order By category_id DESC");
                                foreach ($categories as $category) {
                                ?>
                                    <li>
                                        <a href="shop.php?id=<?php echo $category['category_id'] ?>">
                                            <?php echo $category['category_name'] ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                        </a>
                        <a href="index.php" class="logo ml-lg-0" style="margin-top: 19px;">
                            <h4 style="color: blue;"><?php echo $project_title ?></h4>
                        </a>
                        <nav class="main-nav">
                            <ul class="menu">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <a href="shop.php">Shop</a>
                                </li>
                                <li>
                                    <a href="about.php">About</a>
                                </li>
                                <li>
                                    <a href="contact.php">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#">Manufacture</a>
                                    <ul>
                                        <?php
                                        $categories = mysqli_query($connection, "SELECT *from tbl_brand order By brand_id DESC");
                                        foreach ($categories as $category) {
                                        ?>
                                            <li>
                                                <a href="manufacture-filter.php?brand_id=<?php echo $category['brand_id'] ?>">
                                                    <?php echo $category['brand_name'] ?>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>

                                    </ul>
                                </li>
                                <!-- <li>
                                    <a href="#">Product Under</a>
                                    <ul>
                                        <li>
                                            <a href="manufacture-filter.php?price=500&price2=1000">
                                                500 To 1000
                                            </a>
                                        </li>
                                        <li>
                                            <a href="manufacture-filter.php?price=1000&price2=1500">
                                                1000 To 1500
                                            </a>
                                        </li>
                                        <li>
                                            <a href="manufacture-filter.php?price=1500&price2=2000">
                                                1500 To 2000
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header-right ml-4">
                    <div class="dropdown cart-dropdown mr-0 mr-lg-2">
                        <div class="cart-overlay"></div>
                        <a href="#." class="cart-toggle label-down link" onclick="checkCart()">
                            <i class="w-icon-cart">
                            </i>
                            <span class="cart-label">Cart</span>
                        </a>
                        <!-- End of Dropdown Box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->