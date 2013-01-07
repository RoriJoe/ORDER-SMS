<?php
	$var_class_gammu->_gammu_info_($var_respon);
?>

<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle">
			<?php echo(_set_label_("", "INFORMASI")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0" class="myform">
	<tr>
		<td align="left">
			<table border="0" cellpadding="5" cellspacing="5">
				<?php
					for($var_counter=0; $var_counter < sizeof($var_respon); $var_counter++){
						$var_content = explode(':', $var_respon[$var_counter]);
				?>
				<tr>
					<?php for($var_content_counter=0; $var_content_counter < sizeof($var_content); $var_content_counter++){ ?>
					<td align="left" class="mytext">
						<?php echo(_set_label_("", $var_content[$var_content_counter])); ?>
					</td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>