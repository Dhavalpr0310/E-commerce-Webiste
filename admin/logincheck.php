<?php
include 'class/session-start.php';
include 'class/atclass.php';
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
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password = mysqli_real_escape_string($connection, $_POST['password']);





      $query = mysqli_query($connection, "select *from tbl_admin where admin_email='{$email}' and admin_password='{$password}'") or die(mysqli_error($connection));

      $count = mysqli_num_rows($query);

      if ($count > 0) {
         $row = mysqli_fetch_array($query);

         $email = $row['admin_email'];
         $ad_name = $row['admin_name'];


         $_SESSION["adminemail"] = $email;
         $_SESSION["adminname"] = $ad_name;


   ?>
         <script>
            $(document).ready(function() {
               Swal.fire({
                  type: 'success',
                  title: 'You have Successfully Logged In',
                  timer: 1500
               })

               window.setTimeout(function() {
                  window.location.href = "dashboard.php";
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
                  type: 'error',
                  title: 'Username and Password Wrong',
                  timer: 1500
               })

               window.setTimeout(function() {
                  window.location.href = "index.php";
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