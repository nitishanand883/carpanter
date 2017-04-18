<?php 
error_reporting(0);
 include 'header.php'; ?>
<?php include 'left-panel.php'; ?>
<?php
require("plugins/resizeimage.php");	
if(isset($_POST['submit_edit'])){
	
		$image1="";
		if(isset($_FILES['blog_img']) && !empty($_FILES['blog_img']['name'])) 
		{
			$old_blog_img= '../post_images/'.$_REQUEST['old_blog_img'];
			unlink($old_blog_img);
		
			$newwidth=400;
			
			$newheight=($height/$width)*$newwidth;
			$blog_img=$_FILES['blog_img']['name'];
			$filename = "../post_images/". $blog_img;
			$blogimage = "post_images/".$blog_img;
			$thumbnail = resize($_FILES['blog_img']['tmp_name'], $newwidth, $newheight, $filename);

			$image1=",`banner_image`='$blogimage'";
		}	
	
	
	
	$sql_update_category = "UPDATE dc_banner SET `heading`='".$_POST['heading']."',`text`='".$_POST['big_text']."',`status`='".$_POST['status']."'".$image1." WHERE `id`= '".$_REQUEST['id']."'";

	if(mysql_query($sql_update_category))
	{
		echo "<script>location.href='manage-banner?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-banner?msg=2'</script>";
	}
	
}

if($_REQUEST['flag'] == "delete")
{
	$sql_delete="delete from `dc_banner` where `id` = '".$_REQUEST['id']."'"; 
	if(mysql_query($sql_delete))
	{
		echo "<script>location.href='manage-banner?msg=3'</script>";
	}else{
		echo "<script>location.href='manage-banner?msg=2'</script>";
	}
}


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Banner Data 
      <!-- <small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!-- <li><a href="#">Tables</a></li>-->
      <li class="active">Banner Data</li>
    </ol>
  </section>
  <?php if($_REQUEST['flag']=='edit'){ 
	$sql_classified_date =mysql_fetch_array(mysql_query("SELECT * FROM `dc_banner` WHERE `id` ='".$_REQUEST['id']."'"));
?>
  <!-- Main content -->
  <section class="content">
    <div class="row"> 
      <!-- left column -->
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Banner</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          
          <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-5">
                  <label for="">Banner Image</label>
                  <input type="file" name="blog_img" class="form-control" value=""/>
                  <input type="hidden" name="old_blog_img" value="<?php echo $sql_classified_date['banner_image']; ?>"/>
                  <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb Widht:1349 x Height:288</span>
                </div>
                <div class="form-group col-sm-1"> <img class="img-thumbnail" src="../<?= $sql_classified_date['banner_image']; ?>" alt="message user image"> </div>
              <div class="form-group  col-sm-6">
                  <label for="">Heading</label>
                  <input type="text" class="form-control" name="heading" id="" placeholder="Heading" value="<?= $sql_classified_date['heading']; ?>" required>
                </div>
              </div>
              <div class="row">
               <div class="form-group  col-sm-6">
                  <label for="">Text</label>
                  <input type="text" class="form-control" name="big_text" id="" placeholder="Big Text" value="<?= $sql_classified_date['text']; ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Status</label>
                  <select id="" name="status" class="form-control" required>
                    <option value="<?php if($sql_classified_date['status']==1){ ?>1<?php }else if($sql_classified_date['status']==0){ ?>0<?php } ?>" selected="selected">
                    <?php if($sql_classified_date['status']==1){ ?>
                    Active
                    <?php }else if($sql_classified_date['status']==0){ ?>
                    Inactive
                    <?php } ?>
                    </option>
                    <?php if($sql_classified_date['status']==1){ ?>
                    <?php }else{?>
                    <option value="1">Active</option>
                    <?php }if($sql_classified_date['status']==1){ ?>
                    <option value="0">Inactive</option>
                    <?php }else{?>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer"> <a href="manage-banner">
              <button type="button" class="btn btn-default pull-right" style="margin-left:15px;">Cancel</button>
              </a>
              <button type="submit" name="submit_edit" class="btn btn-primary pull-right" >Save</button>
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
            <h3 class="box-title">Manage Banner Data</h3>
            <?php if($_REQUEST['msg'] == '1'){?>
            <h3 class="box-title" style="float:right; color:#00a65a; ">Notice : Successfully Add</h3>
            <?php } else if($_REQUEST['msg'] == '2') { ?>
            <h3 class="box-title" style="float:right; color:#dd4b39;"">Notice : Somthing Wrong</h3>
            <?php }  else if($_REQUEST['msg'] == '3') { ?>
            <h3 class="box-title" style="float:right; color:#3955DD;"">Notice : Successfully Delete</h3>
            <?php } ?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="datatable-media">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Heading</th>
                    <th>Big Text</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					 $i = 1;
					$sql_post = mysql_query("SELECT * FROM `dc_banner` ORDER BY `id`");
					while($show_post = mysql_fetch_array($sql_post)){
						?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><img src="../<?= $show_post['banner_image']; ?>" class="img-thumbnail" style="height:50px; width:50px;"></td>
                    <td><?= $show_post['heading']; ?></td>
                    <td><?= $show_post['text']; ?></td>
                    <td><?php if($show_post['status'] == '1'){	echo 'Active'; } else { echo 'Inactive'; } ?></td>
                    <td><a href="manage-banner?id=<?= $show_post['id']; ?>&flag=edit"><i class="fa fa-fw fa-edit text-success"></i></a> &nbsp; <a href="manage-banner?id=<?= $show_post['id']; ?>&flag=delete" class="delete_row"><i class="fa fa-fw fa-trash text-danger"></i></a></td>
                  </tr>
                  <?php $i++;} ?>
                  </tfoot>
              </table>
            </div>
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
			$(".banner").addClass("active"); // instead of this do the below
			$(".manage-banner").addClass("active"); // instead of this do the below
		
		});
		</script>