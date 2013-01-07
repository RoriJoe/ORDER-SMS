<?php
	require_once("includes/application_startup.php");
	
	require_once("../" . def_directory_classes_master . "class_setting.php");
	$var_class_setting = new _class_setting_();
	
	if(_is_session_registered_("session_userid")){
		if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "")){
			$var_handphoneno = _set_variable_http_("slt_handphoneno", false);
			$var_autorefresh = _set_variable_http_("txt_autorefresh", false);
			$var_autoreply = _set_variable_http_("chk_autoreply", false);
			
			if(_is_not_null_($var_handphoneno)){
                if(_is_not_null_($var_autorefresh)){
                    $var_class_setting->_set_data_("connectivity", $var_handphoneno);
                    $var_class_setting->_set_data_("auto refresh", $var_autorefresh);
                    $var_class_setting->_set_data_("auto reply", $var_autoreply);
                    $var_class_setting->_set_gammurc_($var_handphoneno);

                    $session_success = "Setting Sudah Disimpan";
                    _set_session_register_("session_success");
                }else{
                    $session_error = "Auto Refresh Harap Diisi";
                    _set_session_register_("session_error");
                }
			}else{
				$session_error = "Konektifitas Harap Dipilih";
				_set_session_register_("session_error");
			}
		}
	}else{
        _set_location_(_set_link_(def_application_login));
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
	<script language="javascript" src="<?php echo("../" . def_directory_styles . def_application_javascript); ?>"></script>
	<link rel="shortcut icon" href="<?php echo("../" . def_directory_styles . def_application_icon); ?>" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo("../" . def_directory_styles . def_application_style); ?>" type="text/css" />
</head>
<body>
<?php require_once(def_directory_includes . "application_header.php") ?>

<table border="0" width="100%" cellspacing="5" cellpadding="5" class="mycontent">
	<tr>
		<td valign="top" width="200px">
			<?php require_once(def_directory_includes . "application_left.php") ?>
		</td>
		<td valign="top" align="center">
			<?php require_once(def_directory_modules . "module_setting.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>