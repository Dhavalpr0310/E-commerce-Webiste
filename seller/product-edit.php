<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Product";
$page = "product";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$table = "tbl_product_master";
$primary_key = "product_id";
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
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .display_seller {
      display: none;
    }
  </style>
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
                      <input type="hidden" class="form-control" name="product_id" value="<?php echo $row_list['product_id']; ?>" required>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Product Name</label>
                          <input type="text" name="product_name" value="<?php echo $row_list['product_name']; ?>" class="form-control" placeholder="Enter Product Name" required="">
                        </div>
                      </div>
                      <!-- <div class="col-sm-3">
                      
                      <div class="form-group">
                        <label>Product QTY</label>
                        <input type="number" min="1" name="product_quantity" value="<?php  //echo $row_list['product_quantity']; 
                                                                                    ?>"  class="form-control" placeholder="Enter Product QTY" required="">
                      </div>
                    </div> -->

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Product Price</label>
                          <input type="number" min="1" name="product_price" value="<?php echo $row_list['product_price']; ?>" class="form-control" placeholder="Enter Product Price" required="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Category</label>
                          <select name="category_id" class="form-control">
                            <option value="">Select</option>
                            <?php
                            $query_cat = mysqli_query($connection, "SELECT * FROM `tbl_category`") or die(mysqli_error($connection));
                            while ($row_cat = mysqli_fetch_array($query_cat)) {
                              if ($row_cat["category_id"] == $row_list["category_id"]) {
                                $select = "selected";
                              } else {
                                $select = "";
                              }
                            ?>
                              <option value="<?php echo $row_cat["category_id"]; ?>" <?php echo $select; ?>><?php echo $row_cat["category_name"]; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3 display_seller">

                        <!-- text input -->
                        <div class="form-group">
                          <label>Seller</label>
                          <select class="select2" multiple="multiple" name="seller_id[]" id="seller_id" data-placeholder="Select Seller" required style="width: 100%;">

                            <?php
                            $query_seller_product = mysqli_query($connection, "SELECT * FROM `tbl_seller_product` where product_id='{$row_list["product_id"]}'") or die(mysqli_error($connection));
                            foreach ($query_seller_product as $seller_details) {
                              $seller_id[] = $seller_details['seller_id'];
                            }
                            $query_seller = mysqli_query($connection, "SELECT * FROM `tbl_seller`") or die(mysqli_error($connection));
                            while ($row_seller = mysqli_fetch_array($query_seller)) {

                              $selected = in_array($row_seller['seller_id'], $seller_id) ? "selected" : "";
                            ?>
                              <option value="<?php echo $row_seller["seller_id"]; ?>" <?php echo $selected; ?>><?php echo $row_seller["seller_first_name"] . " " . $row_seller["seller_last_name"]; ?></option>
                            <?php } ?>
                          </select>
                          <label id="seller_id-error" class="error" for="seller_id"></label>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Product Details</label>
                          <textarea name="product_details" class="form-control" placeholder="Enter Product Details" required=""><?php echo $row_list["product_details"]; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Image</label>
                          <input type="file" name="product_image" class="form-control" accept="image/*">

                          <input type="hidden" name="cust_photo" value="<?php echo $row_list['product_image']; ?>">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">

                          <a href="<?php echo $imageupload_path.$row_list['product_image']; ?>" target="_blank"><img src="<?php echo $imageupload_path.$row_list['product_image']; ?>" style="width: 100px;height: 100px;"></a>

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
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <?php
  if (isset($_POST['update'])) {

    $id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
    // $product_quantity = mysqli_real_escape_string($connection, $_POST['product_quantity']);
    $product_quantity = "1";
    $product_price = mysqli_real_escape_string($connection, $_POST['product_price']);
    $product_details = mysqli_real_escape_string($connection, $_POST['product_details']);




    $query_check = mysqli_query($connection, "select lower(product_name) from $table where product_name=lower('{$product_name}')  and NOT $primary_key = '{$id}'") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query_check);

    if ($count > 0) {
      $msg = "Product Name Already Exist";
      $alert = "warning";
      include 'class/alert-msg.php';
    } else {
      //image start
      //product image name
      $cphoto = $_FILES['product_image']['name'];
      $path = $imageupload_path;
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
          if (file_exists($path. $cust_photo)) {
            if ($cust_photo == "noimage.png") {
            } else {

              unlink($path. $cust_photo);
            }
          }
        }
        $cimg = $cimg;

        move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
      }
      //image end

      $is_seller_all = mysqli_real_escape_string($connection, 1);


      $queryupdate = mysqli_query($connection, "update $table set `is_seller_all`='{$is_seller_all}',`product_details`='{$product_details}',`product_price`='{$product_price}',`product_quantity`='{$product_quantity}',`product_name`='{$product_name}',`category_id`='{$category_id}',`product_image`='{$cimg}' where $primary_key='{$id}'") or die(mysqli_error($connection));



      if ($queryupdate) {

        $last_id  = $id;
        $query_delete = mysqli_query($connection, "DELETE FROM `tbl_seller_product` WHERE `product_id`='{$last_id}'");
        if ($query_delete) {
          if ($is_seller_all == "1") {
            $query_seller = mysqli_query($connection, "SELECT * FROM `tbl_seller` order by `seller_id` asc");
            while ($row_seller = mysqli_fetch_array($query_seller)) {
              $insert_seller = mysqli_query($connection, "INSERT INTO `tbl_seller_product`(`product_id`, `seller_id`) VALUES ('{$last_id}','{$row_seller["seller_id"]}')");
            }
          } else {
            for ($d = 0; $d < count($_POST['seller_id']); $d++) {
              $seller_id =  $_POST['seller_id'][$d];
              $insert_seller = mysqli_query($connection, "INSERT INTO `tbl_seller_product`(`product_id`, `seller_id`) VALUES ('{$last_id}','{$seller_id}')");
            }
          }
          if ($insert_seller) {
            $msg = "Your Record Updated Successfully";
            $alert = "success";

            include 'class/alert-msg.php';
          }
        }
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
      $('.select2').select2();
      display_seller();
      // validate signup form on keyup and submit
      $("#myform").validate({
        rules: {
          product_name: {
            required: true,
            minlength: 2

          },
          category_id: {
            required: true
          },
          product_details: {
            required: true
          },
          product_price: {
            required: true
          },
          // product_quantity: {
          //     required: true
          // }

          seller_id: {
            required: true
          },
          is_seller_all:{
            required: true
          }
        },
        messages: {
          product_name: {
            required: "Please Enter Product Name"

          },
          category_id: {
            required: "Please Enter Select Category"

          },
          product_details: {
            required: "Please Enter Product Details"

          },
          product_price: {
            required: "Please Enter Product Price"

          },
          seller_id: {
            required: "Please Select Seller"

          },
          is_seller_all: {
            required: "Please Select This"

          },
          // product_quantity: {
          //     required: "Please Enter Product QTY"

          // }



        }
      });

    });

    function display_seller() {
      var is_seller_all = $("#is_seller_all").val();

      if (is_seller_all == "0") {
        $(".display_seller").show();

      } else {
        $(".display_seller").hide();
      }
    }
  </script>
  <?php include 'class/alert-script.php'; ?>

</body>

</html>