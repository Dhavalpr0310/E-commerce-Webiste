<?php
include '../common/class.php';
?>
<html>

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Login Check | <?php echo $project_title; ?></title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="dist/img/AdminLTELogo.png" type="image/x-icon">
   <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
   <!-- Toastr -->

   <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body>

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
   if (isset($_POST["delivery-boy"])) {
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password = mysqli_real_escape_string($connection, $_POST['password']);
      $query = mysqli_query($connection, "select *from tbl_delivery_person where delivery_person_email='{$email}' and delivery_person_password='{$password}'") or die(mysqli_error($connection));

      $count = mysqli_num_rows($query);
      if ($count > 0) {
         $row = mysqli_fetch_array($query);
         $_SESSION["delivery_person_id"] = $row['delivery_person_id'];
         $_SESSION["delivery_person_name"] = $row['delivery_person_name'];
         $_SESSION["delivery_person_mobile"] = $row['delivery_person_mobile'];
         $_SESSION["delivery_person_password"] = $row['delivery_person_password'];
         $_SESSION["delivery_person_address"] = $row['delivery_person_address'];
         $_SESSION["delivery_person_email"] = $row['delivery_person_email'];
         $_SESSION["delivery_person_image"] = $row['delivery_person_image'];
   ?>
         <script>
            $(document).ready(function() {
               Swal.fire({
                  type: 'success',
                  title: 'You have Successfully Logged In',
                  timer: 1500
               })

               window.setTimeout(function() {
                  window.location = "dashboard.php";
               }, 1500);
            });
         </script>

      <?php
      } else {
      ?>
         <script>
            $(document).ready(function() {
               Swal.fire({
                  type: 'error',
                  title: 'Username and Password Wrong',
                  timer: 1500
               })

               window.setTimeout(function() {
                  window.location = "index.php";
               }, 1500);
            });
         </script>
   <?php

      }
   }
   ?>


</body>

</html>