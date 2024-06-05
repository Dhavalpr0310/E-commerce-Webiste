<?php
include '../class/at-class.php';
if(isset($_POST["action"]))
{
 
 $output = '';
 if($_POST["action"] == "city_id")
 {
  $query = "SELECT * FROM tbl_admission WHERE student_id = '".$_POST["query"]."'";
  $result = mysqli_query($conn, $query);
  $output .= '<option value="">-Select Admission-</option>';
  while($row = mysqli_fetch_array($result))
  {

    $query_admission = mysqli_query($conn,"SELECT * FROM `tbl_admission` where admission_id='{$row["admission_id"]}'")or die(mysqli_error($conn));
    $row_admission= mysqli_fetch_array($query_admission);


    $query_branch = mysqli_query($conn,"SELECT * FROM `tbl_branch` where branch_id='{$row_admission["branch_id"]}'")or die(mysqli_error($conn));
    $row_branch= mysqli_fetch_array($query_branch);

    $query_sem = mysqli_query($conn,"SELECT * FROM `tbl_semester` where semester_id='{$row_admission["semester_id"]}'")or die(mysqli_error($conn));
    $row_sem= mysqli_fetch_array($query_sem);

    $admission_year =$row["admission_year"];
    $admission_fees =$row["admission_fees"];
    
    $branch =$row_branch["branch_name"];
$sem =$row_sem["semester_name"];

$op ="Year: ".$admission_year."| Branch: ".$branch."| Semester : ".$sem."| Admission Fees: " .$admission_fees;

   $output .= '<option value="'.$row["admission_id"].'">'.$op.'</option>';
  }
 }
 
 echo $output;
}
?>