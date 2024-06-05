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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin-top: 20px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .invoice-container {
            padding: 1rem;
        }

        .invoice-container .invoice-header .invoice-logo {
            margin: 0.8rem 0 0 0;
            display: inline-block;
            font-size: 1.6rem;
            font-weight: 700;
            color: #2e323c;
        }

        .invoice-container .invoice-header .invoice-logo img {
            max-width: 130px;
        }

        .invoice-container .invoice-header address {
            font-size: 0.8rem;
            color: #9fa8b9;
            margin: 0;
        }

        .invoice-container .invoice-details {
            margin: 1rem 0 0 0;
            padding: 1rem;
            line-height: 180%;
            background: #f5f6fa;
        }

        .invoice-container .invoice-details .invoice-num {
            text-align: right;
            font-size: 0.8rem;
        }

        .invoice-container .invoice-body {
            padding: 1rem 0 0 0;
        }

        .invoice-container .invoice-footer {
            text-align: center;
            font-size: 0.7rem;
            margin: 5px 0 0 0;
        }

        .invoice-status {
            text-align: center;
            padding: 1rem;
            background: #ffffff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .invoice-status h2.status {
            margin: 0 0 0.8rem 0;
        }

        .invoice-status h5.status-title {
            margin: 0 0 0.8rem 0;
            color: #9fa8b9;
        }

        .invoice-status p.status-type {
            margin: 0.5rem 0 0 0;
            padding: 0;
            line-height: 150%;
        }

        .invoice-status i {
            font-size: 1.5rem;
            margin: 0 0 1rem 0;
            display: inline-block;
            padding: 1rem;
            background: #f5f6fa;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
        }

        .invoice-status .badge {
            text-transform: uppercase;
        }

        @media (max-width: 767px) {
            .invoice-container {
                padding: 1rem;
            }
        }


        .custom-table {
            border: 1px solid #e0e3ec;
        }

        .custom-table thead {
            background: #007ae1;
        }

        .custom-table thead th {
            border: 0;
            color: #ffffff;
        }

        .custom-table>tbody tr:hover {
            background: #fafafa;
        }

        .custom-table>tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        .custom-table>tbody td {
            border: 1px solid #e6e9f0;
        }


        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }

        .text-success {
            color: #00bb42 !important;
        }

        .text-muted {
            color: #9fa8b9 !important;
        }

        .custom-actions-btns {
            margin: auto;
            display: flex;
            justify-content: flex-end;
        }

        .custom-actions-btns .btn {
            margin: .3rem 0 .3rem .3rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="invoice-container">
                            <div class="invoice-header">
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="custom-actions-btns mb-5">
                                            <!-- <a href="#" class="btn btn-primary">
                                                <i class="icon-download"></i> Download
                                            </a> -->
                                            <a href="#." class="btn btn-secondary" onclick="PrintDiv();">
                                                <i class="icon-printer"></i> Print
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <a href="index.html" class="invoice-logo">
                                            <?php echo $project_title ?>
                                        </a>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                            <div class="invoice-body" id="divToPrint">
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
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
                                                    <td><?php echo $row_user["user_address"] . ", " . $row_user["city"] . ", " . $row_user["state"]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">

                                            <table class="table custom-table m-0" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Srno</th>
                                                        <th>Product Image</th>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </tr>
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
                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', '');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>

</html>