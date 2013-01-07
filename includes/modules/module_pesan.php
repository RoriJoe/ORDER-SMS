<?php if(_is_session_registered_("session_error")){ ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="myerror">
    <tr>
        <td align="center">
            <?php echo(_set_label_("", $session_error)); ?>
        </td>
    </tr>
    <tr>
        <td align="center">
            <?php
                if($var_login == true){
                    echo(_set_hyperlink_(def_application_login, "Login Sekarang"));
                }
            ?>
        </td>
    </tr>
</table>
<?php
        _set_session_unregister_("session_error");
    }elseif(_is_session_registered_("session_success")){
?>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<table border="0" cellpadding="5" cellspacing="0" class="myform">
				<tr>
					<td align="left" class="mycaption">
						<?php echo(_set_label_("", $session_success)); ?>
					</td>
				</tr>
				<tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="3" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <?php echo(_set_hyperlink_(def_application_keranjang, "Periksa Keranjang Belanja")); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <?php echo(_set_hyperlink_(def_application_menu, "Kembali ke Daftar Menu", "", "restoranid=" . _set_variable_http_("restoranid"))); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
        _set_session_unregister_("session_success");
    }
?>