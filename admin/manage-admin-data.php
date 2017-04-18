<?php 
error_reporting(0);
 include 'header.php'; ?>
<?php include 'left-panel.php'; ?>
<?php
if(isset($_POST['submit_edit'])){
	$sql_update_admin = "UPDATE `dc_admin_login` SET `name`='".$_POST['name']
."',`email`='".$_POST['email']."',`role`='".$_POST['role']."',`username`='".$_POST['username']."',`password`='".$_POST['password']."' WHERE `id`= '".$_REQUEST['id']."'";

	if(mysql_query($sql_update_admin))
	{
		echo "<script>location.href='manage-admin-data?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-admin-data?msg=2'</script>";
	}
	
}

if($_REQUEST['flag'] == "delete")
{
	
	$sql_delete="delete from `dc_admin_login` where `id` = '".$_REQUEST['del_id']."'"; 
	if(mysql_query($sql_delete))
	{
		echo "<script>location.href='manage-admin-data?msg=3'</script>";
	}else{
		echo "<script>location.href='manage-admin-data?msg=2'</script>";
	}
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Admin Data 
      <!-- <small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!-- <li><a href="#">Tables</a></li>-->
      <li class="active">Admin Data</li>
    </ol>
  </section>
  <?php if($_REQUEST['flag']=='edit'){ 
	$sql_admin_date =mysql_fetch_array(mysql_query("SELECT * FROM `dc_admin_login` WHERE `id`='".$_REQUEST['id']."'"));
?>
  
  <!-- Main content -->
  <section class="content">
    <div class="row"> 
      <!-- left column -->
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit User</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form  action="" method="post">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="" placeholder="Name" value="<?= $sql_admin_date['name']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="">Email </label>
                    <input type="email" class="form-control" name="email" id="" placeholder="Email" value="<?= $sql_admin_date['email']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" required>
                      <option value="<?= $sql_admin_date['role']; ?>" selected="selected">
                      <?= $sql_admin_date['role']; ?>
                      </option>
                      <option value="Admin">Admin</option>
                      <option value="Hr">Hr</option>
                      <option value="Quality">Quality</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" class="form-control" name="username" id="" placeholder="User Name" value="<?= $sql_admin_date['username']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" value="<?= $sql_admin_date['password']; ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer"> <a href="manage-admin-data.php">
              <button type="button" class="btn btn-default pull-right" style="margin-left:15px;">Cancel</button>
              </a>
              <button type="submit" name="submit_edit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content -->
  <?php } else { ?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Admin Data</h3>
            <?php if($_REQUEST['msg'] == '1'){?>
            <h3 class="box-title" style="float:right; color:#00a65a;">Notice : Successfully Updated</h3>
            <?php } else if($_REQUEST['msg'] == '2') { ?>
            <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
            <?php } else if($_REQUEST['msg'] == '3') { ?>
            <h3 class="box-title" style="float:right; color:#3955DD;"">Notice : Successfully Delete</h3>
            <?php } ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th width="1">User&nbsp;Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$sql_admin = mysql_query("SELECT * FROM `dc_admin_login`");
					while($show = mysql_fetch_array($sql_admin)){
						?>
                <tr>
                  <td><?= $show['name']; ?></td>
                  <td><?= $show['username']; ?></td>
                  <td><?= $show['email']; ?></td>
                  <td><?= $show['role']; ?></td>
                  <td><a href="manage-admin-data?id=<?= $show['id']; ?>&flag=edit"><i class="fa fa-fw fa-edit text-success"></i></a> &nbsp; <a href="manage-admin-data?del_id=<?= $show['id']; ?>&flag=delete" class="delete_row"><i class="fa fa-fw fa-trash text-danger"></i></a></td>
                </tr>
                <?php } ?>
                </tfoot>
                
            </table>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content -->
  <?php } ?>
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; ?>
<script>
		$(document).ready(function() {
			$(".treeview").removeClass("active");
			$(".admin").addClass("active"); // instead of this do the below
			$(".manage-admin-data").addClass("active"); // instead of this do the below
			
		});
		</script>