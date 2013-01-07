<?php
	_set_session_close_();
	_set_close_connection_();
?>

<table border="0" width="100%" cellpadding="3" cellspacing="0" class="mymenu">
	<tr>
		<td align="center">
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>
						<?php echo(_set_image_link_(def_directory_images_sponsor . "teh_botol_sosro.gif", "http://www.sosro.com/indonesia/teh_botol.htm", "", "51px", "94px", "", "", "", "0", false)); ?>
					</td>
					<td width="10px">&nbsp;</td>
					<td>
						<?php echo(_set_image_link_(def_directory_images_sponsor . "coca_cola.gif", "http://www.coca-colabottling.co.id/ina/index.php", "", "51", "105", "", "", "", "0", false)); ?>
					</td>
					<td width="10px">&nbsp;</td>
					<td>
						<?php echo(_set_image_link_(def_directory_images_sponsor . "pocari_sweat.jpg", "http://www.pocarisweat.com.ph/", "", "61", "105", "", "", "", "0", false)); ?>
					</td>
					<td width="10px">&nbsp;</td>
					<td>
						<?php echo(_set_image_link_(def_directory_images_sponsor . "xl.jpg", "http://www.xl.co.id/", "", "50", "50", "", "", "", "0", false)); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="3" cellspacing="0" class="mymenu">
	<tr>
		<td align="center">
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>
						<?php
							echo(_set_hyperlink_(def_application_aboutus, "About Us", 'class="mylinkheader small"'));
						?>
					</td>
					<td width="10px">&nbsp;</td>
					<td>
						<?php
							echo(_set_hyperlink_(def_application_contactus, "Contact Us", 'class="mylinkheader small"'));
						?>
					</td>
					<td width="10px">&nbsp;</td>
					<td>
						<?php
							echo(_set_hyperlink_(def_application_signup, "Registrasi", 'class="mylinkheader small"'));
						?>
					</td>
					<td width="10px">&nbsp;</td>
					<td>
						<?php
							echo(_set_hyperlink_(def_application_help, "Help", 'class="mylinkheader small"'));
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="mycaption" align="center">
			<?php echo(_set_label_("", def_text_copyright));  ?>
		</td>
	</tr>
</table>