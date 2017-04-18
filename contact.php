<?php 
	include("header.php");
	include("small-banner.php");
?>
<!-- mail -->
	<div class="agileits_w3layouts_mail_grids">	
		<div class="col-md-7 w3l_mail_left">
			<div id="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1301.3483441866297!2d88.3391754359196!3d22.699643319480767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89ca3e9ebe629%3A0x68d4ee6ac3407831!2sEnglish+Rd%2C+Adarshnagar%2C+Konnagar%2C+Nabagram+Colony%2C+West+Bengal+712246!5e0!3m2!1sen!2sin!4v1490618284084" width="100%" height="415px" frameborder="0" style="border:0" allowfullscreen></iframe>
				
			</div>
		</div>
		<div class="col-md-5 w3l_mail_right">
			<h3>Contact Info</h3>
			<ul>
				<li><span><i class="fa fa-home" aria-hidden="true"></i>Address<label>:</label></span> 1234k Avenue, New York City.</li>
				<li><span><i class="fa fa-phone" aria-hidden="true"></i>Phone<label>:</label></span> (+012) 345 6432</li>
				<li><span><i class="fa fa-fax" aria-hidden="true"></i>Fax<label>:</label></span> +82-21-1218</li>
				<li><span><i class="fa fa-envelope" aria-hidden="true"></i>Email<label>:</label></span> <a href="mailto:info@example.com">info@example.com</a></li>
			
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	
	<div class="banner-bottom">
		<div class="container">
			<h3 class="wthree_head">get in touch with us</h3>
				<p class="agileits_w3layouts_para w3_agile_para">Etiam malesuada odio vitae enim malesuada accumsan diam sed.</p>
			<div class="agileinfo_mail_grids">
				<form action="#" method="post">
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Name" type="text" id="input-13" placeholder=" " required="" />
						<label class="input__label input__label--chisato" for="input-13">
							<span class="input__label-content input__label-content--chisato" data-content="Name">Name</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Email" type="email" id="input-14" placeholder=" " required="" />
						<label class="input__label input__label--chisato" for="input-14">
							<span class="input__label-content input__label-content--chisato" data-content="Email">Email</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Subject" type="text" id="input-15" placeholder=" " required="" />
						<label class="input__label input__label--chisato" for="input-15">
							<span class="input__label-content input__label-content--chisato" data-content="Subject">Subject</span>
						</label>
					</span>
					<textarea name="Message" placeholder="Your comment here..." required></textarea>
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</div>
<!-- //mail -->

<script src="js/classie.js"></script>
	<script>
		(function() {
			// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
			if (!String.prototype.trim) {
				(function() {
					// Make sure we trim BOM and NBSP
					var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
					String.prototype.trim = function() {
						return this.replace(rtrim, '');
					};
				})();
			}

			[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
				// in case the input is already filled..
				if( inputEl.value.trim() !== '' ) {
					classie.add( inputEl.parentNode, 'input--filled' );
				}

				// events:
				inputEl.addEventListener( 'focus', onInputFocus );
				inputEl.addEventListener( 'blur', onInputBlur );
			} );

			function onInputFocus( ev ) {
				classie.add( ev.target.parentNode, 'input--filled' );
			}

			function onInputBlur( ev ) {
				if( ev.target.value.trim() === '' ) {
					classie.remove( ev.target.parentNode, 'input--filled' );
				}
			}
		})();
	</script>
	
<?php include("footer.php"); ?>