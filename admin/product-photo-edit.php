<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Product Photo";
$page= "product-photo";
$list_link = $page."-list.php";
$add_link = $page."-add.php";
$table = "tbl_product_photo";
$primary_key = "product_photo_id";
$redirect_link = $page."-edit.php";
$editid = $_GET['eid'];





if (!isset($_GET['eid']) || empty($_GET['eid'])) {
    header("location:$list_link");
}

$query_list = mysqli_query($connection, "select * from $table  where $primary_key='{$editid}'")or die(mysqli_error($connection));
$row_list = mysqli_fetch_array($query_list);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit <?php echo $page_title;?> | <?php echo $project_title;?></title>
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
              <li class="breadcrumb-item active">Edit <?php echo $page_title;?></li>
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
                <h3 class="card-title">Edit <?php echo $page_title;?></h3>
              </div>
                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body">
              
                  <div class="row">
                  <input type="hidden" class="form-control" name="product_photo_id"  value="<?php echo $row_list['product_photo_id']; ?>"  required>
                    
              
                   
                   
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
                          if($row_product["product_id"] == $row_list["product_id"])
                          {
                           $select = "selected";
                          }
                          else{
                            $select = "";
                          }
                        ?>
                        <option value="<?php echo $row_product["product_id"];?>" <?php echo $select;?>><?php echo $row_product["product_name"];?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
             
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="photo_path"  class="form-control"  accept="image/*">

                        <input type="hidden" name="cust_photo" value="<?php echo $row_list['photo_path'];?>">
                      </div>
                    </div>
                      
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        
             <a href="upload/<?php echo $row_list['photo_path'];?>" target="_blank"><img src="upload/<?php echo $row_list['photo_path']; ?>" style="width: 100px;height: 100px;"></a>
                   
                      </div>
                    </div>
                    
                  </div>
                   
                  
                
                  
              
                    
              </div>
              <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-primary">Update</button>
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
if (isset($_POST['update'])) {

  $id = mysqli_real_escape_string($connection, $_POST['product_photo_id']);
  
  $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
     

    //image start
  //product image name
  $cphoto = $_FILES['photo_path']['name'];
  $path = $imageupload_path;
  $time = time();
  $destination = $path.$time.basename($cphoto);
  

   //product image name
   $cimg = $time.basename($cphoto);
  
   
   //product img name
   $cust_photo  =$_POST["cust_photo"];
       
      if($cphoto=='')
   {
          $cimg =$cust_photo;
      } 
      else{
               if($cust_photo!=='')
    {
     if(file_exists($path.$cust_photo))
             
                                     {
         if($cust_photo == "noimage.png")
         {
             
         }else{
         
                                         unlink($path.$cust_photo);
         }
                                     }
    }                               
                                $cimg =$cimg;
    
      move_uploaded_file($_FILES['photo_path']['tmp_name'], $destination);
      }
  //image end



  
  $queryupdate = mysqli_query($connection, "update $table set `product_id`='{$product_id}',`photo_path`='{$cimg}' where $primary_key='{$id}'") or die(mysqli_error($connection));



  if ($queryupdate) {
    $msg = "Your Record Updated Successfully";
    $alert = "success";
    
    include 'class/alert-msg.php';
     
  }
  else{
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
