<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Product";
$page = "product";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$redirect_link = $page . "-add.php";
$table = "tbl_product_master";

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

<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .display_seller{
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
                          <label>Product Name</label>
                          <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                      
                      <div class="form-group">
                        <label>Product QTY</label>
                        <input type="number" min="1" name="product_quantity"  class="form-control" placeholder="Enter Product QTY" required="">
                      </div>
                    </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Product Price</label>
                          <input type="number" min="1" name="product_price" class="form-control" placeholder="Enter Product Price" required="">
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
                            ?>
                              <option value="<?php echo $row_cat["category_id"]; ?>"><?php echo $row_cat["category_name"]; ?></option>
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
                            $query_seller = mysqli_query($connection, "SELECT * FROM `tbl_seller`") or die(mysqli_error($connection));
                            while ($row_seller = mysqli_fetch_array($query_seller)) {
                            ?>
                              <option value="<?php echo $row_seller["seller_id"]; ?>"><?php echo $row_seller["seller_first_name"] . " " . $row_seller["seller_last_name"]; ?></option>
                            <?php } ?>
                          </select>
                          <label id="seller_id-error" class="error" for="seller_id"></label>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Product Details</label>
                          <textarea name="product_details" class="form-control" placeholder="Enter Product Details" required=""></textarea>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Image</label>
                          <input type="file" name="product_image" class="form-control" accept="image/*">


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
  
  <!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script><!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <?php
  if (isset($_POST['submit'])) {
    $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
    $product_quantity = mysqli_real_escape_string($connection, $_POST['product_quantity']);
    $product_price = mysqli_real_escape_string($connection, $_POST['product_price']);
    $product_details = mysqli_real_escape_string($connection, $_POST['product_details']);


    $query_check = mysqli_query($connection, "select lower(product_name) from $table where product_name=lower('{$product_name}')") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query_check);

    if ($count > 0) {
      $msg = "Product Name Already Exist";
      $alert = "warning";
      include 'class/alert-msg.php';
    } else {


      //folder insert image
      $cphoto = $_FILES['product_image']['name'];



      if ($cphoto  == "") {
        $cimg = "noimage.png";
      } else {
        $path = $imageupload_path;
        $time = time();
        $destination = $path . $time . basename($cphoto);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);


        //database insert img name
        $cimg = $time . basename($cphoto);
      }
       $is_seller_all = mysqli_real_escape_string($connection, 1);

      $queryins = mysqli_query($connection, "insert into $table(`product_name`,`product_quantity`,`product_price`,`product_details`,`category_id` ,`product_image`,`is_seller_all`) VALUES ('{$product_name}','{$product_quantity}','{$product_price}','{$product_details}','{$category_id}','{$cimg}','{$is_seller_all}')") or die(mysqli_error($connection));

      if ($queryins) {
      $last_id  =mysqli_insert_id($connection);
        if($is_seller_all =="1") 
        {
          $query_seller = mysqli_query($connection,"SELECT * FROM `tbl_seller` order by `seller_id` asc");
          while($row_seller =mysqli_fetch_array($query_seller))
          {
            $insert_seller = mysqli_query($connection,"INSERT INTO `tbl_seller_product`(`product_id`, `seller_id`) VALUES ('{$last_id}','{$row_seller["seller_id"]}')");
          }
        }
        else{
          for ($d = 0; $d < count($_POST['seller_id']); $d++) {
          $seller_id=  $_POST['seller_id'][$d];
            $insert_seller = mysqli_query($connection,"INSERT INTO `tbl_seller_product`(`product_id`, `seller_id`) VALUES ('{$last_id}','{$seller_id}')");
          }

        }
        if($insert_seller)
        {

        $msg = "Your Record Inserted Successfully";
        $alert = "success";
        include 'class/alert-msg.php';
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
    //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // });
    $(document).ready(function() {
      //Initialize Select2 Elements
      $('.select2').select2();

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

          seller_id: {
            required: true
          },
          is_seller_all:{
            required: true
          }
          // product_quantity: {
          //     required: true
          // }

        },
        messages: {
          product_name: {
            required: "Please Enter Product Name"

          },
          category_id: {
            required: "Please Select Category"

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
          product_quantity: {
              required: "Please Enter Product QTY"

          }



        }
      });

    });

    function display_seller()
    {
      var is_seller_all=$("#is_seller_all").val();
      
      if(is_seller_all=="0")
      {
        $(".display_seller").show();
        
      }
      else{
        $(".display_seller").hide();
      }
    }
  </script>

  <?php include 'class/alert-script.php'; ?>
</body>

</html>