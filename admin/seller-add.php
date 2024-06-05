<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Seller Shop Details";
$page = "seller";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$redirect_link = $page . "-add.php";
$table = "tbl_seller";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add <?php echo $page_title; ?> | <?php echo $project_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  include 'themepart/header-script.php';
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php
    include 'themepart/top-header.php';
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include 'themepart/sidebar.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo $page_title; ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo $home_page; ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $list_link; ?>">List <?php echo $page_title; ?></a></li>
                <li class="breadcrumb-item active">Add <?php echo $page_title; ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->

            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add <?php echo $page_title; ?></h3>
                </div>
                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="row">

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="seller_first_name" class="form-control" placeholder="Enter Name" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="seller_email" class="form-control" placeholder="Enter Email" required="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="number" maxlength="10" minlength="10" name="seller_mobile_no" class="form-control" placeholder="Enter Mobile No" required="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="seller_password" minlength="6" class="form-control" placeholder="Enter Password" required="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Gender</label>
                          <select name="seller_gender" class="form-control">
                            <option value="">-Select Gender-</option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Verify</label>
                          <select name="is_verify" class="form-control">
                            <option value="">-Select verify-</option>

                            <option value="1">Yes</option>
                            <option value="0">No</option>

                          </select>
                        </div>
                      </div>


                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Address</label>
                          <textarea name="seller_address" class="form-control" placeholder="Enter Address" required=""></textarea>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Image</label>
                          <input type="file" name="seller_image" class="form-control" accept="image/*">


                        </div>
                      </div>

                    </div>






                  </div>
                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo $list_link; ?>" class="btn btn-info">View</a>

                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
              <!-- /.card -->
              <!-- general form elements disabled -->

              <?php
              include 'class/mybtn.php';
              ?>
              <!-- /.card -->
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'themepart/footer.php'; ?>


  </div>
  <!-- ./wrapper -->


  <?php include 'themepart/footer-script.php'; ?>
  <?php
  if (isset($_POST['submit'])) {
    $seller_first_name = mysqli_real_escape_string($connection, $_POST['seller_first_name']);
    $seller_email = mysqli_real_escape_string($connection, $_POST['seller_email']);
    $seller_gender = mysqli_real_escape_string($connection, $_POST['seller_gender']);
    $seller_mobile_no = mysqli_real_escape_string($connection, $_POST['seller_mobile_no']);
    $seller_password = mysqli_real_escape_string($connection, $_POST['seller_password']);
    $seller_address = mysqli_real_escape_string($connection, $_POST['seller_address']);
    $is_verify = mysqli_real_escape_string($connection, $_POST['is_verify']);


    $query_check = mysqli_query($connection, "select lower(seller_email) from $table where seller_email=lower('{$seller_email}')") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query_check);

    if ($count > 0) {
      $msg = "Email Already Exist";
      $alert = "warning";
      include 'class/alert-msg.php';
    } else {


      //folder insert image
      $cphoto = $_FILES['seller_image']['name'];



      if ($cphoto  == "") {
        $cimg = "noimage.png";
      } else {
        $path = $imageupload_path;
        $time = time();
        $destination = $path . $time . basename($cphoto);
        move_uploaded_file($_FILES['seller_image']['tmp_name'], $destination);


        //database insert img name
        $cimg = $time . basename($cphoto);
      }



      $queryins = mysqli_query($connection, "insert into $table(`seller_first_name`,`seller_email`,`seller_mobile_no`,`seller_password`,`seller_address`,`seller_gender` ,`seller_image`,`is_verify`) VALUES ('{$seller_first_name}','{$seller_email}','{$seller_mobile_no}','{$seller_password}','{$seller_address}','{$seller_gender}','{$cimg}','{$is_verify}')") or die(mysqli_error($connection));

      if ($queryins) {
        $msg = "Your Record Inserted Successfully";
        $alert = "success";
        include 'class/alert-msg.php';
      } else {
        $msg = "Your Record Not Inserted";
        $alert = "error";
        include 'class/alert-msg.php';
      }
    }
  }
  ?>
  <script>
    $(document).ready(function() {

      // validate signup form on keyup and submit
      $("#myform").validate({
        rules: {

          seller_first_name: {
            required: true,
            minlength: 2

          },
          seller_email: {
            required: true,
            email: true

          },
          seller_gender: {
            required: true
          },
          seller_address: {
            required: true
          },
          seller_password: {
            required: true
          },
          seller_mobile_no: {
            required: true
          }

        },
        messages: {
          seller_email: {
            required: "Please Enter Email",
            emai: "Invalid Email Address"

          },
          seller_first_name: {
            required: "Please Enter Name",


          },
          seller_gender: {
            required: "Please Select Gender"

          },
          seller_address: {
            required: "Please Enter Address"

          },
          seller_password: {
            required: "Please Enter Password"

          },
          seller_mobile_no: {
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