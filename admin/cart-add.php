<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Cart";
$page= "cart";
$list_link = $page."-list.php";
$add_link = $page."-add.php";
$redirect_link = $page."-add.php";
$table = "tbl_cart";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add <?php echo $page_title;?> | <?php echo $project_title;?></title>
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
            <h1><?php echo $page_title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $home_page;?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo $list_link;?>">List <?php echo $page_title;?></a></li>
              <li class="breadcrumb-item active">Add <?php echo $page_title;?></li>
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
                <h3 class="card-title">Add <?php echo $page_title;?></h3>
              </div>
                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body">
              
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" class="form-control">
                        <option value="">-Select Product-</option>
                        <?php 
                        $query_product = mysqli_query($connection,"SELECT * FROM `tbl_product_master`")or die(mysqli_error($connection));
                        while($row_product = mysqli_fetch_array($query_product))
                        {
                        ?>
                        <option value="<?php echo $row_product["product_id"];?>"><?php echo $row_product["product_name"];?></option>
                        <?php } ?>
                        </select>
                        
                      </div>
                    </div>


                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>User</label>
                        <select name="user_id" class="form-control">
                        <option value="">-Select User-</option>
                        <?php 
                        $query_user = mysqli_query($connection,"SELECT * FROM `tbl_user_master`")or die(mysqli_error($connection));
                        while($row_user = mysqli_fetch_array($query_user))
                        {
                        ?>
                        <option value="<?php echo $row_user["user_id"];?>"><?php echo $row_user["user_first_name"] . " " . $row_user["user_last_name"]; ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Qty</label>
                        <input type="number" min="1" max="3" name="product_qty"  class="form-control" placeholder="Enter Product Qty" required="">
                      </div>
                    </div>

                    
                  </div>
                   
                  
                
                  
              
                    
              </div>
              <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <a href="<?php echo $list_link;?>" class="btn btn-info">View</a>

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
<?php include 'themepart/footer.php';?>


</div>
<!-- ./wrapper -->


<?php include 'themepart/footer-script.php';?>
<?php
if (isset($_POST['submit'])) {
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
  $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
  $product_qty = mysqli_real_escape_string($connection, $_POST['product_qty']);

  $query_check = mysqli_query($connection, "select * from $table where product_id='{$product_id}' and user_id='{$user_id}'") or die(mysqli_error($connection));

$count = mysqli_num_rows($query_check);

if($count>0)
{
  $msg = "Product Already Added In Cart";
  $alert = "warning";
  include 'class/alert-msg.php';
  
}
else{




  
  $queryins = mysqli_query($connection, "insert into $table(`product_id`,`user_id` ,`product_qty`,`product_name`,`product_details`,`product_image`,`product_price`,`product_unit_price`) VALUES ('{$product_id}','{$user_id}','{$product_qty}','','','','','')") or die(mysqli_error($connection));

  if ($queryins) {
    $msg = "Your Record Inserted Successfully";
    $alert = "success";
    include 'class/alert-msg.php';
        
  } else {
    $msg = "Your Record Not Inserted";
    $alert= "error";
    include 'class/alert-msg.php';
       
  }
}
}
?>
     <script>
              $(document).ready(function () {

                // validate signup form on keyup and submit
                $("#myform").validate({
                    rules: {
                      product_id: {
                            required: true
                         

                        },
                        user_id: {
                            required: true
                        },
                        product_qty: {
                            required: true
                        },
                        
                        
                    },
                    messages: {
                      product_id: {
                            required: "Please Select Product"

                        },
                        user_id: {
                            required: "Please Select User"

                        },
                        product_qty: {
                            required: "Please Enter Product QTY"

                        },
                        
                       
                    }
                });

            });
            </script>
             
             <?php include 'class/alert-script.php';?>  
</body>
</html>
