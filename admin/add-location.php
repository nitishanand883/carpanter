<?php 
 error_reporting(0);
 include 'header.php'; ?>
<?php include 'left-panel.php'; ?>
 <?php 
 	if(isset($_POST['add_btn'])){
	
		$sql_insert_location = "INSERT INTO `dc_location` SET `location_name`='".$_POST['location_name']."',`status`='".$_POST['status']."',`country`='".$_POST['country']."',`state`='".$_POST['state']."'";
 
	if(mysql_query($sql_insert_location))
		{
			echo "<script>location.href='add-location?msg=1'</script>";
		}else{
			echo "<script>location.href='add-location?msg=2'</script>";
		} 	
} 
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Location<!-- <small>Preview</small>--> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--   <li><a href="#">Forms</a></li>-->
      <li class="active">Add Location</li>
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
            <h3 class="box-title">Add Location</h3>
            <?php if($_REQUEST['msg'] == '1'){?>
            <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Add</h3>
            <?php } else if($_REQUEST['msg'] == '2') { ?>
            <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
            <?php } ?>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form action="" method="post">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Location Name</label>
                    <input type="text" class="form-control" name="location_name" id="" placeholder="Location Name" required>
                  </div>
                  <div class="form-group">
                    <label for="">Country</label>
                    <select name="country" id="country" class="form-control" required></select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Status</label>
                    <select id="" name="status" class="form-control" required>
                      <option value="<?php if($show['status']==1){ ?>1<?php }else if($show['status']==0){ ?>0<?php } ?>" selected="selected">
                      <?php if($show['status']==1){ ?>
                      Active
                      <?php }else if($show['status']==0){ ?>
                      Inactive
                      <?php } ?>
                      </option>
                      <?php if($show['status']==1){ ?>
                      <?php }else{?>
                      <option value="1">Active</option>
                      <?php }if($show['status']==1){ ?>
                      <option value="0">Inactive</option>
                      <?php }else{?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">State</label>
                    <select name="state" id="state" class="form-control" required>
                      <option value="" selected disabled>Select Country First</option>
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="reset" class="btn btn-default pull-right" style="margin-left:15px;">Cancel</button>
              <button type="submit" name="add_btn" class="btn btn-primary pull-right">Save</button>
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
			$(".location").addClass("active"); // instead of this do the below
			$(".add-location").addClass("active"); // instead of this do the below
		});
		</script>
        
		<script language="javascript">
       	 populateCountries("country", "state");
        </script> 