<?php
include 'class/atclass.php';
?>
<html>

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Singup Process | <?php echo $project_title; ?></title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="dist/img/AdminLTELogo.png" type="image/x-icon">
   <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
   <!-- Toastr -->

   <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body>
   <button type="button" class="btn btn-success mybtn" style="display:none;">

   </button>
   <!-- jQuery -->
   <script src="plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="dist/js/adminlte.min.js"></script>
   <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
   <!--<script src="addnew/sweetalert2@9.js"></script>-->
   <!-- Toastr -->
   <script src="plugins/toastr/toastr.min.js"></script>

   <?php
   if (isset($_POST["submit"])) {
      $seller_first_name = mysqli_real_escape_string($connection, $_POST['user_name']);
      $seller_last_name = mysqli_real_escape_string($connection, $_POST['seller_last_name']);
      $seller_email = mysqli_real_escape_string($connection, $_POST['email']);
      $seller_mobile_no = mysqli_real_escape_string($connection, $_POST['mobile_no']);
      $seller_password = mysqli_real_escape_string($connection, $_POST['password']);
      $state = mysqli_real_escape_string($connection, $_POST['state']);
      $city = mysqli_real_escape_string($connection, $_POST['city']);
      $seller_gender = "Male";
      $seller_address = "";

      if ($_FILES['seller_image']['name'] == '') {
         $seller_image = "noimage.png";
      } else {
         if ($_FILES['seller_image']['name'] !== '') {
            $seller_image = $_FILES['seller_image']['name'];
            $path = $imageupload_path;
            $time = time();
            $destination = $path . $time . basename($cphoto);


            //product image name
            $seller_image = $time . basename($cphoto);


            //product img name
            $cust_photo  = $_POST["cust_photo"];
            if (file_exists($path . $cust_photo)) {
               if ($cust_photo == "noimage.png") {
               } else {

                  unlink($path . $cust_photo);
               }
            }
            move_uploaded_file($_FILES['seller_image']['tmp_name'], $destination);
         } else {
            $seller_image = "noimage.png";
         }
      }

      $query = mysqli_query($connection, "select *from tbl_seller where seller_email='{$seller_email}'") or die(mysqli_error($connection));

      $count = mysqli_num_rows($query);

      if ($count == 0) {

         $query_insert = mysqli_query($connection, "insert into tbl_seller (`seller_first_name`,`seller_last_name`,`seller_email`,`seller_mobile_no`,`seller_password`,`seller_address`,`seller_gender` ,`seller_image`,`state`,`city`) VALUES ('{$seller_first_name}','{$seller_last_name}','{$seller_email}','{$seller_mobile_no}','{$seller_password}','{$seller_address}','{$seller_gender}','{$seller_image}','{$state}','{$city}')");


   ?>
         <script>
            $(document).ready(function() {
               Swal.fire({
                  type: 'success',
                  title: 'Your registraion successfully',
                  timer: 1500
               })
               window.setTimeout(function() {
                  window.location.href = "index.php";
               }, 1500);
            });
         </script>
      <?php
         //  echo "<script>alert('You have Successfully Logged In');window.location='dashboard.php';</script>";

      } else {
      ?>
         <script>
            $(document).ready(function() {
               Swal.fire({
                  type: 'warning',
                  title: 'Email Already Exist',
                  timer: 1500
               })

               window.setTimeout(function() {
                  window.location.href = "signup.php";
               }, 1500);
            });
         </script>
         <?php
         //   echo "<script>alert('Username and Password Wrong');window.location='index.php';</script>";
         ?>
      <?php

      }
   } else {

      ?>
      <script>
         window.location.href = "index.php";
      </script>
   <?php
   }

   ?>

</body>

</html>