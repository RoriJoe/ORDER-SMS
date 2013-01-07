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
						<?php echo(_set_label_("", "MENU")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form enctype="multipart/form-data" action="<?php echo(_set_link_(def_application_menu, "process=add&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Menu")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_menuid", $var_class_menu->_set_increment_id_(), "text", 'tabindex="1" maxlength="3"', $var_reinsert_value)); ?>
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
										<?php echo(_set_label_("", "Kode Inisial")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_kodemenu", "", "text", 'tabindex="3" maxlength="4"', $var_reinsert_value)); ?>
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

                                            echo($var_class_restoran->_set_pulldown_("slt_restoranid", "", 'tabindex="4"', $var_reinsert_value));
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

                                            echo($var_class_jenis->_set_pulldown_("slt_jenisid", "", 'tabindex="5"', $var_reinsert_value));
                                        ?>
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
									<td align="left">
										<?php echo(_set_label_("", "Harga")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_harga", "", "text", 'tabindex="6" maxlength="7"', $var_reinsert_value)); ?>
									</td>
								</tr>
                                <tr>
									<td colspan="3" align="left">
                                        <?php echo(_set_checkbox_("chk_activeyn", def_yes, "checkbox", false, "Aktif", 'class="mycheckbox"')); ?>
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
                                        <?php echo(_set_textarea_("txt_keterangan", "", "", $var_reinsert_value)); ?>
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