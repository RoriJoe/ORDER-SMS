<?php
	require_once("includes/application_startup.php");

	if(!_is_session_registered_("session_userid")){
		if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "login")){
			$var_userid = _set_variable_http_("txt_userid", false);
			$var_userpwd = _set_variable_http_("txt_userpwd", false);
			
			if(_is_not_null_($var_userid)){
				if(_is_not_null_($var_userpwd)){
					require_once(def_directory_classes . "class_user.php");
					$var_class_user = new _class_user_();
					
					if($var_class_user->_is_user_exist_($var_userid, $var_userpwd)){
						if($var_class_user->_is_admin_($var_userid)){
							$session_error = "Id Pemakai atau Password Salah";
                            _set_session_register_("session_error");
						}else{
							if($var_class_user->_is_active_($var_userid)){
								if($var_class_user->_is_status_($var_userid)){
									$var_class_user->_set_data_($var_userid);
									
									$var_class_user->_set_login_($var_class_user->var_userid);
									
									$session_userid = $var_class_user->var_userid;
									$session_username = $var_class_user->var_username;
									
									_set_session_register_("session_userid");
									_set_session_register_("session_username");

                                    _set_location_(_set_link_(def_application_account));
								}else{
									$session_error = "Id Pemakai Dalam Masalah";
									_set_session_register_("session_error");
								}
							}else{
								$session_error = "Id Pemakai Belum Diaktifkan";
								_set_session_register_("session_error");
							}
						}
					}else{
						$session_error = "Id Pemakai atau Password Salah";
						_set_session_register_("session_error");
					}
				}else{
					$session_error = "Password Kosong";
					_set_session_register_("session_error");
				}
			}else{
				$session_error = "Id Pemakai Kosong";
				_set_session_register_("session_error");
			}
		}
	}else{
		_set_location_(_set_link_(def_application_account));
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
			<?php require_once(def_directory_modules . "module_login.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>