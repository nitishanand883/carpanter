
<?php 
error_reporting(0);
 include 'header.php'; ?> 
 <?php include 'left-panel.php'; ?> 
<?php
if(isset($_POST['submit_edit'])){
	$sql_update_category = "UPDATE `dc_category` SET `category_name`='".$_POST['category_name']."',`status`='".$_POST['status']."',`sub_menu`='".$_POST['sub_menu']."' WHERE `id`= '".$_REQUEST['id']."'";

	if(mysql_query($sql_update_category))
	{
		echo "<script>location.href='manage-catagory?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-catagory?msg=2'</script>";
	}
	
}

if($_REQUEST['flag'] == "delete")
{
	$sql_delete="delete from `dc_category` where `id` = '".$_REQUEST['id']."'"; 
	if(mysql_query($sql_delete))
	{
		echo "<script>location.href='manage-catagory?msg=3'</script>";
	}else{
		echo "<script>location.href='manage-catagory?msg=2'</script>";
	}
}


?>
 
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Category Data
           <!-- <small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <!-- <li><a href="#">Tables</a></li>-->
            <li class="active">Category Data</li>
          </ol>
        </section>
<?php if($_REQUEST['flag']=='edit'){ 
	$sql_admin_date =mysql_fetch_array(mysql_query("SELECT * FROM `dc_category` WHERE `id`='".$_REQUEST['id']."'"));
?>

        <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <!-- left column -->
        <div class="col-md-12"> 
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Category</h3>
            </div>
            <!-- /.box-header --> 
            <!-- form start -->
            <form  action="" method="post">
              <div class="box-body">
                <div class="row">
                 <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="" placeholder="Category Name" value="<?= $sql_admin_date['category_name']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="">Sub Menu </label>
                      <select id="" name="sub_menu" class="form-control">
                        <option value="<?php if($sql_admin_date['sub_menu']==1){ ?>1<?php }else if($sql_admin_date['sub_menu']==0){ ?>0<?php } ?>" selected="selected">
                        <?php if($sql_admin_date['sub_menu']==1){ ?>
                        Yes
                        <?php }else if($sql_admin_date['sub_menu']==0){ ?>
                        No
                        <?php } ?>
                        </option>
                        <?php if($sql_admin_date['sub_menu']==1){ ?>
                        <?php }else{?>
                        <option value="1">Yes</option>
                        <?php }if($sql_admin_date['sub_menu']==1){ ?>
                        <option value="0">No</option>
                        <?php }else{?>
                        <?php } ?>
                      </select>
                    </div>
                    
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Status</label>
                      <select id="" name="status" class="form-control">
                        <option value="<?php if($sql_admin_date['status']==1){ ?>1<?php }else if($sql_admin_date['status']==0){ ?>0<?php } ?>" selected="selected">
                        <?php if($sql_admin_date['status']==1){ ?>
                        Active
                        <?php }else if($sql_admin_date['status']==0){ ?>
                        Inactive
                        <?php } ?>
                        </option>
                        <?php if($sql_admin_date['status']==1){ ?>
                        <?php }else{?>
                        <option value="1">Active</option>
                        <?php }if($sql_admin_date['status']==1){ ?>
                        <option value="0">Inactive</option>
                        <?php }else{?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
              <a href="manage-catagory">
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
                  <h3 class="box-title">Manage Category Data</h3>
                   <?php if($_REQUEST['msg'] == '1'){?>
                <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Add</h3>
                <?php } else if($_REQUEST['msg'] == '2') { ?>
                <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
                <?php }  else if($_REQUEST['msg'] == '3') { ?>
                <h3 class="box-title" style="float:right; color:#3955DD;"">Notice : Successfully Delete</h3>
                <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                       <th width="1">No.</th>
                        <th>Category&nbsp;Name</th>
                        <th>Sub&nbsp;Menu</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
					 $i = 1;
					$sql_category = mysql_query("SELECT * FROM `dc_category`");
					while($show = mysql_fetch_array($sql_category)){
						?>
                      <tr>
                      <td><?= $i; ?></td>
                        <td><?= $show['category_name']; ?></td>
                        <td><?php if($show['sub_menu'] == '1'){	echo 'Yes'; } else { echo 'No'; } ?></td>
                        <td><?php if($show['status'] == '1'){	echo 'Active'; } else { echo 'Inactive'; } ?></td>
                          <td><a href="manage-catagory?id=<?= $show['id']; ?>&flag=edit"><i class="fa fa-fw fa-edit text-success"></i></a> &nbsp; <a href="manage-catagory?id=<?= $show['id']; ?>&flag=delete" class="delete_row"><i class="fa fa-fw fa-trash text-danger"></i></a></td>
                      </tr>
                      <?php $i++; } ?>
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
			$(".category").addClass("active"); // instead of this do the below
			$(".manage-catagory").addClass("active"); // instead of this do the below
			
		});
		</script>