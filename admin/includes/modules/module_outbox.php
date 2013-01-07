<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle">
			<?php echo(_set_label_("", "KOTAK KELUAR")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0" class="myform">
	<tr>
		<td align="right">
			<form action="<?php echo(_set_link_(def_application_outbox, "process=search")); ?>" method="post">
				<table border="0" cellpadding="2" cellspacing="0">
					<tr>
						<td align="left" class="mytext">
							<?php echo(_set_label_("", "No Handphone")); ?>
						</td>
						<td>
							<?php echo(_set_input_("txt_nohp", "", "text")); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<?php echo(_set_submit_("", "Cari", "submit")); ?>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>

<table border="0" cellpadding="5" cellspacing="2">
	<?php if(_is_session_registered_("session_process")){ ?>
	<tr>
		<td align="center" class="mycaption">
			<table border="0" cellpadding="3" cellspacing="3">
				<tr>
					<td colspan="2">
						<?php echo(_set_label_("", $session_process)); ?>
					</td>
				</tr>
				<tr>
					<td align="left">
                        <?php
                            if(_set_variable_http_("process") == "reply"){
                                echo(_set_hyperlink_(def_application_outbox, "Kirim Lagi", "", "process=reply&processid=" . $HTTP_GET_VARS["processid"] . "&action=true"));
                            }else{
                                echo(_set_hyperlink_(def_application_outbox, "Hapus", "", "process=delete&processid=" . $HTTP_GET_VARS["processid"] . "&action=true"));
                            }
                        ?>
					</td>
					<td align="right">
						<?php echo(_set_hyperlink_(def_application_outbox, "Tidak")) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		_set_session_unregister_("session_process");
	}
	?>

    <?php
        if(_set_variable_http_("process") == "deleteall"){
    ?>
    <tr>
        <td align="center" class="mycaption">
            <table border="0" cellpadding="5" cellspacing="2">
                <tr>
                    <td colspan="2" align="center">
                        <?php echo(_set_label_("", "Apakah Anda Yakin Untuk Menghapus Semuanya?")); ?>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <?php
                            echo(_set_hyperlink_(def_application_outbox, "Hapus", "", "process=deleteall&action=true"));
                        ?>
                    </td>
                    <td align="right">
                        <?php echo(_set_hyperlink_(def_application_outbox, "Tidak")) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php } ?>

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
			<table border="0" cellpadding="0" cellspacing="0" class="mytable_brw">
				<tr>
					<td colspan="5" class="mytable_cpt">
						<?php echo(_set_label_("", "DAFTAR KOTAK KELUAR")); ?>
					</td>
				</tr>
				<tr>
					<td width="150px">
						<?php echo(_set_label_("", "Tanggal")); ?>
					</td>
					<td width="200px">
						<?php echo(_set_label_("", "No Handphone")); ?>
					</td>
					<td width="300px">
						<?php echo(_set_label_("", "Pesan")); ?>
					</td>
					<td width="15px">&nbsp;</td>
					<td width="15px">
                        <?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_outbox , "", "20px", "20px", "Hapus Semua", "", "process=deleteall")); ?>
                    </td>
				</tr>
				<?php
					if(isset($var_class_outbox) && is_object($var_class_outbox)){
						if(_is_not_null_($var_class_outbox->var_array_outbox)){
							while(list($var_key, $var_value) = each($var_class_outbox->var_array_outbox)){
				?>
				<tr>
					<td class="mytable_cnt">
						<?php echo(_set_label_("", $var_value['tanggal'])); ?>
					</td>
					<td class="mytable_cnt">
						<?php echo(_set_label_("", $var_value['nohp'])); ?>
					</td>
					<td class="mytable_cnt">
						<?php echo(_set_label_("", $var_value['pesan'])); ?>
					</td>
					<td align="center">
						<?php echo(_set_image_link_("../" . def_directory_images_buttons . "reply.gif", def_application_outbox , "", "20px", "20px", "Kirim Lagi", "", "process=reply&processid=" . $var_key)); ?>
					</td>
					<td align="center">
						<?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_outbox , "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key)); ?>
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
		<td>
			<?php echo(_set_hyperlink_(def_application_outbox, "Ambil Dari Handphone", "", "process=handphone")); ?>
		</td>
	</tr>
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
</table>