<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Delivery Person";
$page= "delivery-person";
$list_link = $page."-list.php";
$add_link = $page."-add.php";
$table = "tbl_delivery_person";
$primary_key = "delivery_person_id";
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
                  <input type="hidden" class="form-control" name="delivery_person_id"  value="<?php echo $row_list['delivery_person_id']; ?>"  required>
                    
                  <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="delivery_person_name" value="<?php echo $row_list['delivery_person_name']; ?>" class="form-control" placeholder="Enter Username" required="">
                      </div>
                    </div>

                  <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="delivery_person_email"   value="<?php echo $row_list['delivery_person_email']; ?>" class="form-control" placeholder="Enter Product Name" required="">
                      </div>
                    </div>

                    
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="number" maxlength="10" minlength="10" name="delivery_person_mobile" value="<?php echo $row_list['delivery_person_mobile'];?>" class="form-control" placeholder="Enter Mobile No" required="">
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="delivery_person_password" minlength="6" value="<?php echo $row_list['delivery_person_password'];?>" class="form-control" placeholder="Enter Password" required="">
                      </div>
                    </div>

                  
                  

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea name="delivery_person_address"  class="form-control" placeholder="Enter Address" required=""><?php echo $row_list['delivery_person_address'];?></textarea>
                      </div>
                    </div>
               
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="delivery_person_image"  class="form-control"  accept="image/*">

                        <input type="hidden" name="cust_photo" value="<?php echo $row_list['delivery_person_image'];?>">
                      </div>
                    </div>
                      
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        
             <a href="<?php echo $imageupload_path.$row_list['delivery_person_image'];?>" target="_blank"><img src="<?php echo $imageupload_path.$row_list['delivery_person_image']; ?>" style="width: 100px;height: 100px;"></a>
                   
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

  $id = mysqli_real_escape_string($connection, $_POST['delivery_person_id']);
  $delivery_person_name = mysqli_real_escape_string($connection, $_POST['delivery_person_name']);
  $delivery_person_email = mysqli_real_escape_string($connection, $_POST['delivery_person_email']);
  
  $delivery_person_mobile = mysqli_real_escape_string($connection, $_POST['delivery_person_mobile']);
  $delivery_person_password = mysqli_real_escape_string($connection, $_POST['delivery_person_password']);
  $delivery_person_address = mysqli_real_escape_string($connection, $_POST['delivery_person_address']);





   $query_check = mysqli_query($connection, "select lower(delivery_person_email) from $table where delivery_person_email=lower('{$delivery_person_email}')  and NOT $primary_key = '{$id}'") or die(mysqli_error($connection));

$count = mysqli_num_rows($query_check);

if($count>0)
{ $msg = "Email Already Exist";
  $alert = "warning";
  include 'class/alert-msg.php';

       
}
  else{
    //image start
  //product image name
  $cphoto = $_FILES['delivery_person_image']['name'];
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
    
      move_uploaded_file($_FILES['delivery_person_image']['tmp_name'], $destination);
      }
  //image end



  
  $queryupdate = mysqli_query($connection, "update $table set `delivery_person_name`='{$delivery_person_name}',`delivery_person_email`='{$delivery_person_email}',`delivery_person_mobile`='{$delivery_person_mobile}',`delivery_person_password`='{$delivery_person_password}',`delivery_person_address`='{$delivery_person_address}',`delivery_person_image`='{$cimg}' where $primary_key='{$id}'") or die(mysqli_error($connection));



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
}
?>

<script>
              $(document).ready(function () {

                // validate signup form on keyup and submit
                $("#myform").validate({
                    rules: {
                      
                      delivery_person_name: {
                            required: true,
                            minlength:2

                        },
                      delivery_person_email: {
                            required: true,
                            email:true

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
                            emai:"Invalid Email Address"

                        },
                        delivery_person_name: {
                            required: "Please Enter Username",
                            

                        },
                      
                        delivery_person_address: {
                            required: "Please Enter Address"

                        },
                        delivery_person_password: {
                            required: "Please Enter Password"

                        },
                        delivery_person_mobile: {
                            required: "Please Enter Mobile",
                            maxlength:"Please enter valid 10 digit mobileno",
                            minlength:"Please enter valid 10 digit mobileno"

                        }
                        
                        
                       
                    }
                });

            });
            </script>
          <?php include 'class/alert-script.php';?>  

</body>
</html>
