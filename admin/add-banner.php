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
			$filename = "../images/banner/".$blog_img;
			$blogimage = "images/banner/".$blog_img;
			$newwidth=1349;
			$newheight=($height/$width)*$newwidth;
			$thumbnail = resize($_FILES['blog_img']['tmp_name'], $newwidth, $newheight, $filename);
		}
			
	 $sql_insert_clasified = "INSERT INTO `cp_banner` SET `banner_image`='".$blogimage."',`heading`='".$_POST['heading']."',`text`='".$_POST['text']."',`status`='".$_POST['status']."'";
	 
	
	if(mysql_query($sql_insert_clasified))
		{
			echo "<script>location.href='add-banner?msg=1'</script>";
		}else{
			echo "<script>location.href='add-banner?msg=2'</script>";
		} 	
} 
 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Add Banner<!-- <small>Preview</small>--> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--   <li><a href="#">Forms</a></li>-->
      <li class="active">Manage Banner</li>
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
            <h3 class="box-title">Add Banner</h3>
            <?php if($_REQUEST['msg'] == '1'){?>
            <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Add</h3>
            <?php } else if($_REQUEST['msg'] == '2') { ?>
            <h3 class="box-title" style="float:right; color:#dd4b39;">Notice : Somthing Wrong</h3>
            <?php } ?>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="">Banner Image</label>
                  <input type="file" name="blog_img" class="form-control" value=""/>
                  <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb Widht:1349 x Height:288</span>
                </div>
                <div class="form-group  col-sm-6">
                  <label for="">Heading</label>
                  <input type="text" class="form-control" name="heading" id="" placeholder="Heading" required>
                </div>
              </div>
              <div class="row">
               <div class="form-group  col-sm-6">
                  <label for="">Text</label>
                  <input type="text" class="form-control" name="big_text" id="" placeholder="Big Text">
                </div>
                 <div class="form-group  col-sm-6">
                  <label for="">Status</label>
                   <select id="" name="status" class="form-control" required>
                    <option value="" selected disabled>Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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
			$(".banner").addClass("active"); // instead of this do the below
			$(".add-banner").addClass("active"); // instead of this do the below
		});
		</script>
 