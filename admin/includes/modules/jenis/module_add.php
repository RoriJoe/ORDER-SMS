<?php $var_reinsert_value = false; ?>

<table border="0" width="100%" cellpadding="5" cellspacing="2">
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
		
		$var_reinsert_value = true;
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
		
		$var_reinsert_value = false;
	}
	?>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td align="center" class="mycaption">
						<?php echo(_set_label_("", "JENIS")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_jenis, "process=add&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Jenis")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_jenisid", "", "text", 'tabindex="1" maxlength="3"', $var_reinsert_value)); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Nama")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_nama", "", "text", 'tabindex="2" maxlength="60"', $var_reinsert_value)); ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_submit_("", "Simpan", "submit", 'class="mybutton"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_hyperlink_(def_application_jenis, "Kembali")); ?>
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