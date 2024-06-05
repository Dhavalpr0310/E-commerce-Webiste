<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "User";
$page= "user";
$list_link = $page."-list.php";
$add_link = $page."-add.php";
$table = "tbl_user_master";
$primary_key = "user_id";
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
                  <input type="hidden" class="form-control" name="user_id"  value="<?php echo $row_list['user_id']; ?>"  required>
                    
                  <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user_first_name" value="<?php echo $row_list['user_first_name']; ?>" class="form-control" placeholder="Enter Username" required="">
                      </div>
                    </div>

                  <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="user_email"   value="<?php echo $row_list['user_email']; ?>" class="form-control" placeholder="Enter Product Name" required="">
                      </div>
                    </div>

                    
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="number" maxlength="10" minlength="10" name="user_mobile" value="<?php echo $row_list['user_mobile'];?>" class="form-control" placeholder="Enter Mobile No" required="">
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="user_password" minlength="6" value="<?php echo $row_list['user_password'];?>" class="form-control" placeholder="Enter Password" required="">
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Gender</label>
                        <select name="user_gender" class="form-control">
                        <option value="<?php echo $row_list['user_gender'];?>"><?php echo $row_list['user_gender'];?></option>
                        
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        
                        </select>
                      </div>
                    </div>
                  

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea name="user_address"  class="form-control" placeholder="Enter Address" required=""><?php echo $row_list['user_address'];?></textarea>
                      </div>
                    </div>
               
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="user_photo"  class="form-control"  accept="image/*">

                        <input type="hidden" name="cust_photo" value="<?php echo $row_list['user_photo'];?>">
                      </div>
                    </div>
                      
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        
             <a href="<?php echo $imageupload_path.$row_list['user_photo'];?>" target="_blank"><img src="<?php echo $imageupload_path.$row_list['user_photo']; ?>" style="width: 100px;height: 100px;"></a>
                   
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

  $id = mysqli_real_escape_string($connection, $_POST['user_id']);
  $user_first_name = mysqli_real_escape_string($connection, $_POST['user_first_name']);
  $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
  $user_gender = mysqli_real_escape_string($connection, $_POST['user_gender']);
  $user_mobile = mysqli_real_escape_string($connection, $_POST['user_mobile']);
  $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
  $user_address = mysqli_real_escape_string($connection, $_POST['user_address']);





   $query_check = mysqli_query($connection, "select lower(user_email) from $table where user_email=lower('{$user_email}')  and NOT $primary_key = '{$id}'") or die(mysqli_error($connection));

$count = mysqli_num_rows($query_check);

if($count>0)
{ $msg = "Email Already Exist";
  $alert = "warning";
  include 'class/alert-msg.php';

       
}
  else{
    //image start
  //product image name
  $cphoto = $_FILES['user_photo']['name'];
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
    
      move_uploaded_file($_FILES['user_photo']['tmp_name'], $destination);
      }
  //image end



  
  $queryupdate = mysqli_query($connection, "update $table set `user_first_name`='{$user_first_name}',`user_email`='{$user_email}',`user_gender`='{$user_gender}',`user_mobile`='{$user_mobile}',`user_password`='{$user_password}',`user_address`='{$user_address}',`user_photo`='{$cimg}' where $primary_key='{$id}'") or die(mysqli_error($connection));



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
                      
                      user_first_name: {
                            required: true,
                            minlength:2

                        },
                      user_email: {
                            required: true,
                            email:true

                        },
                        user_gender: {
                            required: true
                        },
                        user_address: {
                            required: true
                        },
                        user_password: {
                            required: true
                        },
                        user_mobile: {
                            required: true
                        }
                        
                    },
                    messages: {
                      user_email: {
                            required: "Please Enter Email",
                            emai:"Invalid Email Address"

                        },
                        user_first_name: {
                            required: "Please Enter Username",
                            

                        },
                        user_gender: {
                            required: "Please Select Gender"

                        },
                        user_address: {
                            required: "Please Enter Address"

                        },
                        user_password: {
                            required: "Please Enter Password"

                        },
                        user_mobile: {
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
