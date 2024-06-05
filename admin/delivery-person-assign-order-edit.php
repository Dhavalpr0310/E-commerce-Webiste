<?php
include 'class/session-start.php';
include 'class/atclass.php';
include 'class/session-check.php';
$page_title = "Order Assign Edit";
$page = "delivery-person-assign-order";
$list_link = $page . "-list.php";
$add_link = $page . ".php";
$table = "tbl_order_master";
$primary_key = "order_id";
$redirect_link = $page . "-edit.php";
$editid = $_GET['eid'];



if (!isset($_GET['eid']) || empty($_GET['eid'])) {
    header("location:$list_link");
}

$query_list = mysqli_query($connection, "select * from $table  where $primary_key='{$editid}'") or die(mysqli_error($connection));
$row_list = mysqli_fetch_array($query_list);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit <?php echo $page_title; ?> | <?php echo $project_title; ?></title>
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
                                <li class="breadcrumb-item"><a href="<?php echo $list_link; ?>">List <?php echo $page_title; ?></a></li>
                                <li class="breadcrumb-item active">Edit <?php echo $page_title; ?></li>
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
                                    <h3 class="card-title">Edit <?php echo $page_title; ?></h3>
                                </div>
                                <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <div class="row">
                                            <input type="hidden" class="form-control" name="order_id" value="<?php echo $row_list['order_id']; ?>" required>

                                            <div class="col-sm-3">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Order</label>
                                                    <select name="order_id" id="order_id" class="form-control select2" disabled>
                                                        <?php

                                                        $order = mysqli_query($connection, 'SELECT *FROM tbl_order_master WHERE `order_status`!="Cancelled" AND `order_status`!="Completed"');
                                                        foreach ($order as $item) {
                                                            if ($row_list['order_id'] == $item['order_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option value='{$item['order_id']}' $selected>#order-{$item['order_id']}</option>";
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Delivery Person</label>
                                                    <select name="delivery_person_id" id="delivery_person_id" class="form-control select2">
                                                        <?php
                                                        $order = mysqli_query($connection, 'SELECT *FROM tbl_delivery_person');
                                                        foreach ($order as $item) {
                                                            if ($row_list['delivery_person_id'] == $item['delivery_person_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option value='{$item['delivery_person_id']}' $selected>{$item['delivery_person_name']}</option>";
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        <a href="<?php echo $list_link; ?>" class="btn btn-info">View</a>

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
        <?php include 'themepart/footer.php'; ?>


    </div>
    <!-- ./wrapper -->


    <?php include 'themepart/footer-script.php'; ?>

    <?php
    if (isset($_POST['update'])) {

        $delivery_person_id = mysqli_real_escape_string($connection, $_POST['delivery_person_id']);
        $order_id = mysqli_real_escape_string($connection, $_POST['order_id']);

        $query_check = mysqli_query($connection, "UPDATE `tbl_order_master` SET `delivery_person_id`='{$delivery_person_id}' WHERE order_id='{$order_id}'") or die(mysqli_error($connection));

        if ($query_check) {
            $msg = "Order Assign Successfully";
            $alert = "success";
            include 'class/alert-msg.php';
        } else {

            $msg = "Something want wrong please try after some time letter.";
            $alert = "error";
            include 'class/alert-msg.php';
        }
    }
    ?>

    <script>
        $(document).ready(function() {

            // validate signup form on keyup and submit
            $("#myform").validate({
                rules: {

                    delivery_person_name: {
                        required: true,
                        minlength: 2

                    },
                    delivery_person_email: {
                        required: true,
                        email: true

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
                        emai: "Invalid Email Address"

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
                        maxlength: "Please enter valid 10 digit mobileno",
                        minlength: "Please enter valid 10 digit mobileno"

                    }



                }
            });

        });
    </script>
    <?php include 'class/alert-script.php'; ?>

</body>

</html>