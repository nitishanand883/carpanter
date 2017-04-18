
<?php 
error_reporting(0);
 include 'header.php'; ?> 
 <?php include 'left-panel.php'; ?> 
 
 <?php
if(isset($_POST['submit_edit'])){
	$sql_update_category = "UPDATE `dc_location` SET `location_name`='".$_POST['location_name']."',`status`='".$_POST['status']."',`country`='".$_POST['country']."',`state`='".$_POST['state']."' WHERE `id`= '".$_REQUEST['id']."'";

	if(mysql_query($sql_update_category))
	{
		echo "<script>location.href='manage-location?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-location?msg=2'</script>";
	}
}

if($_REQUEST['flag'] == "delete")
{
	$sql_delete="delete from `dc_location` where `id` = '".$_REQUEST['id']."'"; 
	if(mysql_query($sql_delete))
	{
		echo "<script>location.href='manage-location?msg=3'</script>";
	}else{
		echo "<script>location.href='manage-location?msg=2'</script>";
	}
}


?>

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Location Data
           <!-- <small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <!-- <li><a href="#">Tables</a></li>-->
            <li class="active">Location Data</li>
          </ol>
        </section>

<?php if($_REQUEST['flag']=='edit'){
	
	$sql_location_date =mysql_fetch_array(mysql_query("SELECT * FROM `dc_location` WHERE `id`='".$_REQUEST['id']."'"));
	
	 ?>
        <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <!-- left column -->
        <div class="col-md-12"> 
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Location</h3>
            </div>
            <!-- /.box-header --> 
            <!-- form start -->
            <form  action="" method="post">
              <div class="box-body">
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Location Name</label>
                    <input type="text" class="form-control" name="location_name" id="" placeholder="Location Name" value="<?= $sql_location_date['location_name']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="">Country</label>
                     <select name="country" id="country" class="form-control" required>
                     <option value="<?= $sql_location_date['country']; ?>" selected><?= $sql_location_date['country']; ?></option>
                     </select>
                     <p>Country Selected : <?= $sql_location_date['country']; ?></p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Status</label>
                    <select id="" name="status" class="form-control" required>
                      <option value="<?php if($sql_location_date['status']==1){ ?>1<?php }else if($sql_location_date['status']==0){ ?>0<?php } ?>" selected="selected">
                      <?php if($sql_location_date['status']==1){ ?>
                      Active
                      <?php }else if($sql_location_date['status']==0){ ?>
                      Inactive
                      <?php } ?>
                      </option>
                      <?php if($sql_location_date['status']==1){ ?>
                      <?php }else{?>
                      <option value="1">Active</option>
                      <?php }if($sql_location_date['status']==1){ ?>
                      <option value="0">Inactive</option>
                      <?php }else{?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">State</label>
                     <select name="state" id="state" class="form-control" required>
                      <option value="<?= $sql_location_date['state']; ?>" selected><?= $sql_location_date['state']; ?></option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
              <a href="manage-location">
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
                  <h3 class="box-title">Manage Location Data</h3>
                   <?php if($_REQUEST['flag'] == '1'){?>
                <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Add</h3>
                <?php } else if($_REQUEST['flag'] == '2') { ?>
                <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
                <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>No.</th>
                        <th>Location Name</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                     <?php 
					 		$i = 1;
							$sql_location = mysql_query("SELECT * FROM `dc_location`");
							while($show_location = mysql_fetch_array($sql_location)){
						?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $show_location['location_name']; ?></td>
                        <td><?= $show_location['country']; ?></td>
                        <td><?= $show_location['state']; ?></td>
                        <td><?php if($show_location['status'] == '1'){	echo 'Active'; } else { echo 'Inactive'; } ?></td>
                          <td><a href="manage-location?id=<?= $show_location['id']; ?>&flag=edit"><i class="fa fa-fw fa-edit text-success"></i></a> &nbsp; <a href="manage-location?id=<?= $show_location['id']; ?>&flag=delete" class="delete_row"><i class="fa fa-fw fa-trash text-danger"></i></a></td>
                      </tr>
                      <?php $i++;} ?>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
     <?php } ?>      
       </div><!-- /.content-wrapper --> 
      
        <?php include 'footer.php'; ?> 
        <script>
		$(document).ready(function() {
			$(".treeview").removeClass("active");
			$(".location").addClass("active"); // instead of this do the below
			$(".manage-location").addClass("active"); // instead of this do the below
			
		});
		</script>
        <script language="javascript">
       	 populateCountries("country", "state");
        </script> 