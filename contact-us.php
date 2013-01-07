<?php
	require_once("includes/application_startup.php");

	if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "pesan")){
        $var_email = _set_variable_http_("txt_email", false);
        $var_nama = _set_variable_http_("txt_nama", false);
        $var_pesan = _set_variable_http_("txt_pesan", false);

        if(_is_not_null_($var_email)){
            if(_is_not_null_($var_nama)){
                if(_is_not_null_($var_pesan)){
                    require_once(def_directory_classes_master . "class_contactus.php");

                    $var_class_contactus = new _class_contactus_();
                    $var_class_contactus->_save_data_($var_email, $var_nama, $var_pesan);

                    $session_success = "Pesan anda sudah disimpan. Kami akan memproses pesan anda. Terima Kasih";
                    _set_session_register_("session_success");
                }else{
                    $session_error = "Pesan Harap Diisi";
                    _set_session_register_("session_error");
                }
            }else{
                $session_error = "Nama Harap Diisi";
                _set_session_register_("session_error");
            }
        }else{
            $session_error = "Email Harap Diisi";
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
			<?php require_once(def_directory_modules . "module_contact-us.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>