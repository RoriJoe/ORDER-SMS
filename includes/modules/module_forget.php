<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center">
			<table border="1" cellpadding="5" cellspacing="0" class="myform">
				<tr>
					<td colspan="2" align="left" class="mycaption">
						<?php echo(_set_label_("", "LUPA PASSWORD")); ?>
					</td>
				</tr>
                <tr>
					<td colspan="2" align="left" class="mycaption">
						<?php echo(_set_label_("", "Pastikan HP Anda Dalam Kondisi Aktif, Kami Segera Mengirimkannya Pada Anda!")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_forget, "process=forget")); ?>" method="post">
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
                                <?php if(_is_session_registered_("session_success")){ ?>
								<tr>
									<td colspan="2" align="left" class="mysuccess">
										<?php echo(_set_image_link_(def_directory_images_buttons . "success.png", "", "", "48px", "48px")); ?>
										<?php echo(_set_label_("", $session_success)); ?>
									</td>
								</tr>
								<?php
										_set_session_unregister_("session_success");
									}
								?>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Pemakai")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_userid", "", "text", 'tabindex="1" maxlength="30" style="width: 400px;"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right">
										<?php echo(_set_submit_("", "Konfirmasi")); ?>
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