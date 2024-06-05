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
$redirect_link = $page . "-edit.php";
$editid = $_GET['print_id'];





if (!isset($_GET['print_id']) || empty($_GET['print_id'])) {
    header("location:$list_link");
}

$query_list = mysqli_query($connection, "select * from $table  where $primary_key='{$editid}'") or die(mysqli_error($connection));
$row_list = mysqli_fetch_array($query_list);

$query_user = mysqli_query($connection, "select * from tbl_user_master where user_id='{$row_list["user_id"]}'") or die(mysqli_error($connection));
$row_user = mysqli_fetch_array($query_user);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?> | <?php echo $project_title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    include 'themepart/header-script.php';
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div>
        <input type="button" value="print" onclick="PrintDiv();" />
    </div>
    <div class="container mt-5" id="divToPrint">
        <!-- Navbar -->


        <!-- Content Wrapper. Contains page content -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Order Information</h3>
                            </div>
                            <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <div class="row">
                                        <input type="hidden" class="form-control" name="order_id" value="<?php echo $row_list['order_id']; ?>" required>

                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>OrderNo</td>
                                                    <td>#order-<?php echo $row_list["order_id"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Username</td>
                                                    <td><?php echo $row_user["user_first_name"]; ?></td>

                                                </tr>
                                                <tr>
                                                    <td>Order Date</td>
                                                    <td><?php echo date("d-m-Y", strtotime($row_list["order_date"])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Order Time</td>
                                                    <td><?php echo date("h:i A", strtotime($row_list["order_time"])); ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Email</td>
                                                    <td><?php echo $row_user["user_email"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile</td>
                                                    <td><?php echo $row_user["user_mobile"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td><?php echo $row_user["user_address"]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>






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
                                <h3 class="card-title">Order Details</h3>
                            </div>
                            <form role="form" id="myform" method="post" action="#" enctype="multipart/form-data">
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <div class="row">
                                        <input type="hidden" class="form-control" name="order_id" value="<?php echo $row_list['order_id']; ?>" required>

                                        <table class="table">
                                            <thead>
                                                <th>Srno</th>
                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query_list = mysqli_query($connection, "select * from tbl_order_details where order_id='{$editid}'") or die(mysqli_error($connection));

                                                $total = 0;
                                                $x = 1;
                                                while ($row = mysqli_fetch_array($query_list)) {

                                                    $query_product = mysqli_query($connection, "select * from tbl_product_master where product_id='{$row["product_id"]}'") or die(mysqli_error($connection));
                                                    $row_product = mysqli_fetch_array($query_product);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $x++; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($row_product['product_image'] == "") {
                                                            ?>
                                                                <img src="upload/noimage.png" style="width:50px;hieght:50px;">
                                                        </td>
                                                    <?php
                                                            } else {
                                                    ?>
                                                        <img src="<?php echo $imageupload_path; ?><?php echo $row_product['product_image']; ?>" style="width:50px;hieght:50px;"></td>
                                                    <?php
                                                            }

                                                    ?>
                                                    <td><?php echo $row_product["product_name"]; ?></td>
                                                    <td><?php echo $row_product["product_price"]; ?></td>
                                                    <td><?php echo $row["product_qty"]; ?></td>
                                                    <td><?php echo $row["product_qty"] * $row_product["product_price"]; ?></td>
                                                    </tr>
                                                <?php

                                                    $subtotal = $row["product_qty"] * $row_product["product_price"];

                                                    $total += $subtotal;
                                                } ?>



                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th>Grand Total</th>
                                                    <td><?php echo $total; ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>






                                    </div>






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


    </div>
    <!-- ./wrapper -->


    <?php include 'themepart/footer-script.php'; ?>

    <script type="text/javascript">
        function PrintDiv() {
            var divToPrint = document.getElementById('divToPrint');
            var popupWin = window.open('', '_blank', '');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
    </script>
    <?php include 'class/alert-script.php'; ?>

</body>

</html>