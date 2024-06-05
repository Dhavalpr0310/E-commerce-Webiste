<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Product Photo";
$page= "product-photo";
$list_link = $page."-list.php";
$add_link = $page."-add.php";
$redirect_link = $page."-add.php";
$table = "tbl_product_photo";

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
                        <label>Image</label>
                        <input type="file" name="photo_path"  class="form-control"  accept="image/*">
                        
                        
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


  
  //folder insert image
  $cphoto = $_FILES['photo_path']['name'];

   
    
  if($cphoto  == "")
  {
     $cimg = "noimage.png"; 
  }
  else{
          $path = $imageupload_path;
 $time = time();
 $destination = $path.$time.basename($cphoto);
    move_uploaded_file($_FILES['photo_path']['tmp_name'], $destination);
 
 
 //database insert img name
  $cimg = $time.basename($cphoto);
  }


  
  $queryins = mysqli_query($connection, "insert into $table(`product_id` ,`photo_path`) VALUES ('{$product_id}','{$cimg}')") or die(mysqli_error($connection));

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
?>
     <script>
              $(document).ready(function () {

                // validate signup form on keyup and submit
                $("#myform").validate({
                    rules: {
                      
                        product_id: {
                            required: true
                        }
                        
                    },
                    messages: {
                      
                        product_id: {
                            required: "Please Select Product"

                        }
                      
                        
                       
                    }
                });

            });
            </script>
             
             <?php include 'class/alert-script.php';?>  
</body>
</html>
