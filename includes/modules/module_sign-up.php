<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center">
			<table border="1" cellpadding="5" cellspacing="0" class="myform">
				<tr>
					<td colspan="2" align="left" class="mycaption">
						<?php echo(_set_label_("", "PEMAKAI BARU")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_signup, "process=signup")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="5">
								<?php if(_is_session_registered_("session_error")){ ?>
								<tr>
									<td colspan="2" align="left" class="myerror">
										<?php echo(_set_image_link_(def_directory_images_buttons . "error.png", "", "", "48px", "48px")); ?>
										<?php echo(_set_label_("", $session_error)); ?>
									</td>
								</tr>
								<?php
										_set_session_unregister_("session_error");
									}
								?>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Pemakai")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_userid", "", "text", 'tabindex="1" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Nama")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_username", "", "text", 'tabindex="2" maxlength="60" style="width: 300px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Email")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_email", "", "text", 'tabindex="3" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Alamat")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_address", "", "text", 'tabindex="4" maxlength="200" style="width: 400px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Handphone")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_handphone", "", "text", 'tabindex="5" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Telepon")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_phone", "", "text", 'tabindex="6" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Password")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_userpwd", "", "password", 'tabindex="6" maxlength="20" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right">
										<?php echo(_set_submit_("", "Signup")); ?>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>