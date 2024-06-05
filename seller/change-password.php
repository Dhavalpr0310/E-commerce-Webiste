<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Change Password";
$list_link = "dashboard.php";
$add_link = "user-add.php";
$table = "tbl_seller";
$primary_key = "seller_id";

$editid = $admin_id;



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $page_title;?> | <?php echo $project_title;?></title>
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
              
              <li class="breadcrumb-item active"> <?php echo $page_title;?></li>
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
                <h3 class="card-title"> <?php echo $page_title;?></h3>
              </div>
                <form role="form" id="change-password" method="post" action="#" enctype="multipart/form-data">
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
                       <input type="hidden" class="form-control" name="seller_id"  value="<?php echo $seller_id;?>"  required>
                      
                      
                     
                      
                   
                      
                        <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Old Password</label>
                        <input type="password"  name="opass" class="form-control" placeholder="Enter Old Password" required="">
                      </div>
                    </div>
                       
                         <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>New Password</label>
                        <input type="password"  name="npass" id="npass" class="form-control" placeholder="Enter New Password" required="">
                      </div>
                    </div>
                       
                         <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password"  name="cpass" class="form-control" placeholder="Enter Confirm Password" required="">
                      </div>
                    </div>
                      
                    
                  </div>
     
               
                  
                
                  
              
                    
              </div>
              <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
               
<!--                  <button type="submit" class="btn btn-default">Cancel</button>-->
                </div>
              <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
            <!-- general form elements disabled -->
            <button type="button" class="btn btn-success mybtn" style="display:none;">
                  
                  </button>	
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
   if(isset($_POST['submit']))
   {
         $opass = mysqli_real_escape_string($connection ,$_POST['opass']);
     $npass = mysqli_real_escape_string($connection ,$_POST['npass']);
     $cpass = mysqli_real_escape_string($connection ,$_POST['cpass']);
     
     
     
     if ($admin_password == $opass) {
           if ($npass == $cpass) {
   
               if ($npass == $admin_password) {
                $msg = "You have used old password as a new password please choose another.";
                $alert = "warning";
                
                   ?>
                  <script>$(document).ready(function() {
                  $('.mybtn').trigger('click');
                window.setTimeout(function (){
                window.location.href = "change-password.php";},2000);
                
                });</script>
                  <?php 
               } else {
                   
                   
                   $query = mysqli_query($connection, "update $table set seller_password ='{$npass}' where $primary_key='{$editid}'") or die(mysqli_error($connection));
                   
                    if ($query) {
                      $msg = "Your Password Changed Successfully";
                      $alert = "success";
                      
                         ?>
                        <script>$(document).ready(function() {
                        $('.mybtn').trigger('click');
                      window.setTimeout(function (){
                      window.location.href = "change-password.php";},2000);
                      
                      });</script>
                        <?php 
                    }
                   
                   
               }
           } else {
               
            $msg = "Confirm Password Not Match";
            $alert = "warning";
            
               ?>
              <script>$(document).ready(function() {
              $('.mybtn').trigger('click');
            window.setTimeout(function (){
            window.location.href = "change-password.php";},2000);
            
            });</script>
              <?php 
           }
       } else {
          
        $msg = "Old Password Not Matched";
        $alert = "error";
        
           ?>
          <script>$(document).ready(function() {
          $('.mybtn').trigger('click');
        window.setTimeout(function (){
        window.location.href = "change-password.php";},2000);
        
        });</script>
          <?php 
       }
     
     
     
     
   }
?>

         <script>
            //             var jq = $.noConflict();

            $(document).ready(function () {

                // validate signup form on keyup and submit
                $("#change-password").validate({
                    rules: {
                        opass: {
                            required: true,
                           

                        },
                  

                            npass: {
                            required: true,
                             minlength: 6

                        },
                        cpass: {
                            required: true,
                            minlength: 5,
                            equalTo: "#npass"
                        }
                     




                    },
                    messages: {
                        opass: {
                            required: "Please Enter Old Password",

                        },
                      
                      npass: {
                            required: "Please Enter Password",
                           minlength: "Your password must be at least 6 characters long"

                        },
                        cpass: {
                            required: "Please Enter Confirm Password",
                            minlength: "Your password must be at least 6 characters long",
                            equalTo: "Please enter the same password as above"
                    }
//                        mobile: {
//                            required: "Please Enter Your Mobile no.",
//                            minlength: "Enter Your 10 digit Mobile no. only",
//                            maxlength: "Enter Your 10 digit Mobile no. only",
//                        }

                        
                     


                    }
                });

            });

        </script>
<script>

	
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$('.mybtn').click(function() {


Toast.fire({
 type: '<?php echo $alert;?>',

title: '<?php echo $msg;?>'
})
    
  });

    </script>  
</body>
</html>
