
<?php
include('config/config.php');

if(isset($_POST['username']))
{
	$str= "";
$username = $_POST['username'];
$sql = mysql_query("select username from dc_admin_login where username='$username'");
if(mysql_num_rows($sql))
{
$str = 'err';
}
else
{
$str = 'OK';
}
$response['output'] = $str;
echo json_encode($response);
}
?>