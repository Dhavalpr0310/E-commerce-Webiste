<?php
require 'class/atclass.php';
$page_title = "User Wise Order Report";

?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?> | <?php echo $project_title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>
    <center>
        <h3><?php echo $project_title; ?></h3>
    </center>

    <center>
        <h2><?php echo $page_title ?></h2>
    </center>
    <hr />

    <a href="#" onclick="window.print();">Print</a>
    <br>


    <?php

    echo " Date:" . date("d-m-Y");

    ?>

    <form method="get">

        <select name='id' required>
            <option value=''>-Select User-</option>
            <?php
            $query_list = mysqli_query($connection, "SELECT * FROM `tbl_user_master`") or die(mysqli_error($connection));
            while ($row_list = mysqli_fetch_array($query_list)) {
                if (isset($_GET["id"])) {
                    if ($row_list["user_id"] == $_GET["id"]) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                } else {
                    $select = "";
                }

            ?>
                <option value="<?php echo $row_list["user_id"]; ?>" <?php echo $select; ?>><?php echo $row_list["user_first_name"]; ?></option>
            <?php } ?>
        </select>

        <input type="submit">
    </form>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $search = "where tbl_order_master.user_id='{$id}'";
    } else {

        $search = "";
    }

    $query = mysqli_query($connection, "select * from tbl_order_master inner join tbl_order_details on tbl_order_master.order_id=tbl_order_details.order_id  $search") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query);
    ?>
    <br />
    <center><?php
            if ($count == "0") {
                echo "No";
            } else {
                echo $count;
            } ?> Records Found</center>
    <br />
    <?php
    if ($count > 0) {
    ?>

        <table align='center' style='text-align:center;' width='100%' border='1'>
            <tr>
                <th>Srno</th>

                <th>Order No</th>
                <th>User Name</th>

                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>






            </tr>
            <?php
            $x = "1";
            $total = 0;
            while ($row = mysqli_fetch_array($query)) {

                $query_user = mysqli_query($connection, "SELECT * FROM `tbl_user_master` where user_id ='{$row["user_id"]}'") or die(mysqli_error($connection));
                $row_user = mysqli_fetch_array($query_user);

                $query_product = mysqli_query($connection, "SELECT * FROM `tbl_product_master` where product_id ='{$row["product_id"]}'") or die(mysqli_error($connection));
                $row_product = mysqli_fetch_array($query_product);
            ?>
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>#OrderNo.<?php echo $row['order_id']; ?></td>
                    <td><?php echo $row_user['user_first_name']; ?></td>


                    <td><?php echo $row_product['product_name']; ?></td>
                    <td><?php echo $row_product['product_price']; ?></td>
                    <td><?php echo $row['product_qty']; ?></td>
                    <td><?php echo $row['product_qty'] * $row_product['product_price']; ?></td>
                    <?php $total += ($row['product_qty'] * $row_product['product_price']) ?>
                </tr>
            <?php
            }
            ?>
        </table>
        <h2>
            Total Rs :
            <?php
            echo $total;
            ?>
        </h2>
    <?php

    } else {
        // echo "No Records Found";
    }

    ?>
</body>

</html>