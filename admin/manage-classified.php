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

			$image1=",`user_image`='$blogimage'";
		}	
	
		$desc = mysql_real_escape_string(stripslashes($_POST['desc']));
	
	$sql_update_category = "UPDATE `dc_classified_post` SET  `unique_id`='".$_REQUEST['id']."',`name`='".$_POST['name']."',`parent_category`='".$_POST['parent_category']."',`sub_category`='".$_POST['sub_category']."',`mobile`='".$_POST['mobile_no']."',`status`='".$_POST['status']."',`description`='".$desc."',`facebook`='".$_POST['facebook']."',`google`='".$_POST['google']."',`linkedin`='".$_POST['linkedin']."',`twitter`='".$_POST['twitter']."'".$image1." WHERE `unique_id`= '".$_REQUEST['id']."'";
	
		 $sql_user_location = "UPDATE `dc_location` SET `location_name`='".$_POST['location_name']."', `country`='".$_POST['country']."', `state`='".$_POST['state']."', `city`='".$_POST['city']."',`zipcode`='".$_POST['zip']."', `status`='".$_POST['status']."' WHERE `unique_id`= '".$_REQUEST['id']."'";
	$query_user_location = mysql_query($sql_user_location);
	
	if(mysql_query($sql_update_category))
	{
		echo "<script>location.href='manage-classified?msg=1'</script>";
	}else{
		echo "<script>location.href='manage-classified?msg=2'</script>";
	}
	
}

