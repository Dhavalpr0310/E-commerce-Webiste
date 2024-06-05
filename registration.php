<?php
include './common/class.php';
$page_name = "Register";
if (isset($_POST['registration'])) {
    $table = "tbl_user_master";
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_gender = $_POST['user_gender'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];
    $user_password = $_POST['user_password'];
    $user_address = $_POST['user_address'];
    $user_dob = $_POST['user_dob'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $query_check = mysqli_query($connection, "select lower(user_email) from $table where user_email=lower('{$user_email}')") or die(mysqli_error($connection));
    $count = mysqli_num_rows($query_check);
    if ($count > 0) {
        echo "<script>alert('Email Already Exist');</script>";
    } else {
        $insert = mysqli_query($connection, "INSERT INTO `tbl_user_master`(`user_first_name`, `user_last_name`,`user_gender`, `user_email`, `user_mobile`, `user_password`, `user_address`,`user_dob`,`state`,`city`) VALUES ('{$user_first_name}','{$user_last_name}','{$user_gender}','{$user_email}','{$user_mobile}','{$user_password}','{$user_address}','{$user_dob}','{$state}','{$city}')");
        if ($insert) {
            echo "<script>alert('Registration Successfully');window.location='login.php';</script>";
        } else {
            echo "<script>alert('Registration Fail.Do after same time later');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './theme-part/header-script.php';
    ?>
</head>

<body>
    <div class="page-wrapper">
        <?php
        include './theme-part/header-top.php';
        ?>
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <div class="page-content mb-10">
                <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6" style="background-image: url(assets/images/shop/banner2.jpg); background-color: #FFC74E;">

                </div>
            </div>
            <!-- End of Breadcrumb -->
            <div class="page-content contact-us">
                <div class="container">
                    <section class="content-title-section mb-10">
                        <h3 class="title title-center mb-3">Registration</h3>
                    </section>
                    <!-- End of Contact Title Section -->

                    <div class="container-fluid">
                        <!-- Start of Shop Content -->
                        <div class="shop-content">
                            <!-- Start of Shop Main Content -->
                            <div class="main-content">
                                <section class="contact-section">
                                    <div class="row gutter-lg pb-3">
                                        <center>
                                            <div class="col-lg-6 mb-8">
                                                <form class="form contact-us-form" method="post">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_first_name">Your First Name</label>
                                                                <input type="text" id="user_first_name" name="user_first_name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_last_name">Your Last Name</label>
                                                                <input type="text" id="user_last_name" name="user_last_name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_email">Your Email</label>
                                                                <input type="email" id="user_email" name="user_email" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_mobile">Your Mobile</label>
                                                                <input type="text" onkeypress="return isNumber(event)" id="user_mobile" maxlength="10" name="user_mobile" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_first_name">Your gender</label><br>
                                                                <div class="form-control">
                                                                    <input type="radio" name="user_gender" value="Male"> Male
                                                                    <input type="radio" name="user_gender" value="Female"> Female
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_password">Your Password</label>
                                                                <input type="password" id="user_password" name="user_password" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="user_dob">Your DOB</label>
                                                                <input type="date" id="user_dob" name="user_dob" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="user_address">Your Address</label>
                                                                <textarea type="password" id="user_address" name="user_address" class="form-control" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_password">Your State</label>
                                                                <select class="form-control" name="state" id="state">
                                                                    <option value="Gujarat">Gujarat</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="user_password">Your City</label>
                                                                <select class="form-control" name="city" id="city">
                                                                    <option value="Ahmadabad">Ahmadabad</option>
                                                                    <option value="Amreli">Amreli</option>
                                                                    <option value="Bharuch">Bharuch</option>
                                                                    <option value="Bhavnagar">Bhavnagar</option>
                                                                    <option value="Bhuj">Bhuj</option>
                                                                    <option value="Dwarka">Dwarka</option>
                                                                    <option value="Gandhinagar">Gandhinagar</option>
                                                                    <option value="Godhra">Godhra</option>
                                                                    <option value="Jamnagar">Jamnagar</option>
                                                                    <option value="Junagadh">Junagadh</option>
                                                                    <option value="Kandla">Kandla</option>
                                                                    <option value="Khambhat">Khambhat</option>
                                                                    <option value="Kheda">Kheda</option>
                                                                    <option value="Mahesana">Mahesana</option>
                                                                    <option value="Morbi">Morbi</option>
                                                                    <option value="Nadiad">Nadiad</option>
                                                                    <option value="Navsari">Navsari</option>
                                                                    <option value="Okha">Okha</option>
                                                                    <option value="Palanpur">Palanpur</option>
                                                                    <option value="Patan">Patan</option>
                                                                    <option value="Porbandar">Porbandar</option>
                                                                    <option value="Rajkot">Rajkot</option>
                                                                    <option value="Surat">Surat</option>
                                                                    <option value="Surendranagar">Surendranagar</option>
                                                                    <option value="Valsad">Valsad</option>
                                                                    <option value="Veraval">Veraval</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-dark btn-rounded" name="registration">
                                                </form>
                                            </div>
                                        </center>
                                    </div>
                                </section>
                            </div>
                            <!-- End of Shop Main Content -->


                        </div>
                        <!-- End of Shop Content -->
                    </div>
                </div>
            </div>
            <!-- Start of Page Content -->

            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

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

    <?php
    include './theme-part/footer-script.php';
    ?>
</body>

</html>