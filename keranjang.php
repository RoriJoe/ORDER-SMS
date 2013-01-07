<?php
	require_once("includes/application_startup.php");

    $var_login = false;

    if(_is_session_registered_("session_userid")){
        require_once(def_directory_classes . "class_keranjang.php");
        $var_class_keranjang = new _class_keranjang_();

        require_once(def_directory_classes_transaksi . "class_voucher.php");
        $var_class_voucher = new _class_voucher_();

        require_once(def_directory_classes_master . "class_pemakai.php");
        $var_class_pemakai = new _class_pemakai_();
        $var_class_pemakai->_set_data_($session_userid);

        if(isset($HTTP_GET_VARS["process"])){
            if($HTTP_GET_VARS["process"] == "confirm"){
                if(isset($HTTP_GET_VARS["action"])){
                    if($HTTP_GET_VARS["action"] == "true"){
                        if(isset($HTTP_POST_VARS["txt_confirm"])){
                            $session_error = "Voucher Anda Tidak Mencukupi Untuk Melakukan Transaksi ini";
                            _set_session_register_("session_error");
                        }else{
                            $var_menuid = _set_variable_http_('txt_menuid', false);
                            $var_alamat = _set_variable_http_('slt_alamat', false);

                            $var_valid = true;

                            for($var_counter=0; $var_counter < count($var_menuid); $var_counter++){
                                $var_qty_temp = _set_numeric_(_set_variable_http_('txt_qty' . $var_menuid[$var_counter], false));
                                
                                $var_class_keranjang->_update_qty2_($var_menuid[$var_counter], $var_qty_temp);

                                if($var_qty_temp <= 0){
                                    $var_valid = false;
                                }
                            }

                            if($var_valid == false){
                                $session_error = "Harap memasukkan valid Qty";
                                _set_session_register_("session_error");
                            }else{
                                $var_class_keranjang->_calculate_("");
                                
                                $var_voucher = $var_class_voucher->_get_voucher_($session_userid);
                                
                                if($var_class_keranjang->var_total > $var_voucher){
                                    $session_error = "Voucher anda tidak mencukupi, Silahkan tambah voucher anda. Voucher = Rp. " . $var_voucher;
                                    _set_session_register_("session_error");
                                }else{
                                    require_once(def_directory_classes_transaksi . "class_pesan.php");
                                    $var_class_pesan = new _class_pesan_();

                                    $var_notransaksi = $var_class_pesan->_save_data_header_($session_userid, $var_alamat);

                                    for($var_counter=0; $var_counter < count($var_menuid); $var_counter++){
                                        $var_class_pesan->_save_data_detil_($var_notransaksi, $var_menuid[$var_counter], _set_numeric_(_set_variable_http_('txt_qty' . $var_menuid[$var_counter], false)));
                                    }

                                    $var_class_voucher->_decrement_voucher_($session_userid, $var_class_keranjang->var_total);

                                    $var_class_keranjang->_cleanup_();

                                    $session_success = "Transaksi anda berhasil, Menu Anda siap diantar segera. No Transaksi Anda : " . $var_notransaksi;
                                    _set_session_register_("session_success");
                                }
                            }
                        }
                    }else{
                        $session_error = "Mohon Mengikuti Prosedur";
                        _set_session_register_("session_error");
                    }
                }else{
                    $session_error = "Mohon Mengikuti Prosedur";
                    _set_session_register_("session_error");
                }
            }elseif($HTTP_GET_VARS["process"] == "delete"){
                if(isset($HTTP_GET_VARS["action"])){
                    if($HTTP_GET_VARS["action"] == "true"){
                        $var_menuid = _set_variable_http_("processid");

                        $var_class_keranjang->_remove_($var_menuid);
                    }else{
                        $session_error = "Mohon Mengikuti Prosedur";
                        _set_session_register_("session_error");
                    }
                }else{
                    $session_error = "Mohon Mengikuti Prosedur";
                    _set_session_register_("session_error");
                }
            }else{
                $session_error = "Mohon Mengikuti Prosedur";
                _set_session_register_("session_error");
            }
        }
    }else{
        $session_error = "Anda mesti login terlebih dahulu";
        _set_session_register_("session_error");

        $var_login = true;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="<?php echo(def_text_keywords); ?>" />
	<meta name="description" content="<?php echo(def_text_description); ?>" />
	<title><?php echo(def_text_application); ?></title>
	<script language="javascript" src="<?php echo(def_directory_styles . def_application_javascript); ?>"></script>
	<link rel="shortcut icon" href="<?php echo(def_directory_styles . def_application_icon); ?>" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo(def_directory_styles . def_application_style); ?>" type="text/css" />
</head>
<body>
<?php require_once(def_directory_includes . "application_header.php") ?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" class="mycontent">
	<tr>
		<td valign="middle" align="center">
			<?php require_once(def_directory_modules . "module_keranjang.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>