<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<table border="1" cellpadding="5" cellspacing="0" class="myform">
				<tr>
					<td colspan="2" align="left" class="mycaption">
						<?php echo(_set_label_("", "Private Login")); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<form action="<?php echo(_set_link_(def_application_login, "process=login")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="0">
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Pemakai", 'class="mylabel"')); ?>
									</td>
									<td>
										<?php echo(_set_input_("txt_userid", "", "text", 'class="mytextinput"  onfocus="javascript:_set_focus_(this);" onblur="javascript:_set_focus_(this);" style="width: 150px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Password", 'class="mylabel"')); ?>
									</td>
									<td>
										<?php echo(_set_input_("txt_userpwd", "", "password", 'class="mytextinput"  onfocus="javascript:_set_focus_(this);" onblur="javascript:_set_focus_(this);" style="width: 150px;"', false)); ?>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="right">
										<?php echo(_set_submit_("", "Login", "submit", 'class="mybutton"')); ?>
									</td>
								</tr>
								<?php if(_is_session_registered_("session_error")){ ?>
								<tr>
									<td colspan="2" align="center" class="myerror">
										<?php echo(_set_label_("", $session_error)); ?>
									</td>
								</tr>
								<?php
										_set_session_unregister_("session_error");
									}
								?>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>