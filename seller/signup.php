<?php
include 'class/atclass.php';
$page_title = "Sign Up";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?> | <?php echo $project_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="dist/img/AdminLTELogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Seller Panel</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign Up</p>

        <form action="signup-process.php" id="myform" method="post">
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="user_name" placeholder="Enter First Name" required="">

          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="seller_last_name" placeholder="Enter Last Name" required="">

          </div>
          <div class="form-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Enter Email" required="">

          </div>

          <div class="form-group mb-3">
            <input type="number" minlength="10" maxlength="10" class="form-control" name="mobile_no" placeholder="Enter Mobile No" required="">

          </div>

          <div class="form-group mb-3">
            <select class="form-control" name="state" id="state">
              <option value="Gujarat">Gujarat</option>
            </select>

          </div>
          <div class="form-group mb-3">
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
          <div class="form-group mb-3">
            <input type="file" class="form-control" name="seller_image">
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required="">

          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" required="">

          </div>
          <div class="row">
            <div class="col-8">
              <!--            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>-->
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="index.php">Back To Login</a>
        </p>
        <!--      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>-->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script src="tools/newjs/js/jquery.validate.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {

      // validate signup form on keyup and submit
      $("#myform").validate({
        rules: {

          user_name: {
            required: true,
            minlength: 2

          },
          email: {
            required: true,
            email: true

          },
          seller_gender: {
            required: true
          },

          password: {
            required: true
          },
          confirm_password: {
            required: true,
            equalTo: '#password'
          },
          mobile_no: {
            required: true
          }

        },
        messages: {
          email: {
            required: "Please Enter Email",
            emai: "Invalid Email Address"

          },
          user_name: {
            required: "Please Enter Name",


          },


          password: {
            required: "Please Enter Password"

          },
          confirm_password: {
            required: "Please Enter Confirm Password",
            equalTo: "Please enter the same password as above"
          },
          mobile_no: {
            required: "Please Enter Mobile",
            maxlength: "Please enter valid 10 digit mobileno",
            minlength: "Please enter valid 10 digit mobileno"

          }



        }
      });

    });
  </script>
</body>

</html>