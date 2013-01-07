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
						<?php echo(_set_label_("", "MENU")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form enctype="multipart/form-data" action="<?php echo(_set_link_(def_application_menu, "process=update&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Menu")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
                                        <?php echo(_set_label_("", $var_class_menu->var_menuid)); ?>
										<?php echo(_set_input_("txt_menuid", $var_class_menu->var_menuid, "hidden")); ?>
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
										<?php echo(_set_input_("txt_nama", $var_class_menu->var_nama, "text", 'tabindex="1" maxlength="60"')); ?>
									</td>
								</tr>
                                 <tr>
									<td align="left">
										<?php echo(_set_label_("", "Kode Inisial")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_kodemenu", $var_class_menu->var_kodemenu, "text", 'tabindex="4" maxlength="3"')); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Restoran")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
                                        <?php
                                            require_once("../" . def_directory_classes_master . "class_restoran.php");
                                            $var_class_restoran = new _class_restoran_("", "", "Y");

                                            echo($var_class_restoran->_set_pulldown_("slt_restoranid", $var_class_menu->var_restoranid));
                                        ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Jenis")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
                                        <?php
                                            require_once("../" . def_directory_classes_master . "class_jenis.php");
                                            $var_class_jenis = new _class_jenis_();

                                            echo($var_class_jenis->_set_pulldown_("slt_jenisid", $var_class_menu->var_jenisid));
                                        ?>
									</td>
								</tr>
                                <tr>
									<td align="center" colspan="3">
										<?php echo(_set_image_link_("../" . def_directory_images_menu . $var_class_menu->var_menuid . ".jpg", "", "", "100px", "100px")); ?>
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
										<?php echo(_set_label_("", "Keterangan")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
                                        <?php echo(_set_textarea_("txt_keterangan", $var_class_menu->var_keterangan)); ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_submit_("", "Simpan", "submit", 'class="mybutton"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_hyperlink_(def_application_menu, "Kembali")); ?>
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