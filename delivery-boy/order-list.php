<?php
include '../common/class.php';
include './class/session-check.php';
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
                                                <th>Order No</th>
                                                <th>Username</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Order Status</th>
                                                <th>Total Amount</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_list = mysqli_query($connection, "select * from tbl_order_master where delivery_person_id='{$_SESSION['delivery_person_id']}'  order by order_id desc") or die(mysqli_error($connection));
                                            $x = 1;
                                            while ($row = mysqli_fetch_array($query_list)) {

                                                $query_user = mysqli_query($connection, "select * from tbl_user_master where user_id='{$row["user_id"]}'") or die(mysqli_error($connection));
                                                $row_user = mysqli_fetch_array($query_user);
                                            ?>

                                                <tr>

                                                    <td><?php echo $x++; ?></td>
                                                    <td>#order-<?php echo $row["order_id"]; ?></td>
                                                    <td><?php echo $row_user["user_first_name"] . " " . $row_user["user_last_name"]; ?></td>
                                                    <td><?php echo date("d-m-Y", strtotime($row["order_date"])); ?></td>
                                                    <td><?php echo date("h:i A", strtotime($row["order_time"])); ?></td>
                                                    <td>
                                                        <form method="post" action="#">
                                                            <div class="form-group row">
                                                                <div class="col-sm-8">
                                                                    <input type="hidden" name="order_id" value="<?php echo $row["order_id"]; ?>">
                                                                    <select name="order_status" class="form-control">
                                                                        <option value="<?php echo $row["order_status"]; ?>"><?php echo $row["order_status"]; ?></option>
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
                                                    <td><?php echo $row["total_amount"]; ?></td>



                                                    <td>
                                                        <a href="<?php echo $edit_link; ?>?eid=<?php echo  $row['order_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                                        <!-- <button class="btn btn-danger btn-xs delete_record" type="button" name="submit" value="<?php echo  $row['order_id']; ?>"><i class="fa fa-trash"></i></button> -->
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
        $queryupdate = mysqli_query($connection, "update tbl_order_master set `order_status`='{$order_status}' where order_id='{$id}'") or die(mysqli_error($connection));



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