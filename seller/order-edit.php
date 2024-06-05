<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Order";
$page = "order";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$table = "tbl_order_master";
$primary_key = "order_id";
$redirect_link = $page . "-edit.php";
$editid = $_GET['eid'];





if (!isset($_GET['eid']) || empty($_GET['eid'])) {
  header("location:$list_link");
}

$query_list = mysqli_query($connection, "select * from $table  where $primary_key='{$editid}'") or die(mysqli_error($connection));
$row_list = mysqli_fetch_array($query_list);

$query_user = mysqli_query($connection, "select * from tbl_user_master where user_id='{$row_list["user_id"]}'") or die(mysqli_error($connection));
$row_user = mysqli_fetch_array($query_user);

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
                  <h3 class="card-title">Order Information</h3>
                </div>
                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="row">
                      <input type="hidden" class="form-control" name="order_id" value="<?php echo $row_list['order_id']; ?>" required>

                      <table class="table">
                        <tbody>
                          <tr>
                            <td>OrderNo</td>
                            <td>#order-<?php echo $row_list["order_id"]; ?></td>
                          </tr>
                          <tr>
                            <td>Username</td>
                            <td><?php echo $row_user["user_first_name"]; ?></td>

                          </tr>
                          <tr>
                            <td>Order Date</td>
                            <td><?php echo date("d-m-Y", strtotime($row_list["order_date"])); ?></td>
                          </tr>
                          <tr>
                            <td>Order Time</td>
                            <td><?php echo date("h:i A", strtotime($row_list["order_time"])); ?></td>
                          </tr>

                          <tr>
                            <td>Email</td>
                            <td><?php echo $row_user["user_email"]; ?></td>
                          </tr>
                          <tr>
                            <td>Mobile</td>
                            <td><?php echo $row_user["user_mobile"]; ?></td>
                          </tr>
                          <tr>
                            <td>Address</td>
                            <td><?php echo $row_user["user_address"] . " ," . $row_user["city"] . " ," . $row_user["state"]; ?></td>
                          </tr>
                        </tbody>
                      </table>






                    </div>






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
                  <h3 class="card-title">Order Details</h3>
                </div>
                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="row">
                      <input type="hidden" class="form-control" name="order_id" value="<?php echo $row_list['order_id']; ?>" required>

                      <table class="table">
                        <tbody>
                          <thead>
                            <th>Srno</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                          </thead>
                          <?php
                          $query_list = mysqli_query($connection, "select * from tbl_order_details where order_id='{$editid}'") or die(mysqli_error($connection));

                          $total = 0;
                          $x = 1;
                          while ($row = mysqli_fetch_array($query_list)) {

                            $query_product = mysqli_query($connection, "select * from tbl_product_master where product_id='{$row["product_id"]}'") or die(mysqli_error($connection));
                            $row_product = mysqli_fetch_array($query_product);

                            $query_seller = mysqli_query($connection, "select * from tbl_seller where seller_id='{$row["seller_id"]}'") or die(mysqli_error($connection));
                            $row_seller = mysqli_fetch_array($query_seller);
                          ?>
                            <tr>
                              <td><?php echo $x++; ?></td>
                              <td>
                                <?php
                                if ($row_product['product_image'] == "") {
                                ?>
                                  <img src="upload/noimage.png" style="width:50px;hieght:50px;">
                              </td>
                            <?php
                                } else {
                            ?>
                              <img src="<?php echo $imageupload_path; ?><?php echo $row_product['product_image']; ?>" style="width:50px;hieght:50px;"></td>
                            <?php
                                }

                            ?>
                            <td>
                              <?php echo $row_product["product_name"]; ?>
                              <br>
                              <?php
                              if ($row_seller['seller_first_name'] != '') {
                              ?>
                                <b>Seller Name: </b> <?php echo $row_seller['seller_first_name'] . " " . $row_seller['seller_last_name'];  ?>
                              <?php
                              }
                              ?>
                              <?php
                              if ($row_seller['seller_mobile_no'] != '') {
                              ?>
                                (<b>Contact: </b> <?php echo $row_seller['seller_mobile_no'];  ?>)
                              <?php
                              }
                              ?>
                            </td>
                            <td><?php echo $row_product["product_price"]; ?></td>
                            <td><?php echo $row["product_qty"]; ?></td>
                            <td><?php echo $row["product_qty"] * $row_product["product_price"]; ?></td>
                            </tr>
                          <?php

                            $subtotal = $row["product_qty"] * $row_product["product_price"];

                            $total += $subtotal;
                          } ?>



                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="4"></th>
                            <th>Grand Total</th>
                            <td><?php echo $total; ?></td>
                          </tr>
                        </tfoot>
                      </table>






                    </div>






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

    $id = mysqli_real_escape_string($connection, $_POST['order_id']);
    $sub_category_name = mysqli_real_escape_string($connection, $_POST['sub_category_name']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);





    $query_check = mysqli_query($connection, "select lower(sub_category_name) from $table where sub_category_name=lower('{$sub_category_name}')  and NOT $primary_key = '{$id}'") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query_check);

    if ($count > 0) {
      $msg = "Subcategory Name Already Exist";
      $alert = "warning";
      include 'class/alert-msg.php';
    } else {
      //image start
      //product image name
      $cphoto = $_FILES['sub_category_image']['name'];
      $path = 'upload/';
      $time = time();
      $destination = $path . $time . basename($cphoto);


      //product image name
      $cimg = $time . basename($cphoto);


      //product img name
      $cust_photo  = $_POST["cust_photo"];

      if ($cphoto == '') {
        $cimg = $cust_photo;
      } else {
        if ($cust_photo !== '') {
          if (file_exists('upload/' . $cust_photo)) {
            if ($cust_photo == "noimage.png") {
            } else {

              unlink('upload/' . $cust_photo);
            }
          }
        }
        $cimg = $cimg;

        move_uploaded_file($_FILES['sub_category_image']['tmp_name'], $destination);
      }
      //image end




      $queryupdate = mysqli_query($connection, "update $table set `sub_category_name`='{$sub_category_name}',`category_id`='{$category_id}',`sub_category_image`='{$cimg}' where $primary_key='{$id}'") or die(mysqli_error($connection));



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
          sub_category_name: {
            required: true,
            minlength: 2,

          },

          category_id: {
            required: true
          }
        },
        messages: {
          sub_category_name: {
            required: "Please Enter Category Name"

          },
          category_id: {
            required: "Please Select Category"

          }

        }
      });

    });
  </script>
  <?php include 'class/alert-script.php'; ?>

</body>

</html>