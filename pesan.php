<?php
	require_once("includes/application_startup.php");

    $var_login = false;

    if(_is_session_registered_("session_userid")){
        if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "pesan")){
            $var_menuid = _set_variable_http_("menuid");
            $var_restoranid = _set_variable_http_("restoranid");

            require_once(def_directory_classes_master . "class_menu.php");
            $var_class_menu = new _class_menu_();

            if($var_class_menu->_is_primary_exist_($var_menuid)){
                require_once(def_directory_classes . "class_keranjang.php");
                $var_class_keranjang = new _class_keranjang_();
                $var_class_keranjang->_add_cart_($var_menuid);

                $session_success = "Pesanan anda berhasil disimpan";
                _set_session_register_("session_success");
            }else{
                $session_error = "Harap mengikuti prosedur";
                _set_session_register_("session_error");
            }
        }else{
            $session_error = "Harap mengikuti prosedur";
            _set_session_register_("session_error");
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
			<?php require_once(def_directory_modules . "module_pesan.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>