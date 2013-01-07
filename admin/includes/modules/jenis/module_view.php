<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle"><?php echo(_set_label_("", "JENIS")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0"
	class="myform">
	<tr>
		<td align="right">
		<form
			action="<?php echo(_set_link_(def_application_jenis, "process=search")); ?>"
			method="post">
		<table border="0" cellpadding="2" cellspacing="0">
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Jenis Id")); ?>
				</td>
				<td><?php echo(_set_input_("txt_jenisid", "", "text")); ?></td>
			</tr>
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Nama")); ?>
				</td>
				<td><?php echo(_set_input_("txt_nama", "", "text")); ?></td>
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
				<td colspan="4" class="mytable_cpt"><?php echo(_set_label_("", "DAFTAR JENIS")); ?>
				</td>
			</tr>
			<tr>
				<td width="120px"><?php echo(_set_label_("", "Id Jenis")); ?>
				</td>
				<td width="250px"><?php echo(_set_label_("", "Nama")); ?></td>
				<td width="15px">&nbsp;</td>
                <td width="15px">&nbsp;</td>
			</tr>
			<?php
			if(isset($var_class_jenis) && is_object($var_class_jenis)){
				if(_is_not_null_($var_class_jenis->var_array_jenis)){
					while(list($var_key, $var_value) = each($var_class_jenis->var_array_jenis)){
						?>
			<tr>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_key)); ?>
				</td>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_value['nama'])); ?>
				</td>
                <td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "info.png", def_application_jenis, "", "20px", "20px", "Ubah", "", "process=update&processid=" . $var_key)); ?>
				</td>
				<td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_jenis, "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key)); ?>
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
		<td><?php echo(_set_hyperlink_(def_application_jenis, "Tambah Jenis", "", "process=add")); ?>
		</td>
	</tr>
</table>