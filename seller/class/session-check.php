<?php

if (isset($_SESSION["selleremail"])) {

    $email = $_SESSION["selleremail"];


    $selectadminq = mysqli_query($connection, "select * from tbl_seller where seller_email='{$email}'") or die(mysqli_error($connection));
    $admin_login_details = mysqli_fetch_array($selectadminq);

    $admin_id  =    $admin_login_details["seller_id"];
    $admin_name  =    $admin_login_details["seller_first_name"] . " " . $admin_login_details["seller_last_name"];
    $admin_email  =    $admin_login_details["seller_email"];
    $admin_mobile  =    $admin_login_details["seller_mobile_no"];
    $admin_profile  =    $admin_login_details["seller_image"];
    $admin_password  =    $admin_login_details["seller_password"];
} else {
    header("location:../index.php");
}
