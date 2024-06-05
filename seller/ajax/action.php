<?php
include '../class/atclass.php';


if (isset($_POST["action"])) {

       if ($_POST["action"] == 'delete') {

              $id = mysqli_real_escape_string($connection, $_POST['id']);
              $tbl_name = mysqli_real_escape_string($connection, $_POST['tbl_name']);
              $field_name = mysqli_real_escape_string($connection, $_POST['field_name']);



              $deleteq = mysqli_query($connection, "DELETE FROM $tbl_name WHERE  $field_name='{$id}'") or die(mysqli_error($connection));

              //  $deleteq = mysqli_query($connection, "UPDATE $tbl_name SET is_delete='1' WHERE  $field_name='{$id}'")or die(mysqli_error($connection));

       }

       if ($_POST["action"] == 'block') {

              $id = mysqli_real_escape_string($connection, $_POST['id']);
              $tbl_name = mysqli_real_escape_string($connection, $_POST['tbl_name']);
              $field_name = mysqli_real_escape_string($connection, $_POST['field_name']);

              $deleteq = mysqli_query($connection, "UPDATE $tbl_name SET is_block='1' WHERE  $field_name='{$id}'") or die(mysqli_error($connection));
       }
       if ($_POST["action"] == 'unblock') {

              $id = mysqli_real_escape_string($connection, $_POST['id']);
              $tbl_name = mysqli_real_escape_string($connection, $_POST['tbl_name']);
              $field_name = mysqli_real_escape_string($connection, $_POST['field_name']);

              $deleteq = mysqli_query($connection, "UPDATE $tbl_name SET is_block='0' WHERE  $field_name='{$id}'") or die(mysqli_error($connection));
       }

       if ($_POST["action"] == 'cancel') {

              $id = mysqli_real_escape_string($connection, $_POST['id']);
              $tbl_name = mysqli_real_escape_string($connection, $_POST['tbl_name']);
              $field_name = mysqli_real_escape_string($connection, $_POST['field_name']);

              $deleteq = mysqli_query($connection, "UPDATE $tbl_name SET booking_status='Cancelled' WHERE  $field_name='{$id}'") or die(mysqli_error($connection));
       }
}
