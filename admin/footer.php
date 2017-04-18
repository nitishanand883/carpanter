<div class="loader"></div>  
  
   <footer class="main-footer">
        <div class="pull-right hidden-xs">
         <!-- <b>Version</b> 2.3.0-->
        </div>
        <strong>Copyright &copy; 2015-<?= date('Y'); ?> <a href="http://theetsindia.com" target="_blank">Eclipse Technoconsulting Global Pvt. Ltd</a>.</strong> All rights reserved.
       
        <span id="SecondsUntilExpire" style="display:none;"></span>
      </footer>

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
   <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>-->
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="dist/js/pages/dashboard.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    
     <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!--<script src="plugins/countries.js"></script>-->
    <script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="plugins/location.js"></script>
	  
     <script>
      $(function () {
      
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
		
    </script>
<script type="text/javascript">
$(window).load(function() {
	
	$(".loader").fadeOut("slow");
})

$(document).ready(function() {
    
		$('.delete_row').on('click',function(){
				if(!confirm('Are You sure to delete this record.')){
				return false;	
				}
			});
	
});

var IDLE_TIMEOUT = 1800; //seconds
var _idleSecondsCounter = 0;
document.onclick = function() {
  _idleSecondsCounter = 0;
};
document.onmousemove = function() {
  _idleSecondsCounter = 0;
};
document.onkeypress = function() {
  _idleSecondsCounter = 0;
};

var myInterval = window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
  _idleSecondsCounter++;
  var oPanel = document.getElementById("SecondsUntilExpire");
  if (oPanel)
    oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
  if (_idleSecondsCounter >= IDLE_TIMEOUT) {
    //alert("Time expired!");
	window.location = "lockscreen";
    window.clearInterval(myInterval);
    oPanel.innerHTML = ("");
  }
}

function fetch_select(val){			
			$.ajax({
				type: 'post',
				url: 'fetch_sub_category.php',
				data: {
					get_option:val
				},
				success: function (response) {
					//console.log(response);
					$("#sub_category option").remove();
					$('#sub_category').append(response);
					
				}
			});
		}
		
$(document).ready(function(e)
{
	$("#username").change(function(e) 
	{ 
		var username = $("#username").val();
		if(username.length > 4)
		{
			$.ajax({  
			type: "POST",  
			url: "search-user-id.php",  
			data: "username="+ username, 
			dataType:"json",
			success: function(msg){  
				console.log(msg.output);
				$('#stat').val(msg.output);
				
				if(msg.output === 'OK'){ 
					$('#status').html(msg.output);
					$('#status').delay(700).hide(400);
					
				}  else if(msg.output === 'err'){ 
					
					$('#status').html('<STRONG style=color:red;>'+username+'</STRONG> is already in use.');
					$('#status').delay(1000).hide(1000);
				}				
		   } 		   
		  }); 		
		}
		else
		{
		$("#username").addClass("red");
		$("#status").html('<font color="#cc0000">Please Enter atleast 5 letters</font>');
		}
		return false;
	});
});
		
var check_int = function(a) {
    if (!a.match(/^\d+$/) && "" !== a) alert("Please type numbers in this field"); else ;
}

$(document).on('click','#sendEmail',function(e){
		
			$.ajax({
			url: "quick-mail.php",
			data: $("#dash_mail").serialize(),
			type: 'POST',
			success: function (data) {
				//console.log(data);
			if(data==1){
			$('#mail_stu').html("Mail successfull Send!!").fadeIn(400);
				$('#mail_stu').css('color','green');
			$('#mail_stu').delay(800).fadeOut(400);
			document.getElementById("dash_mail").reset();
			} else if(data==2){
				$('#mail_stu').html("Some Error Occurred");
				$('#mail_stu').css('color','red');
				$('#mail_stu').delay(800).hide(100);
				}
			}
		});
		e.preventDefault();
	});

</script>
  </body>
</html>
