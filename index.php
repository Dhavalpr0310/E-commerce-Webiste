<?php
include './common/class.php';
$page_name = "Home"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
</head>

<body class="">
    <div class="page-wrapper">

        <?php
        include './theme-part/header-top.php';
        ?>
        <main class="main">
            <div class="intro-section">
                <div class="swiper-container swiper-theme nav-inner pg-inner animation-slider pg-xxl-hide pg-show nav-xxl-show nav-hide" data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    }
                }">
                    <div class="swiper-wrapper row gutter-no cols-1">
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide1" style="background-image: url(assets/images/demos/demo2/slides/slide-1.jpg); background-color: #f1f0f0;">
                            <div class="container">
                                <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                    'name': 'fadeInDownShorter', 'duration': '1s'
                                }" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}" data-child-depth="0.2">
                                    <img src="assets/images/demos/demo2/slides/ski.png" alt="Ski" width="729" height="570" />
                                </figure>
                                <div class="banner-content text-right y-50 ml-auto">
                                    <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate" data-animation-options="{
                                        'name': 'fadeInUpShorter', 'duration': '1s'
                                    }">Deals And Promotions</h5>
                                    <h3 class="banner-title ls-25 mb-6 slide-animate" data-animation-options="{
                                        'name': 'fadeInUpShorter', 'duration': '1s'
                                    }">Fashion <span class="text-primary">Skiwears</span> for the ardent Sports
                                        devotees
                                    </h3>
                                    <a href="#" class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate" data-animation-options="{
                                        'name': 'fadeInUpShorter', 'duration': '1s'
                                    }">
                                        Shop Now<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                        <!-- End of .intro-slide1 -->

                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide2" style="background-image: url(assets/images/demos/demo2/slides/slide-2.jpg); background-color: #d9ddd9;">
                            <div class="container">
                                <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter', 'duration': '1s'
                                }" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}" data-child-depth="0.2">
                                    <img src="assets/images/demos/demo2/slides/woman.png" alt="Ski" width="865" height="732" />
                                </figure>
                                <div class="banner-content y-50">
                                    <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.5s'
                                    }">News And Inspiration</h5>
                                    <h3 class="banner-title ls-25 mb-2 text-uppercase lh-1 slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.7s'
                                    }">Natural Sound</h3>
                                    <div class="banner-price-info font-weight-bold text-dark ls-25 slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.9s'
                                    }">Sale up to
                                        <span class="text-primary font-weight-bolder text-uppercase ls-normal">30%
                                            Off</span>
                                    </div>
                                    <p class="font-weight-normal text-default ls-25 slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.1s'
                                    }">Free returns extended to 30 days after delivery</p>
                                    <a href="#" class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.3s'
                                    }">
                                        Shop Now<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                        <!-- End of .intro-slide2 -->

                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide3" style="background-image: url(assets/images/demos/demo2/slides/slide-3.jpg); background-color: #d0cfcb;">
                            <div class="container">
                                <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                    'name': 'fadeInRightShorter', 'duration': '1s'
                                }" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}" data-child-depth="0.2">
                                    <img src="assets/images/demos/demo2/slides/man.png" alt="Ski" width="527" height="481" />
                                </figure>
                                <div class="banner-content y-50">
                                    <h5 class="banner-subtitle text-uppercase font-weight-bold slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s'
                                    }">Top Monthly Seller</h5>
                                    <h4 class="banner-title ls-25 slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s'
                                    }">Sumsung 52 Inches Full HD <span class="text-primary">Smart LED</span> TV</h4>
                                    <p class="font-weight-normal text-dark slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s'
                                    }">Only until the end of this week.</p>
                                    <a href="#" class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate" data-animation-options="{
                                        'name': 'fadeInRightShorter', 'duration': '1s'
                                    }">Shop Now<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                        <!-- End of .intro-slide3 -->
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
            <!-- End of .intro-section -->

            
            <!-- End of Container -->
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
        <?php
        include './theme-part/footer.php';
        ?>
        <!-- End of Footer -->
    </div>
    <!-- End of .page-wrapper -->
    <!-- Start of Sticky Footer -->
    <?php
    include './theme-part/header.php';
    ?>
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg>
    </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <?php
    include './theme-part/mobile-menu.php';
    ?>
    <!-- End of Mobile Menu -->

    <?php
    include './theme-part/footer-script.php';
    ?>
</body>

</html>