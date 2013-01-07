<?php
    if(isset($HTTP_GET_VARS["process"])){
        if($HTTP_GET_VARS["process"] == "changeaccount"){
?>

<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center">
			<table border="1" cellpadding="5" cellspacing="0" class="myform">
				<tr>
					<td colspan="2" align="left" class="mycaption">
						<?php echo(_set_label_("", "UBAH ACCOUNT")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_account, "process=changeaccount&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="5">
								<?php if(_is_session_registered_("session_error")){ ?>
								<tr>
									<td colspan="2" align="left" class="myerror">
										<?php echo(_set_image_link_(def_directory_images_buttons . "error.png", "", "", "48px", "48px")); ?>
										<?php echo(_set_label_("", $session_error)); ?>
									</td>
								</tr>
								<?php
										_set_session_unregister_("session_error");
									}
								?>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Pemakai")); ?>
									</td>
									<td align="left">
                                        <?php echo(_set_input_("txt_userid", $var_class_pemakai->var_userid, "hidden")); ?>
                                        <?php echo(_set_label_("", $var_class_pemakai->var_userid)); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Nama")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_username", $var_class_pemakai->var_username, "text", 'tabindex="1" maxlength="60" style="width: 300px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Email")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_email", $var_class_pemakai->var_email, "text", 'tabindex="2" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Alamat")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_address", $var_class_pemakai->var_address, "text", 'tabindex="3" maxlength="200" style="width: 400px;"')); ?>
									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Handphone")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_handphone", $var_class_pemakai->var_handphone, "text", 'tabindex="4" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Telepon")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_phone", $var_class_pemakai->var_phone, "text", 'tabindex="5" maxlength="30" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right">
										<?php echo(_set_submit_("", "Konfirmasi")); ?>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
    <tr>
        <td align="center">
            <?php echo(_set_hyperlink_(def_application_account, "Kembali")); ?>
        </td>
    </tr>
</table>

<?php
        }elseif($HTTP_GET_VARS["process"] == "changepassword"){
?>

<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center">
			<table border="1" cellpadding="5" cellspacing="0" class="myform">
				<tr>
					<td colspan="2" align="left" class="mycaption">
						<?php echo(_set_label_("", "UBAH PASSWORD")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<form action="<?php echo(_set_link_(def_application_account, "process=changepassword&action=true")); ?>" method="post">
							<table border="0" cellpadding="3" cellspacing="5">
								<?php if(_is_session_registered_("session_error")){ ?>
								<tr>
									<td colspan="2" align="left" class="myerror">
										<?php echo(_set_image_link_(def_directory_images_buttons . "error.png", "", "", "48px", "48px")); ?>
										<?php echo(_set_label_("", $session_error)); ?>
									</td>
								</tr>
								<?php
										_set_session_unregister_("session_error");
									}
								?>
								<tr>
									<td align="left">
										<?php echo(_set_label_("", "Id Pemakai")); ?>
									</td>
									<td align="left">
                                        <?php echo(_set_input_("txt_userid", $var_class_pemakai->var_userid, "hidden")); ?>
                                        <?php echo(_set_label_("", $var_class_pemakai->var_userid)); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Password Lama")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_userpwdold", "", "password", 'tabindex="1" maxlength="20" style="width: 200px;"')); ?>
									</td>
								</tr>
                                <tr>
									<td align="left">
										<?php echo(_set_label_("", "Password Baru")); ?>
									</td>
									<td align="left">
										<?php echo(_set_input_("txt_userpwd", "", "password", 'tabindex="2" maxlength="20" style="width: 200px;"')); ?>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right">
										<?php echo(_set_submit_("", "Konfirmasi")); ?>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
    <tr>
        <td align="center">
            <?php echo(_set_hyperlink_(def_application_account, "Kembali")); ?>
        </td>
    </tr>
</table>

<?php
        }else{
?>

<table border="0" width="100%" cellpadding="10" cellspacing="0" align="center">
	<tr>
		<td align="center" class="myerror">
            <?php
                echo(_set_label_("", "Harap Mengikuti Prosedur", 'class="mylabel large"'));
            ?>
		</td>
	</tr>
</table>

<?php   }
?>

<?php
    }else{
?>

<table border="0" width="100%" cellpadding="10" cellspacing="0" align="center">
	<tr>
		<td align="center" class="mytitle">
            <?php
                echo(_set_label_("", "My Account", 'class="mylabel large"'));
            ?>
		</td>
	</tr>
    <tr>
        <td align="center">
            <table border="0" cellpadding="5" cellspacing="5" class="myform">
                <tr>
                    <td colspan="3" align="center" class="mytitle"><?php echo(_set_label_("", $var_class_pemakai->var_userid)); ?></td>
                </tr>
                <tr>
                    <td><?php echo(_set_label_("", "Nama")); ?></td>
                    <td><?php echo(_set_label_("", " : ")); ?></td>
                    <td><?php echo(_set_label_("", $var_class_pemakai->var_username)); ?></td>
                </tr>
                <tr>
                    <td><?php echo(_set_label_("", "Email")); ?></td>
                    <td><?php echo(_set_label_("", " : ")); ?></td>
                    <td><?php echo(_set_label_("", $var_class_pemakai->var_email)); ?></td>
                </tr>
                <tr>
                    <td><?php echo(_set_label_("", "No Telp")); ?></td>
                    <td><?php echo(_set_label_("", " : ")); ?></td>
                    <td><?php echo(_set_label_("", $var_class_pemakai->var_phone)); ?></td>
                </tr>
                <tr>
                    <td><?php echo(_set_label_("", "Handphone")); ?></td>
                    <td><?php echo(_set_label_("", " : ")); ?></td>
                    <td><?php echo(_set_label_("", $var_class_pemakai->var_handphone)); ?></td>
                </tr>
                <tr>
                    <td><?php echo(_set_label_("", "Sisa Voucher")); ?></td>
                    <td><?php echo(_set_label_("", " : ")); ?></td>
                    <td>
                    <?php
                        require_once(def_directory_classes_transaksi . "class_voucher.php");
                        $var_class_voucher = new _class_voucher_();

                        $var_voucher = $var_class_voucher->_get_voucher_($var_class_pemakai->var_userid);

                        echo(_set_label_("", "Rp. " . $var_voucher));
                    ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table border="0" cellpadding="3" cellspacing="0">
                <tr>
                    <td align="center">
                        <?php echo(_set_hyperlink_(def_application_account, "Ubah Account", "", "process=changeaccount")); ?>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php echo(_set_hyperlink_(def_application_account, "Ubah Password", "", "process=changepassword")); ?>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php echo(_set_hyperlink_(def_application_keranjang, "Periksa Keranjang Belanja")); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php } ?>