<?php
error_reporting(0);
session_start();
/*connection*/
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
$connection = new mysqli("localhost", "root", "", "student_electronic_gadget") or die(mysqli_connect_error());
//DateTimeSet
date_default_timezone_set('Asia/Calcutta');
//FileUpload Max Size
ini_set("upload_max_filesize", "300M");
mysqli_set_charset($connection, "utf8");

$baseurl = "http://localhost/electronics/";

$imageupload_path = "../upload/";
$image_upload_path = "./upload/";

// $baseurl = "https://aarniktechnology.in/student/electronics/";

// $imageupload_path = "https://aarniktechnology.in/student/electronics/upload/";

$imageupload_folder = "upload/";

$project_title = "Gadget World";


$home_page = "dashboard.php";



$rupee_symbol = "₹ ";



$query_mail_setting = mysqli_query($connection, "SELECT * FROM `tbl_mail_setting` where mail_setting_id='1'") or die(mysqli_error($connection));
$row_mail_setting = mysqli_fetch_array($query_mail_setting);

$mail_smtp_secure = $row_mail_setting["mail_smtp_secure"];
$mail_host = $row_mail_setting["mail_host"];
$mail_port = $row_mail_setting["mail_port"];
$mail_username = $row_mail_setting["mail_username"];
$mail_password = $row_mail_setting["mail_password"];
$mail_email_send = $row_mail_setting["mail_email_send"];
$mail_title_new = $row_mail_setting["mail_title"];

//mail start
$email_send = $mail_email_send;
$smtpsecure = $mail_smtp_secure;
$host_email = $mail_host;
$port = $mail_port;
$email_username = $mail_username;
$email_password = $mail_password;
$mail_title = $mail_title_new;
//mail end

$alert = "";
$msg = "";
