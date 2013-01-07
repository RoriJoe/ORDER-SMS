<table border="0" width="100%" cellpadding="10" cellspacing="0">
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td align="center" class="mycaption">
						<?php echo(_set_label_("", "Tulis Pesan")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_write, "process=")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Nomor Telepon")); ?>
									</td>
									<td align="left">
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_nohp", "", "text", 'maxlength="30" style="width: 200px"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left" valign="top">
										<?php echo(_set_label_("", "Pesan")); ?>
									</td>
									<td align="left" valign="top">
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_textarea_("txt_pesan", "", 'onkeyup="_check_message_(this, \'div_check\', 160);" style="width: 200px"')); ?>
                                        <div id="div_check">
											<?php echo(_set_label_("", "Tinggal 160 Karakter")); ?>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="right">
										<?php echo(_set_submit_("", "Kirim")); ?>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php if(_is_session_registered_("session_error")){ ?>
	<tr>
		<td align="center" class="myerror">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<?php echo(_set_label_("", $session_error)); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		_set_session_unregister_("session_error");
	}
	?>
	<?php if(_is_session_registered_("session_success")){ ?>
	<tr>
		<td align="center" class="mysuccess">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<?php echo(_set_label_("", $session_success)); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		_set_session_unregister_("session_success");
	}
	?>
</table>