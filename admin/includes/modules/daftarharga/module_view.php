<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle"><?php echo(_set_label_("", "DAFTAR HARGA")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0"
	class="myform">
	<tr>
		<td align="right">
		<form
			action="<?php echo(_set_link_(def_application_daftarharga, "process=search")); ?>"
			method="post">
		<table border="0" cellpadding="2" cellspacing="0">
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Menu")); ?>
				</td>
				<td>
                    <?php
                        require_once("../" . def_directory_classes_master . "class_menu.php");
                        $var_class_menu = new _class_menu_("", "", "", "", def_yes);

                        echo($var_class_menu->_set_pulldown_("slt_menuid"));
                    ?>
                </td>
			</tr>
            <tr>
                <td align="left" class="mytext"><?php echo(_set_label_("", "Dari Tanggal")); ?>
				</td>
				<td>
                    <?php
                        echo(_set_pulldown_date_("slt_daritanggal") . _set_pulldown_date_("slt_daribulan", "", "", "month") . _set_pulldown_date_("slt_daritahun", "", "", "year"));
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left" class="mytext"><?php echo(_set_label_("", "Sampai Tanggal")); ?>
				</td>
				<td>
                    <?php
                        echo(_set_pulldown_date_("slt_sampaitanggal") . _set_pulldown_date_("slt_sampaibulan", "", "", "month") . _set_pulldown_date_("slt_sampaitahun", "", "", "year"));
                    ?>
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
				<td colspan="4" class="mytable_cpt"><?php echo(_set_label_("", "DAFTAR HARGA")); ?>
				</td>
			</tr>
			<tr>
				<td width="200px"><?php echo(_set_label_("", "Menu")); ?></td>
                <td width="120px"><?php echo(_set_label_("", "Harga")); ?></td>
				<td width="15px">&nbsp;</td>
                <td width="15px">&nbsp;</td>
			</tr>
			<?php
			if(isset($var_class_daftarharga) && is_object($var_class_daftarharga)){
				if(_is_not_null_($var_class_daftarharga->var_array_daftarharga)){
					while(list($var_key, $var_value) = each($var_class_daftarharga->var_array_daftarharga)){
						?>
			<tr>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_value['menuid'] . '-' . _set_field_value(def_table_menu, "nama", "menuid='" . _set_input_string_($var_value['menuid']) . "'"))); ?>
				</td>
                <td class="mytable_cnt"><?php echo(_set_label_("", $var_value['harga'])); ?>
				</td>
                <td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "info.png", def_application_daftarharga, "", "20px", "20px", "Ubah", "", "process=update&processid=" . $var_key)); ?>
				</td>
				<td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_daftarharga, "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key . "&menuid=" . $var_value['menuid'])); ?>
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
		<td><?php echo(_set_hyperlink_(def_application_daftarharga, "Tambah Harga", "", "process=add")); ?>
		</td>
	</tr>
</table>