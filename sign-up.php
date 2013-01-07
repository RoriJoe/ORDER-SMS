<?php
	require_once("includes/application_startup.php");
	
	if(_is_session_registered_("session_userid")){
		_set_location_(_set_link_(def_application_account));
	}else{
		if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "signup")){
			$var_userid = _set_variable_http_("txt_userid", false);
			$var_username = _set_variable_http_("txt_username", false);
			$var_userpwd = _set_variable_http_("txt_userpwd", false);
			$var_email = _set_variable_http_("txt_email", false);
			$var_address = _set_variable_http_("txt_address", false);
			$var_handphone = _set_variable_http_("txt_handphone", false);
            $var_phone = _set_variable_http_("txt_phone", false);
			
			if(_is_not_null_($var_userid)){
				if(_is_not_null_($var_userpwd)){
					if(_is_not_null_($var_username)){
						if(_is_not_null_($var_email)){
							if(_is_not_null_($var_address)){
                                if(strlen($var_userpwd) >= 5){
                                    require_once(def_directory_classes_master . "class_pemakai.php");

                                    $var_class_pemakai = new _class_pemakai_();

                                    if($var_class_pemakai->_is_primary_exist_($var_userid)){
                                        $session_error = "Id Pemakai Sudah Ada";
                                        _set_session_register_("session_error");
                                    }else{
                                        if(_is_not_null_($var_handphone)){
                                            if($var_class_pemakai->_is_exist2_($var_handphone)){
                                                $session_error = "No. Handphone Sudah Ada Yang Digunakan";
                                                _set_session_register_("session_error");
                                            }else{
                                                $var_class_pemakai->_save_data_($var_userid, $var_username, $var_userpwd, def_no, def_no, $var_email, $var_address, $var_handphone, $var_phone, def_no);

                                                $session_success = "Registrasi akan diproses oleh Administrator, Harap Ditunggu beberapa saat";
                                                _set_session_register_("session_success");

                                                _set_location_(_set_link_(def_application_confirm));
                                            }
                                        }else{
                                            $var_class_pemakai->_save_data_($var_userid, $var_username, $var_userpwd, def_no, def_no, $var_email, $var_address, $var_handphone, $var_phone, def_no);

                                            $session_success = "Registrasi akan diproses oleh Administrator, Harap Ditunggu beberapa saat";
                                            _set_session_register_("session_success");

                                            _set_location_(_set_link_(def_application_confirm));
                                        }
                                    }
                                }else{
                                    $session_error = "Password Harus Minimal 5 Karakter";
                                    _set_session_register_("session_error");
                                }
							}else{
								$session_error = "Alamat Harap Diisi";
								_set_session_register_("session_error");
							}
						}else{
							$session_error = "Email Harap Diisi";
							_set_session_register_("session_error");
						}
					}else{
						$session_error = "Nama Harap Diisi";
						_set_session_register_("session_error");
					}
				}else{
					$session_error = "Password Harap Diisi";
					_set_session_register_("session_error");
				}
			}else{
				$session_error = "Id Pemakai Harap Diisi";
				_set_session_register_("session_error");
			}
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
			<?php require_once(def_directory_modules . "module_sign-up.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>