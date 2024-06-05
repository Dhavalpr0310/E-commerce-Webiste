<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $project_title;?></title>
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
<!--                <li class="breadcrumb-item"><a href="dashboard.php.php">Home</a></li>-->
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                   <?php
                                   $query_cat = mysqli_query($connection,"select count(*) as cat_total from tbl_category")or die(mysqli_error($connection));
                                         
                                  $total_cat = mysqli_fetch_array($query_cat);                                    
                                    
                                    ?>
                <h3><?php  echo $total_cat["cat_total"];?></h3>

                <p>Total Category</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
                <a href="category-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                    <?php
                                    $query_product = mysqli_query($connection,"select count(*) as product_total from tbl_product_master")or die(mysqli_error($connection));
                                         
                                  $total_product = mysqli_fetch_array($query_product);                                    
                                    
                                    ?>
                <h3><?php   echo $total_product["product_total"];?>
<!--                    <sup style="font-size: 20px">%</sup>-->
                </h3>

                <p>Total Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="product-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                    <?php
                                   $query_user = mysqli_query($connection,"select count(*) as user_total from tbl_user_master ")or die(mysqli_error($connection));
                                         
                               $total_user = mysqli_fetch_array($query_user);                                    
                                    
                                    ?>
                <h3><?php   echo $total_user["user_total"];?></h3>

                <p>Total User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
                <a href="user-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                   <?php
                                    $query_order = mysqli_query($connection,"select count(*) as order_total from tbl_order_master")or die(mysqli_error($connection));
                                         
                                $total_order = mysqli_fetch_array($query_order);                                    
                                    
                                    ?>
                <h3>  <?php   echo $total_order["order_total"];?></h3>

                <p>Total Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="order-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
 
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include 'themepart/footer.php';?>

  <!-- Control Sidebar -->
<!--  <aside class="control-sidebar control-sidebar-dark">
     Control sidebar content goes here 
  </aside>-->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'themepart/footer-script.php';?>
</body>
</html>
