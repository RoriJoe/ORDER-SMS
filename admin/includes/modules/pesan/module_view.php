<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle"><?php echo(_set_label_("", "ORDER")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0"
	class="myform">
	<tr>
		<td align="right">
		<form
			action="<?php echo(_set_link_(def_application_order, "process=search")); ?>"
			method="post">
		<table border="0" cellpadding="2" cellspacing="0">
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "No Transaksi")); ?>
				</td>
				<td><?php echo(_set_input_("txt_notransaksi", "", "text")); ?></td>
			</tr>
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Pemakai")); ?>
				</td>
				<td>
                    <?php
                        require_once("../" . def_directory_classes_master . "class_pemakai.php");
                        $var_class_pemakai = new _class_pemakai_("", "", def_yes, def_yes, "~");

                        echo($var_class_pemakai->_set_pulldown_("slt_userid"));
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
				<td colspan="6" class="mytable_cpt"><?php echo(_set_label_("", "DAFTAR ORDER")); ?>
				</td>
			</tr>
			<tr>
				<td width="100px"><?php echo(_set_label_("", "No Transaksi")); ?>
				</td>
				<td width="200px"><?php echo(_set_label_("", "Pemakai")); ?></td>
                <td width="100px"><?php echo(_set_label_("", "Tanggal")); ?></td>
                <td width="120px"><?php echo(_set_label_("", "Alamat")); ?></td>
				<td width="15px">&nbsp;</td>
                <td width="15px">&nbsp;</td>
			</tr>
			<?php
			if(isset($var_class_pesan) && is_object($var_class_pesan)){
				if(_is_not_null_($var_class_pesan->var_array_pesan)){
					while(list($var_key, $var_value) = each($var_class_pesan->var_array_pesan)){
						?>
			<tr>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_key)); ?>
				</td>
                <td class="mytable_cnt"><?php echo(_set_label_("", $var_value['userid'] . '-' . _set_field_value(def_table_pemakai, "username", "userid='" . _set_input_string_($var_value['userid']) . "'"))); ?>
				</td>
                <td class="mytable_cnt"><?php echo(_set_label_("", $var_value['tanggal'])); ?>
				</td>
                <td class="mytable_cnt"><?php echo(_set_label_("", $var_value['alamat'])); ?>
				</td>
                <td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "info.png", def_application_order, "", "20px", "20px", "Ubah", "", "process=update&processid=" . $var_key)); ?>
				</td>
				<td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_order, "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key)); ?>
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
</table>