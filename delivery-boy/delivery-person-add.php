<?php
include 'class/atclass.php';
$page_title = "Delivery Person";
$page = "delivery-person";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$redirect_link = $page . "-add.php";
$table = "tbl_delivery_person";

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
    <!-- Content Header (Page header) -->
    <div class="login-logo">
      <a href="index.php"><b><?php echo $page_title ?></b></a>
    </div>

    <div class="card">
      <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
        <!-- /.card-header -->
        <div class="card-body login-card-body">

          <div class="row">
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="delivery_person_name" class="form-control" placeholder="Enter Name" required="">
              </div>
            </div>
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="delivery_person_email" class="form-control" placeholder="Enter Email" required="">
              </div>
            </div>
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Mobile</label>
                <input type="number" maxlength="10" minlength="10" name="delivery_person_mobile" class="form-control" placeholder="Enter Mobile No" required="">
              </div>
            </div>
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="delivery_person_password" minlength="6" class="form-control" placeholder="Enter Password" required="">
              </div>
            </div>
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Address</label>
                <textarea name="delivery_person_address" class="form-control" placeholder="Enter Address" required=""></textarea>
              </div>
            </div>
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="delivery_person_image" class="form-control" accept="image/*">


              </div>
            </div>
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <p class="mb-1">
              <a href="index.php">Back To Login?</a>
            </p>
          </div>
        </div>

        <!-- /.card-body -->
      </form>
    </div>
  </div>


  <?php include 'themepart/footer-script.php'; ?>
  <?php
  if (isset($_POST['submit'])) {
    $delivery_person_name = mysqli_real_escape_string($connection, $_POST['delivery_person_name']);
    $delivery_person_email = mysqli_real_escape_string($connection, $_POST['delivery_person_email']);

    $delivery_person_mobile = mysqli_real_escape_string($connection, $_POST['delivery_person_mobile']);
    $delivery_person_password = mysqli_real_escape_string($connection, $_POST['delivery_person_password']);
    $delivery_person_address = mysqli_real_escape_string($connection, $_POST['delivery_person_address']);


    $query_check = mysqli_query($connection, "select lower(delivery_person_email) from $table where delivery_person_email=lower('{$delivery_person_email}')") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query_check);

    if ($count > 0) {
      $msg = "Email Already Exist";
      $alert = "warning";
      include 'class/alert-msg.php';
    } else {


      //folder insert image
      $cphoto = $_FILES['delivery_person_image']['name'];



      if ($cphoto  == "") {
        $cimg = "noimage.png";
      } else {
        $path = $imageupload_path;
        $time = time();
        $destination = $path . $time . basename($cphoto);
        move_uploaded_file($_FILES['delivery_person_image']['tmp_name'], $destination);


        //database insert img name
        $cimg = $time . basename($cphoto);
      }



      $queryins = mysqli_query($connection, "insert into $table(`delivery_person_name`,`delivery_person_email`,`delivery_person_mobile`,`delivery_person_password`,`delivery_person_address`,`delivery_person_image`) VALUES ('{$delivery_person_name}','{$delivery_person_email}','{$delivery_person_mobile}','{$delivery_person_password}','{$delivery_person_address}','{$cimg}')") or die(mysqli_error($connection));

      if ($queryins) {
        $msg = "Your Record Inserted Successfully";
        $alert = "success";
        include 'class/alert-msg.php';
        echo "<script>window.location='index.php';</script>";
      } else {
        $msg = "Your Record Not Inserted";
        $alert = "error";
        include 'class/alert-msg.php';
        echo "<script>window.location='index.php';</script>";
      }
    }
  }
  ?>
  <script>
    $(document).ready(function() {

      // validate signup form on keyup and submit
      $("#myform").validate({
        rules: {

          delivery_person_name: {
            required: true,
            minlength: 2

          },
          delivery_person_email: {
            required: true,
            email: true

          },

          delivery_person_address: {
            required: true
          },
          delivery_person_password: {
            required: true
          },
          delivery_person_mobile: {
            required: true
          }

        },
        messages: {
          delivery_person_email: {
            required: "Please Enter Email",
            emai: "Invalid Email Address"

          },
          delivery_person_name: {
            required: "Please Enter Name",


          },

          delivery_person_address: {
            required: "Please Enter Address"

          },
          delivery_person_password: {
            required: "Please Enter Password"

          },
          delivery_person_mobile: {
            required: "Please Enter Mobile",
            maxlength: "Please enter valid 10 digit mobileno",
            minlength: "Please enter valid 10 digit mobileno"

          }



        }
      });

    });
  </script>

  <?php include 'class/alert-script.php'; ?>
</body>

</html>