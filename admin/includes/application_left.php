<link rel="stylesheet" href="<?php echo("../" . def_directory_styles . def_application_style_menuver); ?>" type="text/css" />

<table border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td>
			<form action="#" style="font-family: sans-serif; font-size: .8em" onsubmit="return false">
				<div id="mymenu" style="float: left" class="mymenuver">
					<div class="collapsed">
						<span><?php echo(_set_label_("", "Handphone")); ?></span>
						<?php echo(_set_hyperlink_(def_application_inbox, "Kotak Masuk", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_outbox, "Kotak Keluar", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_write, "Tulis Pesan", "", "", false)); ?>
					</div>
					<div class="collapsed">
						<span><?php echo(_set_label_("", "Setting")); ?></span>
						<?php echo(_set_hyperlink_(def_application_setting, "Handphone", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_handphone, "Konektifitas", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_info, "Info", "", "", false)); ?>
						<?php echo(_set_hyperlink_("../" . def_application_logout, "Logout", "", "", false)); ?>
					</div>
					<div class="collapsed">
						<span><?php echo(_set_label_("", "Master")); ?></span>
						<?php echo(_set_hyperlink_(def_application_restoran, "Restoran", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_jenis, "Jenis", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_menu, "Menu", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_pemakai, "Pemakai", "", "", false)); ?>
                        <?php echo(_set_hyperlink_(def_application_daftarharga, "Daftar Harga", "", "", false)); ?>
					</div>
                    <div class="collapsed">
						<span><?php echo(_set_label_("", "Transaksi")); ?></span>
                        <?php echo(_set_hyperlink_(def_application_voucher, "Isi Voucher", "", "", false)); ?>
						<?php echo(_set_hyperlink_(def_application_order, "Order", "", "", false)); ?>
					</div>
				</div>
			</form>
		</td>
	</tr>
</table>

<script language="javascript" src="<?php echo("../" . def_directory_styles . def_application_javascript_menuver); ?>"></script>
<script type="text/javascript">
	var var_mymenu;
	
	var_mymenu = new _menuver_("mymenu");
		
	var_mymenu._init_();
</script>