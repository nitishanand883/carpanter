<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carpanter";

if($_SERVER['HTTP_HOST'] == "localhost")
{
 $con = @mysql_connect($servername,$username,$password) or die('connection error');
 $db = @mysql_select_db($dbname,$con) or die('database error');
 
 $rooturl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
 define('BASE_URL',$rooturl.'ets-digital-classified/');
}
else
{
 $con = mysql_connect("localhost","root","") or die('connection error');
 $db = mysql_select_db($dbname,$con) or die('database error');
 
 $rooturl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
 define('BASE_URL',$rooturl.'');
}	
?>
