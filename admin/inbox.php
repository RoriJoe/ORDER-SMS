<?php
	require_once("includes/application_startup.php");

    if(!_is_session_registered_("session_userid")){
        _set_location_(_set_link_(def_application_login));
    }

    require_once("../" . def_directory_classes_master . "class_setting.php");
    $var_class_setting = new _class_setting_();

    require_once("../" . def_directory_classes . "class_gammu.php");
    $var_class_gammu = new _class_gammu_("..\\gammu\\gammu.exe");
	
	if(isset($HTTP_GET_VARS["process"])){
		if($HTTP_GET_VARS["process"] == "search"){
			$var_nohp = _set_variable_http_("txt_nohp", false);
			
			require_once("../" . def_directory_classes_master . "class_inbox.php");
			$var_class_inbox = new _class_inbox_("", $var_nohp);
		}elseif($HTTP_GET_VARS["process"] == "delete"){
			if(isset($HTTP_GET_VARS["processid"])){
				if(isset($HTTP_GET_VARS["action"])){
					$var_action = _set_variable_http_("action");
					$var_pesanno = _set_variable_http_("processid");
					
					if(_is_not_null_($var_pesanno)){
						if(_is_not_null_($var_action)){
							if($var_action == "true"){
								require_once("../" . def_directory_classes_master . "class_inbox.php");
								$var_class_inbox = new _class_inbox_();
								$var_class_inbox->_delete_data_($var_pesanno);
								
								$var_class_inbox = new _class_inbox_();
								
								$session_success = "Data Sudah Dihapus";
								_set_session_register_("session_success");
							}else{
								$session_error = "Harap Mengikuti Prosedur";
								_set_session_register_("session_error");
							}
						}else{
							$session_error = "Harap Mengikuti Prosedur";
							_set_session_register_("session_error");
						}
					}else{
						$session_error = "Harap Mengikuti Prosedur";
						_set_session_register_("session_error");
					}
				}else{
					$var_pesanno = _set_variable_http_("processid");
					
					if(_is_not_null_($var_pesanno)){
						require_once("../" . def_directory_classes_master . "class_inbox.php");
						$var_class_inbox = new _class_inbox_();
						
						if($var_class_inbox->_is_primary_exist_($var_pesanno)){
							$session_process = "Hapus : " . _set_field_value(def_table_inbox, "tanggal", "pesanno='" . $var_pesanno . "'") . " - " . _set_field_value(def_table_inbox, "nohp", "pesanno='" . $var_pesanno . "'");
							_set_session_register_("session_process");
						}else{
							$session_error = "Harap Mengikuti Prosedur";
							_set_session_register_("session_error");
						}
					}else{
						$session_error = "Harap Mengikuti Prosedur";
						_set_session_register_("session_error");
					}
				}
			}else{
				$session_error = "Harap Mengikuti Prosedur";
				_set_session_register_("session_error");
			}
		}elseif($HTTP_GET_VARS["process"] == "handphone"){
            $var_class_gammu->_gammu_inbox_(&$var_respon);

            if(_is_not_null_($var_respon)){
                $session_error = $var_respon;
				_set_session_register_("session_error");
            }
        }elseif($HTTP_GET_VARS["process"] == "deleteall"){
            if(isset($HTTP_GET_VARS["action"])){
                require_once("../" . def_directory_classes_master . "class_inbox.php");
                $var_class_inbox = new _class_inbox_();
                $var_class_inbox->_delete_all_();

                $session_success = "Semua Data Sudah Dihapus";
                _set_session_register_("session_success");

                _set_location_(_set_link_(def_application_inbox));
            }
        }
	}
	
	if(isset($var_class_inbox) && is_object($var_class_inbox)){
	}else{
		require_once("../" . def_directory_classes_master . "class_inbox.php");
		$var_class_inbox = new _class_inbox_();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="<?php echo(def_text_keywords); ?>" />
	<meta name="description" content="<?php echo(def_text_description); ?>" />

    <?php
        $var_class_setting->_get_autorefresh_();
        if(_is_not_null_($var_class_setting->var_autorefresh)){
    ?>
    <meta http-equiv="refresh" content="<?php echo($var_class_setting->var_autorefresh); ?>;url=<?php echo(_set_link_(def_application_inbox, "process=handphone")); ?>" />
    <?php } ?>
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
			<?php require_once(def_directory_modules . "module_inbox.php") ?>
		</td>
	</tr>
</table>

<?php require_once(def_directory_includes . "application_bottom.php") ?>
</body>
</html>