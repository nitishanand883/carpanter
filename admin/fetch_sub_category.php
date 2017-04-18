
<?php
include('config/config.php');
if(isset($_POST['get_option']))
{
 $cate = $_POST['get_option'];
 $find=mysql_query("SELECT * FROM `dc_sub_category` WHERE `parent_category`='$cate' AND `status`=1");
 while($row=mysql_fetch_array($find))
 {
  echo "<option value='".$row['id']."'>".$row['sub_category_name']."</option>";
 }
 exit;
}
?>