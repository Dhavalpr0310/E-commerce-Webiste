<?php
include '../common/class.php';
if (isset($_SESSION["delivery_person_email"])) {

    $delivery_person_id = $_SESSION["delivery_person_id"];

    $query = mysqli_query($connection, "select *from tbl_delivery_person where delivery_person_id='{$delivery_person_id}'") or die(mysqli_error($connection));
    $row = mysqli_fetch_array($query);
    $_SESSION["delivery_person_id"] = $row['delivery_person_id'];
    $_SESSION["delivery_person_name"] = $row['delivery_person_name'];
    $_SESSION["delivery_person_mobile"] = $row['delivery_person_mobile'];
    $_SESSION["delivery_person_password"] = $row['delivery_person_password'];
    $_SESSION["delivery_person_address"] = $row['delivery_person_address'];
    $_SESSION["delivery_person_email"] = $row['delivery_person_email'];
    $_SESSION["delivery_person_image"] = $row['delivery_person_image'];
} else {
    header("location:index.php");
}
