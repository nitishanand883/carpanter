<!-- banner -->
	<div class="banner jarallax">
		<div class="agileinfo-dot">
		<?php include("nav-upper.php"); ?>			
			<div class="w3layouts-banner">
				<div class="container">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
							<?php $sql_banner = mysql_query("SELECT * FROM `cp_banner` WHERE `status` = '1'");
									while($show_banner = mysql_fetch_array($sql_banner)){
								?>
								<li>
									<div class="agileits_w3layouts_banner_info">
										<h3><?= $show_banner['heading']; ?></h3>
										<p><?= $show_banner['text']; ?></p>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
				</section>
			<!-- flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
					$(window).load(function(){
					  $('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					  });
					});
				</script>
			<!-- //flexSlider -->

				</div>
			</div>
		</div>
	</div>
	<!-- //banner -->