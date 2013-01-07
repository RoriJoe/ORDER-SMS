<?php $var_view = true; ?>

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
		
		$var_view = false;
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
		
		$var_view = false;
	}
	?>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td align="center" class="mycaption">
						<?php echo(_set_label_("", "ORDER")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_order, "process=delete&processid=" . $HTTP_GET_VARS["processid"] . "&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<?php if($var_view == true){ ?>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "No Transaksi")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_label_("", $var_class_pesan->var_notransaksi)); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Pemakai")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_label_("", $var_class_pesan->var_userid . '-' . _set_field_value(def_table_pemakai, "username", "userid='" . _set_input_string_($var_class_pesan->var_userid) . "'"))); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Tanggal")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_label_("", $var_class_pesan->var_tanggal)); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Alamat")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_label_("", $var_class_pesan->var_alamat)); ?>
									</td>
								</tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table border="0" cellpadding="5" cellspacing="5" class="mytable_brw">
                                            <tr>
                                                <td colspan="5" align="center" class="mytable_cpt"><?php echo(_set_label_("", "DAFTAR ORDER")); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo(_set_label_("", "Menu")); ?></td>
                                                <td><?php echo(_set_label_("", "Qty")); ?></td>
                                            </tr>
                                            <?php
                                                $var_query_link = _set_query_("SELECT * FROM " . def_table_pesan_detil . " WHERE notransaksi='" . _set_input_string_($var_class_pesan->var_notransaksi) . "'");

                                                while($var_array_pesan = _set_fetch_array_($var_query_link)){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo(_set_label_("", $var_array_pesan['menuid'] . ' - ' . _set_field_value(def_table_menu, "nama", "menuid='" . _set_input_string_($var_array_pesan['menuid']) . "'"))); ?>
                                                </td>
                                                <td>
                                                    <?php echo(_set_label_("", $var_array_pesan['qty'])); ?>
                                                </td>
                                            </tr>

                                            <?php } ?>
                                        </table>
                                    </td>
                                </tr>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_submit_("", "Hapus", "submit", 'class="mybutton"')); ?>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="3" align="center">
										<?php echo(_set_hyperlink_(def_application_order, "Kembali")); ?>
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