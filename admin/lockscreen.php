<?php
error_reporting(0);
session_start();
$_SESSION['loginadmin'] = '';


include ("config/config.php");
if(isset($_REQUEST['unlock']))
{
	$pass = mysql_real_escape_string($_REQUEST['password']);
	$user = base64_decode($_SESSION['access']);
	$sql = mysql_query("SELECT * FROM `dc_admin_login` WHERE `username`='".$user."' and `password`='".$pass."'");
	$num=mysql_num_rows($sql);
	if($num > 0)
	{
		$row=mysql_fetch_array($sql);
		$_SESSION['loginadmin']="true";
		$_SESSION['User_role'] = $row['role'];
		$_SESSION['adminemail']=$row['email'];
		$_SESSION['admin_name']=$row['name'];
		$_SESSION['msg']="Access Granted";
		$_SESSION['access']=base64_encode($row['username']);
		header("Location:".$_SESSION['url']."");
	}
	else
	{
		echo "<script>alert('Acces Denied. user/password combination wrong');</script>";
		$_SESSION['msg']="Access Denied";
		echo "<script>location.href='lockscreen'</script>";
	}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="#"><b>Admin</b>ETS</a>
        
      </div>
      <!-- User name -->
      
      <div class="lockscreen-name"><?= $_SESSION['admin_name']; ?></div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="dist/img/user2-160x160.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="" method="post">
          <div class="input-group">
            <input type="password" class="form-control" placeholder="password" name="password" autofocus>
            <div class="input-group-btn">
              <button class="btn" type="submit" name="unlock" id="unlock"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Enter your password to retrieve your session
      </div>
      <div class="text-center">
        <a href="index">Or sign in as a different user</a>
      </div>
      <div class="lockscreen-footer text-center">
        Copyright &copy; <?= date('Y'); ?> <b><a href="http://theetsindia.com/" target="_blank">Eclipse Technoconsulting Global (P) Ltd.</a></b><br>
        All rights reserved
      </div>
    </div><!-- /.center -->

  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
