<?php

class Mo_Firebase_Authentication_Admin_Support {
	
	public static function mo_firebase_authentication_support(){
	?>
		<div class="col-md-12" style="padding: 5px;">
				<div class="mo_firebase_auth_card" style="width:90%" >
					<h3 style="margin: 10px 0;">Contact us</h3>
					<p>Need any help?<br>Just send us a query so we can help you.</p>
					<table class="mo_settings_table">
					<form action="" method="POST">
						<?php wp_nonce_field('mo_firebase_auth_contact_us_form','mo_firebase_auth_contact_us_field'); ?>
						<input type="hidden" name="option" value="mo_firebase_auth_contact_us">
						
							<tr>
								<td><input style="width:95%;" type="email" placeholder="Enter email here"  name="mo_firebase_auth_contact_us_email" id="mo_firebase_auth_contact_us_email" required></td>
							</tr><tr><td></td></tr>
							<tr>
								<td><input style="width:95%;" type="tel" id="mo_firebase_auth_contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" placeholder="Enter phone here" name="mo_firebase_auth_contact_us_phone"></td>
							</tr><tr><td></td></tr>
							<tr>
								<td><textarea style="width:95%;" onkeypress="mo_firebase_auth_contact_us_valid_query(this)" onkeyup="mo_firebase_auth_contact_us_valid_query(this)" onblur="mo_firebase_auth_contact_us_valid_query(this)"  name="mo_firebase_auth_contact_us_query" placeholder="Enter query here" rows="5" id="mo_firebase_auth_contact_us_query" required></textarea></td>
							</tr><tr><td>
						<input type="submit" class="button button-primary button-large" style="width:100px; margin: 15px 0;" value="Submit"></td></tr>
					</form>
				</table>
					<p style="padding-right: 8%;">If you want custom features in the plugin, just drop an email at <a href="mailto:info@xecurify.com">info@xecurify.com</a></p>
				</div>
			</div>

		<script>
			jQuery("#mo_firebase_auth_contact_us_phone").intlTelInput();
			function mo_firebase_auth_contact_us_valid_query(f) {
			    !(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
			        /[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
			}

		</script>
	<?php
	}


}