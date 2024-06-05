<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Brand";
$page = "brand";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$table = "tbl_brand";
$primary_key = "brand_id";
$redirect_link = $page . "-edit.php";
$editid = $_GET['eid'];





if (!isset($_GET['eid']) || empty($_GET['eid'])) {
  header("location:$list_link");
}

$query_list = mysqli_query($connection, "select * from $table  where $primary_key='{$editid}'") or die(mysqli_error($connection));
$row_list = mysqli_fetch_array($query_list);


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit <?php echo $page_title; ?> | <?php echo $project_title; ?></title>
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
                <li class="breadcrumb-item active">Edit <?php echo $page_title; ?></li>
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
                  <h3 class="card-title">Edit <?php echo $page_title; ?></h3>
                </div>
                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="row">
                      <input type="hidden" class="form-control" name="brand_id" value="<?php echo $row_list['brand_id']; ?>" required>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="brand_name" value="<?php echo $row_list['brand_name']; ?>" class="form-control" placeholder="Enter Category Name" required="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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
  if (isset($_POST['update'])) {

    $id = mysqli_real_escape_string($connection, $_POST['brand_id']);
    $brand_name = mysqli_real_escape_string($connection, $_POST['brand_name']);
    $query_check = mysqli_query($connection, "select lower(brand_name) from $table where brand_name=lower('{$brand_name}')  and NOT $primary_key = '{$id}'") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query_check);

    if ($count > 0) {
      $msg = "Category Name Already Exist";
      $alert = "warning";
      include 'class/alert-msg.php';
    } else {

      $queryupdate = mysqli_query($connection, "update $table set `brand_name`='{$brand_name}' where $primary_key='{$id}'") or die(mysqli_error($connection));

      if ($queryupdate) {
        $msg = "Your Record Updated Successfully";
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
          brand_name: {
            required: true,
            minlength: 2,

          }
        },
        messages: {
          brand_name: {
            required: "Please Enter Category Name"

          }

        }
      });

    });
  </script>
  <?php include 'class/alert-script.php'; ?>

</body>

</html>