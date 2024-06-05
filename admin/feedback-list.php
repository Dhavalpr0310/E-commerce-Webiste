<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Feedback";
$page= "feedback";
$list_link = $page."-list.php";
$add_link = $page."-add.php";
$table = "tbl_feedback";
$primary_key = "feedback_id";
$edit_link = $page."-edit.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>List <?php echo $page_title; ?> | <?php echo $project_title; ?></title>
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
                                    <li class="breadcrumb-item active">List <?php echo $page_title; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">List <?php echo $page_title; ?></h3>
                                    <!--<a href="<?php // echo $add_link;?>" class="btn btn-primary float-right">Add <?php // echo $page_title;?></a>-->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <div class="table-responsive">
                                
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Srno</th>
                                             
                                               <th>User Name</th>
                                               <th>Subject</th>
                                               <th>Date</th>
                                               <th>Rating</th>
                                               <th>Message</th>
                                               
                                               
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_list = mysqli_query($connection, "select * from $table  order by $primary_key desc") or die(mysqli_error($connection));


                                            $x = 1;
                                            while ($row = mysqli_fetch_array($query_list)) {
                                            
                                                

                                                $query_user = mysqli_query($connection, "select * from tbl_user_master where user_id='{$row["user_id"]}'") or die(mysqli_error($connection));
                                                $row_user = mysqli_fetch_array($query_user);
                                                ?>

                                                <tr>

                                                    <td><?php echo $x++; ?></td>
                                                    <td><?php echo $row_user["user_first_name"] . " " . $row_user["user_last_name"]; ?></td>
                                                    <td><?php echo $row["feedback_subject"];?></td>
                                                     <td><?php echo date("d-m-Y",strtotime($row["feedback_date"]));?></td>
                                                     
                                                     <td>
                                                           <?php 
                                                           for($j=1;$j<=$row["feedback_rating"];$j++)
                                                           {
                                                               ?>
                                                          <i class="fa fa-star" style="color:orange;"></i>
                                                                                                                         <?php }
                                                          ?>
                                                     </td>
                                                     <td><?php echo $row["feedback_message"];?></td>
                                                     
                                                     
                                                   
                                                    <td><a href="<?php echo $edit_link;?>?eid=<?php echo  $row['feedback_id']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-alt"></i></a>
                                                    <button class="btn btn-danger btn-xs delete_record" type="button" name="submit"  value="<?php echo  $row['feedback_id']; ?>"><i class="fa fa-trash"></i></button>
                                                    </td>
                                    
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                    
                                    </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


            <?php include 'themepart/footer.php'; ?>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <?php include 'themepart/footer-script.php'; ?>
        <!-- page script -->
      

<?php 
include 'class/datatable.php';
include 'class/delete-msg.php';
?>
    </body>
</html>
