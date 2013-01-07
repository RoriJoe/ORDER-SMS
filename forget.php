<?php
	require_once("includes/application_startup.php");

    require_once(def_directory_classes . "class_gammu.php");
    $var_class_gammu = new _class_gammu_("gammu\\gammu.exe");

    if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "forget")){
        $var_userid = _set_variable_http_("txt_userid", false);

        if(_is_not_null_($var_userid)){
            require_once(def_directory_classes . "class_user.php");
            $var_class_user = new _class_user_();

            if($var_class_user->_is_user_exist_($var_userid)){
                if(!$var_class_user->_is_admin_($var_userid)){
                    if($var_class_user->_is_active_($var_userid)){
                        if($var_class_user->_is_status_($var_userid)){
                            require_once(def_directory_classes_master . "class_pemakai.php");
                            $var_class_pemakai = new _class_pemakai_();

                            $var_class_pemakai->_set_data_($var_userid);

                            if(_is_not_null_($var_class_pemakai->var_handphone) && ($var_class_pemakai->var_handphoneyn == def_yes)){
                                $var_newpassword = _set_random_value_(6);

                                $var_class_gammu->_gammu_send_($var_respon, $var_class_pemakai->var_handphone, "Password Anda Yang Baru Adalah " . $var_newpassword);

                                $var_class_pemakai->_save_data3_($var_userid, $var_newpassword);

                                $session_success = "Password baru anda sudah dikirim. Silahkan Ganti Password anda via Website";
                                _set_session_register_("session_success");
                            }else{
                                $session_error = "Id Pemakai Tidak Mempunyai Nomor HP atau Belum Diaktifkan oleh Kami";
                                _set_session_register_("session_error");
                            }
                        }else{
                            $session_error = "Terdapat Masalah Pada Account Anda";
                            _set_session_register_("session_error");
                        }
                    }else{
                        $session_error = "Account Anda Belum Diaktifkan";
                        _set_session_register_("session_error");
                    }
                }else{
                    $session_error = "Id Pemakai Tidak Ada Dalam Database Kami";
                    _set_session_register_("session_error");
                }
            }else{
                $session_error = "Id Pemakai Tidak Ada Dalam Database Kami";
                _set_session_register_("session_error");
            }
        }else{
            $session_error = "Id Pemakai Harap Diisi Terlebih Dahulu";
            _set_session_register_("session_error");
        }
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
			<?php require_once(def_directory_modules . "module_forget.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>