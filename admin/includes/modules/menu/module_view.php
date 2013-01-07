<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle"><?php echo(_set_label_("", "MENU")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0"
	class="myform">
	<tr>
		<td align="right">
		<form
			action="<?php echo(_set_link_(def_application_menu, "process=search")); ?>"
			method="post">
		<table border="0" cellpadding="2" cellspacing="0">
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Id Menu")); ?>
				</td>
				<td><?php echo(_set_input_("txt_menuid", "", "text")); ?></td>
			</tr>
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Nama")); ?>
				</td>
				<td><?php echo(_set_input_("txt_nama", "", "text")); ?></td>
			</tr>
            <tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Restoran")); ?>
				</td>
				<td>
                    <?php
                        require_once("../" . def_directory_classes_master . "class_restoran.php");
                        $var_class_restoran = new _class_restoran_("", "", "Y");

                        echo($var_class_restoran->_set_pulldown_("slt_restoranid"));
                    ?>
                </td>
			</tr>
            <tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Jenis")); ?>
				</td>
				<td>
                    <?php
                        require_once("../" . def_directory_classes_master . "class_jenis.php");
                        $var_class_jenis = new _class_jenis_();

                        echo($var_class_jenis->_set_pulldown_("slt_jenisid"));
                    ?>
                </td>
			</tr>
            <tr>
                <td colspan="2" align="left">
                    <?php echo(_set_checkbox_("chk_activeyn", def_yes, "checkbox", "", "Aktif", 'class="mycheckbox"')); ?>
                </td>
            </tr>
			<tr>
				<td colspan="2" align="right"><?php echo(_set_submit_("", "Cari", "submit")); ?>
				</td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
</table>

<table border="0" cellpadding="5" cellspacing="2">
	<tr>
		<td>
		<table border="0" cellpadding="0" cellspacing="0" class="mytable_brw">
			<tr>
				<td colspan="6" class="mytable_cpt"><?php echo(_set_label_("", "DAFTAR MENU")); ?>
				</td>
			</tr>
			<tr>
				<td width="120px"><?php echo(_set_label_("", "Id Menu")); ?>
				</td>
				<td width="250px"><?php echo(_set_label_("", "Nama")); ?></td>
                <td width="250px"><?php echo(_set_label_("", "Restoran")); ?></td>
                <td width="250px"><?php echo(_set_label_("", "Inisial")); ?></td>
				<td width="15px">&nbsp;</td>
                <td width="15px">&nbsp;</td>
			</tr>
			<?php
			if(isset($var_class_menu) && is_object($var_class_menu)){
				if(_is_not_null_($var_class_menu->var_array_menu)){
					while(list($var_key, $var_value) = each($var_class_menu->var_array_menu)){
						?>
			<tr>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_key)); ?>
				</td>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_value['nama'])); ?>
				</td>
                <td class="mytable_cnt"><?php echo(_set_label_("", _set_field_value(def_table_restoran, "nama", "restoranid='" . _set_input_string_($var_value['restoranid']) . "'"))); ?>
				</td>
                <td class="mytable_cnt"><?php echo(_set_label_("", $var_value['kodemenu'])); ?>
				</td>
                <td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "info.png", def_application_menu, "", "20px", "20px", "Ubah", "", "process=update&processid=" . $var_key)); ?>
				</td>
				<td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_menu, "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key)); ?>
				</td>
			</tr>

			<?php
					}
				}
			}
			?>
		</table>
		</td>
	</tr>
	<tr>
		<td><?php echo(_set_hyperlink_(def_application_menu, "Tambah Menu", "", "process=add")); ?>
		</td>
	</tr>
</table>