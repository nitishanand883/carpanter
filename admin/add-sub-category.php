 <?php 
 error_reporting(0);
 include 'header.php'; ?> 
 <?php include 'left-panel.php'; ?> 
 
 <?php 
 	if(isset($_POST['add_btn'])){
	
	$sql_insert_sub_category = "INSERT INTO `dc_sub_category` SET `sub_category_name`='".$_POST['category_name']."',`status`='".$_POST['status']."',`parent_category`='".$_POST['parent_category']."'";
 
if(mysql_query($sql_insert_sub_category))
	{
		echo "<script>location.href='add-sub-category?msg=1'</script>";
	}else{
		echo "<script>location.href='add-sub-category?msg=2'</script>";
	} 	
		
		
	} 
 ?>
 
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add Sub Category<!-- <small>Preview</small>--> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <!--   <li><a href="#">Forms</a></li>-->
        <li class="active">Sub Manage Category</li>
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
              <h3 class="box-title">Add Sub Category</h3>
              <?php if($_REQUEST['msg'] == '1'){?>
                <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Added</h3>
                <?php } else if($_REQUEST['msg'] == '2') { ?>
                <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
                <?php } ?>
            </div>
            <!-- /.box-header --> 
            <!-- form start -->
            <form action="" method="post">
              <div class="box-body">
                <div class="row">
                    <div class="form-group  col-sm-6">
                      <label for="">Parent Catagory</label>
                      <select id="" name="parent_category" class="form-control" required>
                       <option value="">Select Category</option>
                       <?php 
							$sql_parent = mysql_query("SELECT * FROM `dc_category` WHERE `sub_menu`=1 AND `status`=1");
							while($show_parent = mysql_fetch_array($sql_parent)){
						?>
                        <option value="<?= $show_parent['id']; ?>"><?= $show_parent['category_name']; ?></option>
                    	<?php } ?>
                      </select>
                    </div>
                    <div class="form-group  col-sm-6">
                      <label for="">Sub Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Sub category Name" required>
                    </div>
                    
                    
                      <div class="form-group  col-sm-6">
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
			$(".category").addClass("active"); // instead of this do the below
			$(".add-sub-category").addClass("active"); // instead of this do the below
		});
		</script>
        