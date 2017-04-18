<?php 
session_start();
$_SESSION['loginadmin']="false";
session_destroy();
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index';
header('Location: ' . $home_url);
?>