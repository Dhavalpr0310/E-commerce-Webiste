<?php
include './common/class.php';
include './common/PHPMailerAutoload.php';
$page_name = "Login";
if (isset($_POST['login'])) {
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    $query = mysqli_query($connection, "select *from tbl_user_master where user_email='{$user_email}' and user_password='{$user_password}'") or die(mysqli_error($connection));
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $row = mysqli_fetch_array($query);
        $user_id = $row['user_id'];
        $user_email = $row['user_email'];
        $user_name = $row['user_name'];
        $user_gender = $row['user_gender'];
        $user_mobile = $row['user_mobile'];
        $user_address = $row['user_address'];
        $user_password = $row['user_password'];
        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_email"] = $user_email;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["user_gender"] = $user_gender;
        $_SESSION["user_mobile"] = $user_mobile;
        $_SESSION["user_address"] = $user_address;
        $_SESSION["user_password"] = $user_password;
        echo "<script>alert('Login Successfully');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Login Fail.Your Email and password not match.');</script>";
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
                        <h3 class="title title-center mb-3">Login</h3>
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
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="user_email">Your Email</label>
                                                                <input type="email" id="user_email" name="user_email" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-dark btn-rounded" name="send-password" name="Send Password">
                                                </form>
                                                <a href="login.php">Login?</a>
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
    <?php
    if (isset($_POST['send-password'])) {
        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $query = mysqli_query($connection, "select * from tbl_user_master where user_email='{$user_email}'") or die(mysqli_error($connection));

        $count = mysqli_num_rows($query);

        if ($count > 0) {

            $row = mysqli_fetch_array($query);

            $user_email = $row['user_email'];

            $user_password = $row['user_password'];

            $email_send = $user_email;
            $subject = "Forgot Password Details";
            $body = "Your Password is $user_password";

            $emailData = "mailtesterat.2021@gmail.com";
            $emailPassword = "Naa@123456";
            $mail = new PHPMailer;
            $mail->isSMTP();    // Set mailer to use SMTP
            $mail->SMTPAuth = true;   // Enable SMTP authentication
            $mail->SMTPSecure = 'tls';   // `tls` or `ssl`
            $mail->Host = 'smtp.gmail.com';  // Host Name Like smtp.gmail.com
            $mail->Port = 587;   // TCP port to connect to
            $mail->Username = $emailData;   // SMTP username
            $mail->Password = "$emailPassword";  // SMTP password

            $mail->addReplyTo($emailData, $projectName);

            $mail->setFrom($emailData, $projectName);
            $mail->addAddress($user_email, $projectName);


            $mail->isHTML(true);

            $mail->Subject = "$subject Form the $project_title (" . date('d-m-Y h:i:s') . ")";

            $mail->msgHTML($body);
            if (!$mail->send()) {
                echo "<script>alert('Try After Some Time Letter');</script>";
            } else {
                echo "<script>alert('Your Password Send On Your Mail Id');</script>";
            }
        }
    }
    ?>
</body>

</html>