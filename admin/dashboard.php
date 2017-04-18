<?php include 'header.php'; ?> 
 <?php include 'left-panel.php'; ?> 
 
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <?php $sql_post =mysql_fetch_array(mysql_query("SELECT count(*) AS c FROM `dc_classified_post`")); ?>
                  <h3><?= $sql_post['c']; ?></h3>
                  <p>Total Post</p>
                </div>
                <div class="icon">
               <i class="ion ion-person-add"></i>
                </div>
                <a href="manage-classified" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                 <?php $sql_post =mysql_fetch_array(mysql_query("SELECT count(*) AS c FROM `dc_category` WHERE `status`=1")); ?>
                  <h3><?= $sql_post['c']; ?></h3>
                  <p>Category</p>
                </div>
                <div class="icon">
                  <i class="fa fa-files-o"></i>
                </div>
                <a href="manage-catagory" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php $sql_post =mysql_fetch_array(mysql_query("SELECT count(*) AS c FROM `dc_sub_category` WHERE `status`=1")); ?>
                  <h3><?= $sql_post['c']; ?></h3>
                  <p>Sub Category</p>
                </div>
                <div class="icon">
                   <i class="fa fa-files-o"></i>
                </div>
                <a href="manage-sub-catagory" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                 <?php $sql_post =mysql_fetch_array(mysql_query("SELECT count(*) AS c FROM `dc_location` WHERE `status`=1")); ?>
                  <h3><?= $sql_post['c']; ?></h3>
                  <p>Location</p>
                </div>
                <div class="icon">
                  <i class="fa fa-map"></i>
                </div>
                <a href="manage-location" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
           
          
               <div class="form-group col-sm-6">
             <!-- quick email widget -->
             	<div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Quick Email</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                  <span id="mail_stu" style="margin-right:20px;"></span>
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div>
                <div class="box-body">
                  <form action="" method="post" id="dash_mail">
                    <div class="form-group">
                      <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                    <div>
                      <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="msg"></textarea>
                    </div>
                  </form>
                  
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-default" id="sendEmail" name="sendEmail" type="submit">Send <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </div>
				</div>
                
          </div><!-- /.row -->
          	   
          <!-- Main row -->
          <!-- /.row (main row) -->

        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php include 'footer.php'; ?> 
      
           <script>
		$(document).ready(function() {
			$(".treeview").removeClass("active");
			$(".dashboard").addClass("active"); // instead of this do the below
		});
		</script>