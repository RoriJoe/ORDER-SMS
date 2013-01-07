<?php
require_once("includes/application_startup.php");

if(_is_session_registered_("session_userid")){
    if(isset($HTTP_GET_VARS["process"])){
        if($HTTP_GET_VARS["process"] == "add"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_userid = _set_variable_http_("txt_userid", false);
                    $var_username = _set_variable_http_("txt_username", false);
                    $var_userpwd = _set_variable_http_("txt_userpwd", false);
                    $var_statusyn = _set_variable_http_("chk_statusyn", false);
                    $var_activeyn = _set_variable_http_("chk_activeyn", false);
                    $var_email = _set_variable_http_("txt_email", false);
                    $var_address = _set_variable_http_("txt_address", false);
                    $var_handphone = _set_variable_http_("txt_handphone", false);
                    $var_phone = _set_variable_http_("txt_phone", false);
                    $var_handphoneyn = _set_variable_http_("chk_handphoneyn", false);

                    if(_is_not_null_($var_userid)){
                        if(_is_not_null_($var_username)){
                            require_once("../" . def_directory_classes_master . "class_pemakai.php");
                            $var_class_pemakai = new _class_pemakai_();

                            if(!$var_class_pemakai->_is_primary_exist_($var_userid)){
                                $var_class_pemakai->_save_data_($var_userid, $var_username, $var_userpwd, $var_statusyn, $var_activeyn, $var_email, $var_address, $var_handphone, $var_phone, $var_handphoneyn);

                                $session_success = $var_userid . " & " . $var_username . " (Sudah disimpan)";
                                _set_session_register_("session_success");
                            }else{
                                $session_error = "Pemakai Id sudah ada";
                                _set_session_register_("session_error");
                            }
                        }else{
                            $session_error = "Nama harap diisi terlebih dahulu";
                            _set_session_register_("session_error");
                        }
                    }else{
                        $session_error = "Pemakai Id harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "search"){
            $var_userid = _set_variable_http_("txt_userid", false);
            $var_username = _set_variable_http_("txt_username", false);
            $var_statusyn = _set_variable_http_("chk_statusyn", false);
            $var_activeyn = _set_variable_http_("chk_activeyn", false);
            $var_handphoneyn = _set_variable_http_("chk_handphoneyn", false);

            require_once("../" . def_directory_classes_master . "class_pemakai.php");
            $var_class_pemakai = new _class_pemakai_($var_userid, $var_username, $var_statusyn, $var_activeyn, $var_handphoneyn);
        }else if($HTTP_GET_VARS["process"] == "update"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_userid = _set_variable_http_("txt_userid", false);
                    $var_username = _set_variable_http_("txt_username", false);
                    $var_userpwd = _set_variable_http_("txt_userpwd", false);
                    $var_statusyn = _set_variable_http_("chk_statusyn", false);
                    $var_activeyn = _set_variable_http_("chk_activeyn", false);
                    $var_email = _set_variable_http_("txt_email", false);
                    $var_address = _set_variable_http_("txt_address", false);
                    $var_handphone = _set_variable_http_("txt_handphone", false);
                    $var_phone = _set_variable_http_("txt_phone", false);
                    $var_handphoneyn = _set_variable_http_("chk_handphoneyn", false);

                    if(_is_not_null_($var_username)){
                        require_once("../" . def_directory_classes_master . "class_pemakai.php");
                        $var_class_pemakai = new _class_pemakai_();
                        $var_class_pemakai->_save_data_($var_userid, $var_username, $var_userpwd, $var_statusyn, $var_activeyn, $var_email, $var_address, $var_handphone, $var_phone, $var_handphoneyn);
                        $var_class_pemakai->_set_data_($var_userid);

                        $session_success = $var_userid . " & " . $var_username . " (Sudah disimpan)";
                        _set_session_register_("session_success");

                        if(_is_not_null_($var_handphone) && ($var_handphoneyn == def_yes) && ($var_statusyn == def_yes) && ($var_activeyn == def_yes)){
                            require_once("../" . def_directory_classes_master . "class_setting.php");
                            $var_class_setting = new _class_setting_();

                            if($var_class_setting->_is_autoreply_()){
                                require_once("../" . def_directory_classes . "class_gammu.php");
                                $var_class_gammu = new _class_gammu_("..\\gammu\\gammu.exe");
                                $var_class_gammu->_gammu_send_($var_respon, $var_handphone, "SELAMAT DATANG KE ORDERSMS. Id Pemakai: " . $var_userid . " Password: Tidak Dapat Kami Lihat (Kemungkinan No. HP atau Id Anda");
                            }
                            
                        }
                    }else{
                        $session_error = "Nama harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "delete"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_userid = _set_variable_http_("processid");

                    require_once("../" . def_directory_classes_master . "class_pemakai.php");
                    $var_class_pemakai = new _class_pemakai_();

                    if($var_class_pemakai->_is_primary_exist_($var_userid)){
                        $var_class_pemakai->_delete_data_($var_userid);

                        $session_success = "Berhasil Dihapus";
                        _set_session_register_("session_success");
                    }
                }
            }
        }else{
            require_once("../" . def_directory_classes_master . "class_pemakai.php");
            $var_class_pemakai = new _class_pemakai_();
        }
    }else{
        require_once("../" . def_directory_classes_master . "class_pemakai.php");
        $var_class_pemakai = new _class_pemakai_();
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
                <?php if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "add")){ ?>
                <td valign="top">
                <?php
                    require_once(def_directory_modules . "pemakai/" . "module_add.php");
                ?>
                </td>
                <?php
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "update")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_userid = _set_variable_http_("processid");

                    if(_is_not_null_($var_userid)){
                        require_once("../" . def_directory_classes_master . "class_pemakai.php");
                        $var_class_pemakai = new _class_pemakai_();
                        if(!$var_class_pemakai->_is_primary_exist_($var_userid)){
                            ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "pemakai/" . "module_error.php");
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_pemakai->_set_data_($var_userid);

                    require_once(def_directory_modules . "pemakai/" . "module_update.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "pemakai/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"]) && $HTTP_GET_VARS["action"] == "true"){
                        require_once(def_directory_modules . "pemakai/" . "module_update.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "pemakai/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "delete")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_userid = _set_variable_http_("processid");

                    if(_is_not_null_($var_userid)){
                        require_once("../" . def_directory_classes_master . "class_pemakai.php");
                        $var_class_pemakai = new _class_pemakai_();

                        if(!$var_class_pemakai->_is_primary_exist_($var_userid)){
                            ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        require_once(def_directory_modules . "pemakai/" . "module_delete.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "pemakai/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_pemakai->_set_data_($var_userid);

                    require_once(def_directory_modules . "pemakai/" . "module_delete.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "pemakai/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "pemakai/" . "module_delete.php");
                    }else{
                        require_once(def_directory_modules . "pemakai/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top" align="center"><?php
                    require_once(def_directory_modules . "pemakai/" . "module_view.php");
                    ?></td>
                    <?php } ?>
            </tr>
        </table>

        <?php require_once(def_directory_includes . "application_bottom.php") ?>
    </body>
</html>