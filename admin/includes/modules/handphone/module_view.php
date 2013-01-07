<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle"><?php echo(_set_label_("", "KONEKTIFITAS")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0"
	class="myform">
	<tr>
		<td align="right">
		<form
			action="<?php echo(_set_link_(def_application_handphone, "process=search")); ?>"
			method="post">
		<table border="0" cellpadding="2" cellspacing="0">
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Model Handphone")); ?>
				</td>
				<td><?php echo(_set_input_("txt_model", "", "text")); ?></td>
			</tr>
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Port")); ?>
				</td>
				<td><?php echo(_set_input_("txt_port", "", "text")); ?></td>
			</tr>
			<tr>
				<td align="left" class="mytext"><?php echo(_set_label_("", "Koneksi")); ?>
				</td>
				<td><?php echo(_set_input_("txt_connection", "", "text")); ?></td>
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
				<td colspan="5" class="mytable_cpt"><?php echo(_set_label_("", "DAFTAR KONEKTIFITAS")); ?>
				</td>
			</tr>
			<tr>
				<td width="150px"><?php echo(_set_label_("", "Model Handphone")); ?>
				</td>
				<td width="200px"><?php echo(_set_label_("", "Port")); ?></td>
				<td width="200px"><?php echo(_set_label_("", "Koneksi")); ?></td>
				<td width="50px"><?php echo(_set_label_("", "Aktif")); ?></td>
				<td width="15px">&nbsp;</td>
			</tr>
			<?php
			if(isset($var_class_handphone) && is_object($var_class_handphone)){
				if(_is_not_null_($var_class_handphone->var_array_handphone)){
					while(list($var_key, $var_value) = each($var_class_handphone->var_array_handphone)){
						?>
			<tr>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_value['model'])); ?>
				</td>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_value['port'])); ?>
				</td>
				<td class="mytable_cnt"><?php echo(_set_label_("", $var_value['connection'])); ?>
				<td class="mytable_cnt">
				<?php
					if($var_value['activeyn'] == "Y"){
						echo(_set_label_("", "Ya"));
					}else{
						echo(_set_label_("", "Tidak"));
					}
				?>
				</td>
				<td align="center"><?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_handphone , "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key)); ?>
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
		<td><?php echo(_set_hyperlink_(def_application_handphone, "Tambah Koneksi", "", "process=add")); ?>
		</td>
	</tr>
</table>