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
						<form enctype="multipart/form-data" action="<?php echo(_set_link_(def_application_restoran, "process=update&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Restoran")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
                                        <?php echo(_set_label_("", $var_class_restoran->var_restoranid)); ?>
										<?php echo(_set_input_("txt_restoranid", $var_class_restoran->var_restoranid, "hidden")); ?>
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
										<?php echo(_set_input_("txt_nama", $var_class_restoran->var_nama, "text", 'tabindex="2" maxlength="60"')); ?>
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
                                                $var_array_content = explode(':', $var_class_restoran->var_buka);
                                                
                                                echo(_set_pulldown_time_("slt_bukajam", $var_array_content[0]) . _set_label_("", " : ") . _set_pulldown_time_("slt_bukamenit", $var_array_content[1], "", "minute"));
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
                                                $var_array_content = explode(':', $var_class_restoran->var_tutup);
                                                
                                                echo(_set_pulldown_time_("slt_tutupjam", $var_array_content[0]) . _set_label_("", " : ") . _set_pulldown_time_("slt_tutupmenit", $var_array_content[1], "", "minute"));
                                            ?>
                                        </div>
									</td>
								</tr>
                                <tr>
									<td align="center" colspan="3">
										<?php echo(_set_image_link_("../" . def_directory_images_restoran . $var_class_restoran->var_restoranid . ".jpg", "", "", "150px", "200px")); ?>
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
                                        <?php echo(_set_checkbox_("chk_activeyn", def_yes, "checkbox", $var_class_restoran->var_activeyn, "Aktif", 'class="mycheckbox"')); ?>
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
										<?php echo(_set_input_("txt_handphone", $var_class_restoran->var_handphone, "text", 'maxlength="30"')); ?>
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