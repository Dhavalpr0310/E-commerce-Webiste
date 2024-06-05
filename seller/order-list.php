<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Order";
$page = "order";
$list_link = $page . "-list.php";
$add_link = $page . "-add.php";
$table = "tbl_order_master";
$primary_key = "order_id";
$edit_link = $page . "-edit.php";
$redirect_link = $page . "-list.php";

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

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Srno</th>
                                                <th>Product Name</th>
                                                <th>Order No</th>
                                                <th>Username</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Total Amount</th>
                                                <th style="width: 30%;">Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_list = mysqli_query($connection, "select * from tbl_order_details where seller_id='{$_SESSION['seller_id']}'  order by order_details_id desc") or die(mysqli_error($connection));
                                            $x = 1;
                                            while ($row = mysqli_fetch_array($query_list)) {
                                                $query_order = mysqli_query($connection, "select * from tbl_order_master where order_id='{$row["order_id"]}'") or die(mysqli_error($connection));
                                                $row_order = mysqli_fetch_array($query_order);
                                                $query_user = mysqli_query($connection, "select * from tbl_user_master where user_id='{$row_order["user_id"]}'") or die(mysqli_error($connection));
                                                $row_user = mysqli_fetch_array($query_user);
                                                $query_product = mysqli_query($connection, "select * from tbl_product_master where product_id='{$row["product_id"]}'") or die(mysqli_error($connection));
                                                $row_product = mysqli_fetch_array($query_product);
                                            ?>

                                                <tr>

                                                    <td><?php echo $x++; ?></td>
                                                    <td><?php echo $row_product['product_name']; ?></td>
                                                    <td>#order-<?php echo $row_order["order_id"]; ?></td>
                                                    <td><?php echo $row_user["user_first_name"] . " " . $row_user["user_last_name"]; ?></td>
                                                    <td><?php echo date("d-m-Y", strtotime($row_order["order_date"])); ?></td>
                                                    <td><?php echo date("h:i A", strtotime($row_order["order_time"])); ?></td>
                                                    <td><?php echo $row["total_amount"]; ?></td>
                                                    <td>
                                                        <form method="post" action="#">
                                                            <div class="form-group row">
                                                                <div class="col-sm-8">
                                                                    <input type="hidden" name="order_id" value="<?php echo $row_order["order_id"]; ?>">
                                                                    <select name="order_status" class="form-control">
                                                                        <option value="<?php echo $row_order["order_status"]; ?>"><?php echo $row_order["order_status"]; ?></option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="Accepted">Accepted</option>
                                                                        <option value="Ongoing">Ongoing</option>
                                                                        <option value="Completed">Completed</option>
                                                                        <option value="Cancelled">Cancelled</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <button type="submit" name="update" class="btn btn-info btn-sm">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </td>
                                                    <td>
                                                    <a href="<?php echo $edit_link; ?>?eid=<?php echo  $row['order_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
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
        <?php
        include 'class/mybtn.php';
        ?>

        <?php include 'themepart/footer.php'; ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include 'themepart/footer-script.php'; ?>
    <!-- page script -->

    <?php
    if (isset($_POST['update'])) {

        $id = mysqli_real_escape_string($connection, $_POST['order_id']);
        $order_status = mysqli_real_escape_string($connection, $_POST['order_status']);



        $queryupdate = mysqli_query($connection, "update $table set `order_status`='{$order_status}' where $primary_key='{$id}'") or die(mysqli_error($connection));



        if ($queryupdate) {
            $msg = "Your Record Updated Successfully";
            $alert = "success";

            include 'class/alert-msg.php';
        } else {
            $msg = "Your Record Not Inserted";
            $alert = "error";
            include 'class/alert-msg.php';
        }
    }
    ?>
    <?php
    include 'class/datatable.php';
    include 'class/delete-msg.php';
    ?>
    <?php include 'class/alert-script.php'; ?>
</body>

</html>