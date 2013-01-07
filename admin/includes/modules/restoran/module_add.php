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
						<?php echo(_set_label_("", "RESTORAN")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form enctype="multipart/form-data" action="<?php echo(_set_link_(def_application_restoran, "process=add&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Restoran")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_restoranid", $var_class_restoran->_set_increment_id_(), "text", 'tabindex="1" maxlength="3"', $var_reinsert_value)); ?>
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
									<td align="left">
										<?php echo(_set_label_("", "Jam Buka")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<div>
                                            <?php
                                                echo(_set_pulldown_time_("slt_bukajam") . _set_label_("", " : ") . _set_pulldown_time_("slt_bukamenit", "", "", "minute"));
                                            ?>
                                        </div>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Jam Tutup")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<div>
                                            <?php
                                                echo(_set_pulldown_time_("slt_tutupjam") . _set_label_("", " : ") . _set_pulldown_time_("slt_tutupmenit", "", "", "minute"));
                                            ?>
                                        </div>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Gambar")); ?>
									</td>
									<td>
                                        <?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
                                        <?php echo(_set_input_("txt_gambar", "", "file")); ?>
									</td>
								</tr>
                                <tr>
									<td colspan="3" align="left">
                                        <?php echo(_set_checkbox_("chk_activeyn", def_yes, "checkbox", false, "Aktif", 'class="mycheckbox"')); ?>
                                    </td>
                                </tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Handphone")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_handphone", "", "text", 'maxlength="30"', $var_reinsert_value)); ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_submit_("", "Simpan", "submit", 'class="mybutton"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_hyperlink_(def_application_restoran, "Kembali")); ?>
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