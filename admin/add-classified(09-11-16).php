<?php 
error_reporting(0);
 include 'header.php'; ?>
<?php include 'left-panel.php'; ?>
<?php 
require("plugins/resizeimage.php");	
 	if(isset($_POST['add_btn'])){
			if(isset($_FILES['blog_img']) && !empty($_FILES['blog_img']['name'])) 
		{ 
			$uploadedfile = $_FILES['blog_img']['tmp_name'];
			$blog_img = $_FILES['blog_img']['name'];
			$filename = "../post_images/".$blog_img;
			$blogimage = "post_images/".$blog_img;
			$newwidth=400;
			$newheight=($height/$width)*$newwidth;
			$thumbnail = resize($_FILES['blog_img']['tmp_name'], $newwidth, $newheight, $filename);
		}
			
	 $sql_insert_clasified = "INSERT INTO `dc_classified_post` SET `user_image`='".$blogimage."',`name`='".$_POST['name']."',`qualification`='".$_POST['qualification']."',`experiance`='".$_POST['experiance']."' ,`parent_category`='".$_POST['parent_category']."',`sub_category`='".$_POST['sub_category']."',`location`='".$_POST['location']."',`status`='".$_POST['status']."',`description`='".$_POST['desc']."',`facebook`='".$_POST['facebook']."',`google`='".$_POST['google']."',`linkedin`='".$_POST['linkedin']."',`twitter`='".$_POST['twitter']."'";
	 
	
	if(mysql_query($sql_insert_clasified))
		{
			echo "<script>location.href='add-classified?msg=1'</script>";
		}else{
			echo "<script>location.href='add-classified?msg=2'</script>";
		} 	
} 
 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Classified<!-- <small>Preview</small>--> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--   <li><a href="#">Forms</a></li>-->
      <li class="active">Manage Classified</li>
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
            <h3 class="box-title">Add Classified</h3>
            <?php if($_REQUEST['msg'] == '1'){?>
            <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Add</h3>
            <?php } else if($_REQUEST['msg'] == '2') { ?>
            <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
            <?php } ?>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="">User Image</label>
                  <input type="file" name="blog_img" class="form-control" value=""/>
                </div>
                <!--<div class="form-group col-sm-1"> <img class="img-thumbnail" src="../post_images/user.png" alt="message user image"> </div>-->
                <div class="form-group  col-sm-6">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" id="" placeholder="Name" required>
                </div>
              </div>
              <div class="row">
               <div class="form-group  col-sm-6">
                  <label for="">Qualification</label>
                  <input type="text" class="form-control" name="qualification" id="" placeholder="Qualification">
                </div>
                 <div class="form-group  col-sm-6">
                  <label for="">Experiance (Years)</label>
                  <input type="text" class="form-control" name="experiance" id="" placeholder="Experiance">
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Parent Catagory</label>
                  <select id="" name="parent_category" class="form-control" required>
                   <?php 
							$sql_parent = mysql_query("SELECT * FROM `dc_category`");
							while($show_parent = mysql_fetch_array($sql_parent)){
						?>
                        <option value="<?= $show_parent['id']; ?>"><?= $show_parent['category_name']; ?></option>
                    	<?php } ?>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Sub Catagory</label>
                  <select id="" name="sub_category" class="form-control" required>
                    <?php 
							$sql_sub = mysql_query("SELECT * FROM `dc_sub_category`");
							while($show_sub = mysql_fetch_array($sql_sub)){
						?>
                        <option value="<?= $show_sub['id']; ?>"><?= $show_sub['sub_category_name']; ?></option>
                    	<?php } ?>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Location</label>
                  <select id="" name="location" class="form-control" required>
                     <?php 
							$sql_location = mysql_query("SELECT * FROM `dc_location`");
							while($show_location = mysql_fetch_array($sql_location)){
						?>
                        <option value="<?= $show_location['id']; ?>"><?= $show_location['location_name']; ?> (<?= $show_location['country']; ?>)</option>
                    	<?php } ?>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Status</label>
                  <select id="" name="status" class="form-control" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
                <div class="form-group col-sm-12" style="margin-bottom:0px;">
                	<h3 class="text-info">Social Links</h3>
                  <hr>
                </div>
                 <div class="form-group col-sm-6">
                  <label for="">Facebook</label>
                 <input type="text" name="facebook" class="form-control" placeholder="Facebook Link">
                </div>
                 <div class="form-group col-sm-6">
                  <label for="">Google+</label>
                   <input type="text" name="google" class="form-control" placeholder="Google+ Link">
                </div>
                
                 <div class="form-group col-sm-6">
                  <label for="">Linkedin</label>
                 <input type="text" name="linkedin" class="form-control" placeholder="Linkedin Link">
                </div>
                 <div class="form-group col-sm-6">
                  <label for="">Twitter</label>
                   <input type="text" name="twitter" class="form-control" placeholder="Twitter Link">
                </div>
                
                
                <div class="form-group col-sm-12">
                  <label for="">Details</label>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h6 class="panel-title"><i class="icon-pencil"></i>Description</h6>
                    </div>
                    <div class="panel-body">
                      <div class="block-inner">
                        <textarea class="ckeditor" name="desc" placeholder="Enter text ..."></textarea>
                      </div>
                    </div>
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
			$(".classified").addClass("active"); // instead of this do the below
			$(".add-classified").addClass("active"); // instead of this do the below
		});
		</script>
 