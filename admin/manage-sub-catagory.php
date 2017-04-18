
<?php 
error_reporting(0);
 include 'header.php'; ?> 
 <?php include 'left-panel.php'; ?> 
 
<?php
if(isset($_POST['submit_edit'])){
	$sql_update_category = "UPDATE `dc_sub_category` SET `sub_category_name`='".$_POST['category_name']."',`status`='".$_POST['status']."',`parent_category`='".$_POST['parent_category']."' WHERE `id`= '".$_REQUEST['id']."'";

	if(mysql_query($sql_update_category))
	{
		echo "<script>location.href='manage-sub-catagory?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-sub-catagory?msg=2'</script>";
	}
	
}

if($_REQUEST['flag'] == "delete")
{
	$sql_delete="delete from `dc_sub_category` where `id` = '".$_REQUEST['id']."'"; 
	if(mysql_query($sql_delete))
	{
		echo "<script>location.href='manage-sub-catagory?msg=3'</script>";
	}else{
		echo "<script>location.href='manage-sub-catagory?msg=2'</script>";
	}
}


?>
 
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Sub Category Data
           <!-- <small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <!-- <li><a href="#">Tables</a></li>-->
            <li class="active">Sub Category Data</li>
          </ol>
        </section>

<?php if($_REQUEST['flag']=='edit'){
	$sql_menu_date =mysql_fetch_array(mysql_query("SELECT  dc_sub_category.id,dc_sub_category.sub_category_name,dc_sub_category.parent_category,dc_sub_category.status,dc_category.id AS idd,dc_category.category_name FROM dc_sub_category INNER JOIN dc_category ON dc_sub_category.parent_category = dc_category.id WHERE dc_sub_category.id='".$_REQUEST['id']."'"));
	 ?>
        <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <!-- left column -->
        <div class="col-md-12"> 
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Sub Category</h3>
            </div>
            <!-- /.box-header --> 
            <!-- form start -->
            <form action="" method="post">
              <div class="box-body">
                <div class="row">
                    <div class="form-group  col-sm-6">
                      <label for="">Category Name</label>
         <input type="text" class="form-control" name="category_name" id="" placeholder="Name" value="<?= $sql_menu_date['sub_category_name']; ?>" required>
                    </div>
                       <div class="form-group  col-sm-6">
                      <label for="">Status</label>
                      <select id="" name="status" class="form-control"  required>
                        <option value="<?php if($sql_menu_date['status']==1){ ?>1<?php }else if($sql_menu_date['status']==0){ ?>0<?php } ?>" selected="selected">
                        <?php if($sql_menu_date['status']==1){ ?>
                        Active
                        <?php }else if($sql_menu_date['status']==0){ ?>
                        Inactive
                        <?php } ?>
                        </option>
                        <?php if($sql_menu_date['status']==1){ ?>
                        <?php }else{?>
                        <option value="1">Active</option>
                        <?php }if($sql_menu_date['status']==1){ ?>
                        <option value="0">Inactive</option>
                        <?php }else{?>
                        <?php } ?>
                      </select>
                    </div>
                     <div class="form-group  col-sm-6">
                      <label for="">Parent Catagory</label>
                      <select id="" name="parent_category" class="form-control" required>
                       <option value="<?= $sql_menu_date['parent_category']; ?>" selected><?= $sql_menu_date['category_name']; ?></option>
                       <?php 
							$sql_parent = mysql_query("SELECT * FROM `dc_category` WHERE `sub_menu`=1 AND `status`=1");
							while($show_parent = mysql_fetch_array($sql_parent)){
						?>
                        <option value="<?= $show_parent['id']; ?>"><?= $show_parent['category_name']; ?></option>
                    	<?php } ?>
                      </select>
                    </div>
                </div>
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
              <a href="manage-sub-catagory">
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
                  <h3 class="box-title">Manage Sub Category Data</h3>
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
                        <th>No.</th>
                        <th>Sub&nbsp;Category&nbsp;Name</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
					 		$i = 1;
							$sql_sub_category = mysql_query("SELECT  dc_sub_category.id,dc_sub_category.sub_category_name,dc_sub_category.parent_category,dc_sub_category.status,dc_category.id AS idd,dc_category.category_name FROM dc_sub_category INNER JOIN dc_category ON dc_sub_category.parent_category = dc_category.id");
							while($show_sub_category = mysql_fetch_array($sql_sub_category)){
						?>
                      <tr>
                      	<td><?= $i; ?></td>
                        <td><?= $show_sub_category['sub_category_name']; ?></td>
                        <td><?= $show_sub_category['category_name']; ?></td>
                        <td><?php if($show_sub_category['status'] == '1'){	echo 'Active'; } else { echo 'Inactive'; } ?></td>
                        
                          <td><a href="manage-sub-catagory?id=<?= $show_sub_category['id']; ?>&flag=edit"><i class="fa fa-fw fa-edit text-success"></i></a> &nbsp; <a href="manage-sub-catagory?id=<?= $show_sub_category['id']; ?>&flag=delete" class="delete_row"><i class="fa fa-fw fa-trash text-danger"></i></a></td>
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
			$(".manage-sub-catagory").addClass("active"); // instead of this do the below
			
		});
		</script>