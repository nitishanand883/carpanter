<?php 
 error_reporting(0);
 include 'header.php'; ?>
<?php include 'left-panel.php'; ?>
<?php
 
 if(isset($_POST['add_submit'])){
 	$sql_insert_admin = "INSERT INTO `dc_admin_login` SET `name`='".$_POST['name']."', `email`='".$_POST['email']."', `role`='".$_POST['role']."', `username`='".$_POST['username']."', `password`='".$_POST['password']."'";
 
if(mysql_query($sql_insert_admin))
	{
		echo "<script>location.href='manage-admin?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-admin?msg=2'</script>";
	} 
 }
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Admin Users<!-- <small>Preview</small>--> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--   <li><a href="#">Forms</a></li>-->
      <li class="active">Add Admin</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row"> 
      <!-- left column -->
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add User</h3>
            <?php if($_REQUEST['msg'] == '1'){?>
            <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Added</h3>
            <?php } else if($_REQUEST['msg'] == '2') { ?>
            <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
            <?php } ?>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form  action="" method="post">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="" placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="">Email </label>
                    <input type="email" class="form-control" name="email" id="" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" required>
                      <option value="Admin" selected="selected">Admin</option>
                      <option value="Hr">Hr</option>
                      <option value="Quality">Quality</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="User Name" required>
                    <input type="hidden" name="stat" id="stat" value="">
                    <span id="status"></span> </div>
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="reset" class="btn btn-default pull-right" style="margin-left:15px;">Cancel</button>
              <button type="submit" name="add_submit" id="add_submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; ?>
<script>
		$(document).ready(function() {
			$(".treeview").removeClass("active");
			$(".admin").addClass("active"); // instead of this do the below
			$(".manage-admin").addClass("active"); // instead of this do the below
			
			var stu = $('#stat').val();
			$(document).on('click','#add_submit',function(){
			if(stu === 'err'){
				
				e.preventDefault();	
			}
			});
		});
		</script>