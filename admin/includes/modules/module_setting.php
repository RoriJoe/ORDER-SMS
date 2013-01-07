<table border="0" width="100%" cellpadding="10" cellspacing="0">
	<tr>
		<td>
		<table border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td align="center" class="mycaption"><?php echo(_set_label_("", "Setting")); ?>
				</td>
			</tr>
			<tr>
				<td>
				<form
					action="<?php echo(_set_link_(def_application_setting, "process=")); ?>"
					method="post">
				<table border="0" cellpadding="3" cellspacing="0" align="center"
					class="myform">
					<tr>
						<td align="left"><?php echo(_set_label_("", "Konektifitas")); ?></td>
						<td><?php echo(_set_label_("", " : ")); ?></td>
						<td align="left"><?php
						require_once("../" . def_directory_classes_master . "class_handphone.php");
						$var_class_handphone = new _class_handphone_();
						
						echo($var_class_handphone->_set_pulldown_("slt_handphoneno"));
						?></td>
					</tr>
					<tr>
						<td align="left"><?php echo(_set_label_("", "Auto Refresh")); ?></td>
						<td><?php echo(_set_label_("", " : ")); ?></td>
						<td align="left"><?php echo(_set_input_("txt_autorefresh", $var_class_setting->var_autorefresh, "text", 'maxlength="3" style="width: 50px;"')); echo(_set_label_("", " s ")); ?>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="left"><input type="checkbox"
							name="chk_autoreply"
							<?php echo($var_class_setting->var_autoreply); ?> value="1"><?php echo(_set_label_("", " Autoreply ", 'for="chk_autoreply"')); ?>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right"><?php echo(_set_submit_("", "Simpan", "submit", 'class="mybutton"')); ?>
						</td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<?php if(_is_session_registered_("session_error")){ ?>
	<tr>
		<td align="center" class="myerror">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><?php echo(_set_label_("", $session_error)); ?></td>
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
				<td><?php echo(_set_label_("", $session_success)); ?></td>
			</tr>
		</table>
		</td>
	</tr>
	<?php
	_set_session_unregister_("session_success");
	}
	?>
</table>