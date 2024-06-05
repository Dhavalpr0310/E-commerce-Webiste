<?php
require 'class/atclass.php';
$page_title = "Subcategory Wise Product Report";

?>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title;?> | <?php echo $project_title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  
</head>
<body>
<center><h3><?php echo $project_title;?></h3> </center>

<center><h2><?php echo $page_title?></h2></center>
<hr/>

<a href="#" onclick="window.print();">Print</a>
<br>

    
    <?php

echo " Date:" . date("d-m-Y");

?>

<form method="get">
     
<select name='id' required>
     <option value=''>-Select Subcategory-</option>
     <?php
     $query_list = mysqli_query($connection,"SELECT * FROM `tbl_sub_category`")or die(mysqli_error($connection));
     while($row_list = mysqli_fetch_array($query_list))
     {
         if(isset($_GET["id"]))
         {
             if($row_list["sub_category_id"] == $_GET["id"])
             {
                 $select ="selected";
             }
             else{
                $select ="";
             }

         }
         else{
            $select ="";
         }

       ?>
      <option value="<?php echo $row_list["sub_category_id"];?>" <?php echo $select;?>><?php echo $row_list["sub_category_name"];?></option>
     <?php } ?>
     </select>

    <input type="submit">
</form>

<?php
if(isset($_GET['id']))
{
    $id =$_GET['id'];

    $search = "where sub_category_id='{$id}'";
}
else{
    
    $search="";
}

$query = mysqli_query($connection, "select * from tbl_product_master  $search") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);
?>
<br/><center><?php
if($count == "0")
{
    echo "No";
}
else{
 echo $count;}?> Records Found</center>
<br/>
<?php 
if ($count > 0) {
    ?>

    <table align='center' style='text-align:center;' width='100%' border='1'> 
    <tr>
   <th>Srno</th>

                                           <th>Product Name</th>
                                           <th>Price</th>
                                                <th>QTY</th>
                                                <th>Subcategory</th>
                                                    <th>Details</th>
                                               
                                                
                                               
                                      
    </tr>
    <?php 
    $x="1";
    while ($row = mysqli_fetch_array($query)) {

        $query_sub = mysqli_query($connection,"SELECT * FROM `tbl_sub_category` where sub_category_id ='{$row["sub_category_id"]}'")or die(mysqli_error($connection));
      $row_sub= mysqli_fetch_array($query_sub);
?>
       <tr>
       <td><?php echo $x++;?></td>
                                                      <td><?php echo $row['product_name']; ?></td>
                                                     <td><?php echo $row['product_price']; ?></td>
                                                     <td><?php echo $row['product_quantity']; ?></td>
                                                     <td><?php echo $row_sub['sub_category_name']; ?></td>
                                                     <td><?php echo $row['product_details']; ?></td>
                                                     
                                              
        
        
        
        
      
                                        
        </tr>
        <?php
    }
?>
    </table>
<?php 

} else {
    // echo "No Records Found";
}

?>
</body>
</html>

