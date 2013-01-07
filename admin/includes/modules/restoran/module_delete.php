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
						<?php echo(_set_label_("", "RESTORAN")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_restoran, "process=delete&processid=" . $HTTP_GET_VARS["processid"] . "&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0" align="center" class="myform">
								<?php if($var_view == true){ ?>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Restoran")); ?>
									</td>
									<td>
										<?php echo(_set_label_("", " : ")); ?>
									</td>
									<td align="left">
										<?php echo(_set_label_("", $var_class_restoran->var_restoranid)); ?>
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
										<?php echo(_set_label_("", $var_class_restoran->var_nama)); ?>
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
										<?php echo(_set_hyperlink_(def_application_restoran, "Kembali")); ?>
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