if($_REQUEST['flag'] == "delete")
{
	$sql_delete="delete from `dc_classified_post` where `unique_id` = '".$_REQUEST['id']."'"; 
	if(mysql_query($sql_delete))
	{
		echo "<script>location.href='manage-classified?msg=3'</script>";
	}else{
		echo "<script>location.href='manage-classified?msg=2'</script>";
	}
}


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Classified Data 
      <!-- <small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!-- <li><a href="#">Tables</a></li>-->
      <li class="active">Classified Data</li>
    </ol>
  </section>
  <?php if($_REQUEST['flag']=='edit'){ 
  //dc_classified_post.qualification,dc_classified_post.experiance,
  
	$sql_classified_date =mysql_fetch_array(mysql_query("SELECT dc_classified_post.unique_id, dc_classified_post.id AS idd,dc_classified_post.user_image,dc_classified_post.name,dc_classified_post.mobile,dc_classified_post.status,dc_classified_post.parent_category,dc_classified_post.sub_category,dc_classified_post.status,dc_classified_post.description,dc_classified_post.facebook,dc_classified_post.google,dc_classified_post.linkedin,dc_classified_post.twitter,dc_location.id,dc_location.country,dc_location.state,dc_location.city,dc_location.location_name,dc_location.zipcode,dc_category.id,dc_category.category_name,dc_sub_category.id AS sid,dc_sub_category.sub_category_name FROM dc_classified_post INNER JOIN dc_location ON dc_classified_post.unique_id = dc_location.unique_id INNER JOIN dc_category ON dc_classified_post.parent_category = dc_category.id INNER JOIN dc_sub_category ON dc_classified_post.sub_category = dc_sub_category.id WHERE dc_classified_post.unique_id ='".$_REQUEST['id']."'"));
?>
  <!-- Main content -->
  <section class="content">
    <div class="row"> 
      <!-- left column -->
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Classified</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          
          <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-5">
                  <label for="">User Image</label>
                  <input type="file" name="blog_img" class="form-control" value=""/>
                  <input type="hidden" name="old_blog_img" value="<?php echo $sql_classified_date['user_image']; ?>"/>
                  <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb Widht:400 x Height:400</span>
                </div>
                <div class="form-group col-sm-1"> <img class="img-thumbnail" src="../<?= $sql_classified_date['user_image']; ?>" alt="message user image"> </div>
                <div class="form-group  col-sm-6">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" id="" value="<?= $sql_classified_date['name']; ?>" placeholder="Name" required>
                </div>
              </div>
              <div class="row">
             <?php /*?>   <div class="form-group  col-sm-6">
                  <label for="">Qualification</label>
                  <input type="text" class="form-control" name="qualification" id="" value="<?= $sql_classified_date['qualification']; ?>" placeholder="Qualification" >
                </div>
                <div class="form-group  col-sm-6">
                  <label for="">Experiance (Years)</label>
                  <input type="text" class="form-control" name="experiance" id="" value="<?= $sql_classified_date['experiance']; ?>" placeholder="Experiance"  >
                </div><?php */?>
                <div class="form-group col-sm-6">
                  <label for="">Parent Catagory</label>
                  <select id="parent_category" name="parent_category" class="form-control" onChange="fetch_select(this.value);" required>
                  <option value="">Select category</option>
                  <option value="<?= $sql_classified_date['id']; ?>" selected><?= $sql_classified_date['category_name']; ?></option>
                    <?php 
							$sql_parent = mysql_query("SELECT * FROM `dc_category` WHERE `sub_menu`=1 AND `status`=1");
							while($show_parent = mysql_fetch_array($sql_parent)){
						?>
                    <option value="<?= $show_parent['id']; ?>"><?= $show_parent['category_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Sub Catagory</label>
                   <select id="sub_category" name="sub_category" class="form-control" required >
                <option value="">Sub category</option>
                <option value="<?= $sql_classified_date['sid']; ?>" selected><?= $sql_classified_date['sub_category_name']; ?></option>
                  </select>
                </div>
                <?php /*?><div class="form-group col-sm-6">
                  <label for="">Location</label>
                  <select id="" name="location" class="form-control" required>
                    <option value="<?= $sql_classified_date['location']; ?>" selected>
                    <?= $sql_classified_date['location_name']; ?>
                    </option>
                    <?php 
							$sql_location = mysql_query("SELECT * FROM `dc_location`");
							while($show_location = mysql_fetch_array($sql_location)){
						?>
                    <option value="<?= $show_location['id']; ?>">
                    <?= $show_location['location_name']; ?>
                    (
                    <?= $show_location['country']; ?>
                    )</option>
                    <?php } ?>
                  </select>
                </div><?php */?>
                
                 <div class="form-group col-sm-6">
                  <label for="">Country</label>
                  <select id="countryId" name="country" class="form-control countries" required>
                   <option value="">Select Country</option>
                   <option value="<?= $sql_classified_date['country']; ?>" selected><?= $sql_classified_date['country']; ?></option>
                  </select>
                </div>
                                                
                <div class="form-group col-sm-6">
                  <label for="">State</label>
                  <select id="stateId" name="state" class="form-control states" required>
                   <option value="">Select State</option>
                   <option value="<?= $sql_classified_date['state']; ?>" selected><?= $sql_classified_date['state']; ?></option>
                  </select>
                </div>
                
                <div class="form-group col-sm-6">
                  <label for="">City</label>
                  <select id="cityId" name="city" class="form-control cities">
                  <option value="">Select City</option>        
                   <option value="<?= $sql_classified_date['city']; ?>" selected><?= $sql_classified_date['city']; ?></option>
                            
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Location Name</label>
                  <input type="text" name="location_name" id="location_name" value="<?= $sql_classified_date['location_name']; ?>" placeholder="Locaton Name" class="form-control" required >
                  </div>
                <div class="form-group col-sm-6">
                  <label for="">Zip/Pin Code</label>
                  <input type="text" name="zip" id="zip" value="<?= $sql_classified_date['zipcode']; ?>" placeholder="Zip Code" maxlength="6" class="form-control" required >
                  </div>
                  
                  <div class="form-group col-sm-6">
                  <label for="">Contact No.</label>
                  <input type="text" name="mobile_no" id="mobile_no" value="<?= $sql_classified_date['mobile']; ?>" placeholder="Mobile No." maxlength="12" class="form-control" required>
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
                <div class="form-group col-sm-12" style="margin-bottom:0px;">
                  <h3 class="text-info">Social Links</h3>
                  <hr>
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Facebook</label>
                  <input type="text" name="facebook" class="form-control" placeholder="Facebook Link" value="<?= $sql_classified_date['facebook']; ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Google+</label>
                  <input type="text" name="google" class="form-control" placeholder="Google+ Link" value="<?= $sql_classified_date['google']; ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Linkedin</label>
                  <input type="text" name="linkedin" class="form-control" placeholder="Linkedin Link" value="<?= $sql_classified_date['linkedin']; ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="">Twitter</label>
                  <input type="text" name="twitter" class="form-control" placeholder="Twitter Link" value="<?= $sql_classified_date['twitter']; ?>">
                </div>
                <div class="form-group col-sm-12">
                  <label for="">Details</label>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h6 class="panel-title"><i class="icon-pencil"></i>Description</h6>
                    </div>
                    <div class="panel-body">
                      <div class="block-inner">
                        <textarea class="ckeditor" name="desc" placeholder="Enter text ..." required><?= $sql_classified_date['description']; ?>
</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer"> <a href="manage-classified">
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
            <h3 class="box-title">Manage Classified Data</h3>
           
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
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				  
				  //dc_classified_post.experiance,dc_classified_post.qualification,
					 $i = 1;
					 $sql_post = mysql_query("SELECT dc_classified_post.unique_id,dc_classified_post.id AS idd,dc_classified_post.user_image,dc_classified_post.name,
dc_classified_post.mobile,
dc_classified_post.status,dc_classified_post.parent_category,
dc_classified_post.sub_category,
dc_classified_post.status,dc_classified_post.description,
dc_classified_post.facebook,dc_classified_post.google,
dc_classified_post.linkedin,dc_classified_post.twitter,
dc_location.id,dc_location.location_name,dc_category.id,
dc_category.category_name,dc_sub_category.id,dc_sub_category.sub_category_name 
FROM dc_classified_post INNER JOIN
 dc_location ON dc_classified_post.unique_id = dc_location.unique_id
 INNER JOIN dc_category ON 
dc_classified_post.parent_category = dc_category.id INNER JOIN 
dc_sub_category ON 
dc_classified_post.sub_category = dc_sub_category.id");
					while($show_post = mysql_fetch_array($sql_post)){
						?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><img src="../<?= $show_post['user_image']; ?>" class="img-thumbnail" style="height:50px; width:50px;"></td>
                    <td><?= $show_post['name']; ?></td>
                    <td><?= $show_post['category_name']; ?></td>
                    <td><?= $show_post['sub_category_name']; ?></td>
                    <td><?= $show_post['location_name']; ?></td>
                    <td><?php if($show_post['status'] == '1'){	echo 'Active'; } else { echo 'Inactive'; } ?></td>
                    <td><a href="manage-classified?id=<?= $show_post['unique_id']; ?>&flag=edit"><i class="fa fa-fw fa-edit text-success"></i></a> &nbsp; <a href="manage-classified?id=<?= $show_post['unique_id']; ?>&flag=delete" class="delete_row"><i class="fa fa-fw fa-trash text-danger"></i></a></td>
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
			$(".classified").addClass("active"); // instead of this do the below
			$(".manage-classified").addClass("active"); // instead of this do the below
		
		});
		</script>