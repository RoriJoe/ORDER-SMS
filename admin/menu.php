<?php
require_once("includes/application_startup.php");

if(_is_session_registered_("session_userid")){
    if(isset($HTTP_GET_VARS["process"])){
        if($HTTP_GET_VARS["process"] == "add"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_menuid = _set_variable_http_("txt_menuid", false);
                    $var_nama = _set_variable_http_("txt_nama", false);
                    $var_kodemenu = _set_variable_http_("txt_kodemenu", false);
                    $var_restoranid = _set_variable_http_("slt_restoranid", false);
                    $var_jenisid = _set_variable_http_("slt_jenisid", false);
                    $var_activeyn = _set_variable_http_("chk_activeyn", false);
                    $var_harga = _set_double_(_set_variable_http_("txt_harga", false), 0);
                    $var_keterangan = _set_variable_http_("txt_keterangan", false);

                    $var_gambar = $HTTP_POST_FILES['txt_gambar']['tmp_name'];
                    $var_namagambar = $HTTP_POST_FILES['txt_gambar']['name'];
                    $var_errorgambar = $HTTP_POST_FILES['txt_gambar']['error'];
                    
                    if(_is_not_null_($var_menuid)){
                        if(_is_not_null_($var_nama)){
                            if(_is_not_null_($var_kodemenu)){
                                require_once("../" . def_directory_classes_master . "class_menu.php");
                                $var_class_menu = new _class_menu_();

                                if(!$var_class_menu->_is_primary_exist_($var_menuid)){
                                    if(!$var_class_menu->_is_kodemenu_exist_($var_kodemenu)){
                                        $var_class_menu->_save_data_($var_menuid, $var_nama, $var_kodemenu, $var_restoranid, $var_jenisid, $var_activeyn, $var_keterangan);

                                        if(is_uploaded_file($var_gambar)){
                                            move_uploaded_file($var_gambar, "../" . def_directory_images_menu . $var_menuid . ".jpg");
                                        }

                                        require_once("../" . def_directory_classes_master . "class_daftarharga.php");
                                        $var_class_daftarharga = new _class_daftarharga_();

                                        $var_class_daftarharga->_save_data_($var_menuid, "NOW()", $var_harga);

                                        $session_success = $var_menuid . " & " . $var_nama . " (Sudah disimpan)";
                                        _set_session_register_("session_success");
                                    }else{
                                        $session_error = "Menu Inisial sudah ada";
                                        _set_session_register_("session_error");
                                    }
                                }else{
                                    $session_error = "Menu Id sudah ada";
                                    _set_session_register_("session_error");
                                }
                            }else{
                                $session_error = "Kode Inisital harap diisi terlebih dahulu";
                                _set_session_register_("session_error");
                            }
                        }else{
                            $session_error = "Nama harap diisi terlebih dahulu";
                            _set_session_register_("session_error");
                        }
                    }else{
                        $session_error = "Menu Id harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "search"){
            $var_menuid = _set_variable_http_("txt_menuid", false);
            $var_nama = _set_variable_http_("txt_nama", false);
            $var_restoranid = _set_variable_http_("slt_restoranid", false);
            $var_jenisid = _set_variable_http_("slt_jenisid", false);
            $var_activeyn = _set_variable_http_("chk_activeyn", false);

            require_once("../" . def_directory_classes_master . "class_menu.php");
            $var_class_menu = new _class_menu_($var_menuid, $var_nama, $var_restoranid, $var_jenisid, $var_activeyn);
        }else if($HTTP_GET_VARS["process"] == "update"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_menuid = _set_variable_http_("txt_menuid", false);
                    $var_nama = _set_variable_http_("txt_nama", false);
                    $var_kodemenu = _set_variable_http_("txt_kodemenu", false);
                    $var_restoranid = _set_variable_http_("slt_restoranid", false);
                    $var_jenisid = _set_variable_http_("slt_jenisid", false);
                    $var_activeyn = _set_variable_http_("chk_activeyn", false);
                    $var_keterangan = _set_variable_http_("txt_keterangan", false);

                    $var_gambar = $HTTP_POST_FILES['txt_gambar']['tmp_name'];
                    $var_namagambar = $HTTP_POST_FILES['txt_gambar']['name'];
                    $var_errorgambar = $HTTP_POST_FILES['txt_gambar']['error'];

                    if(_is_not_null_($var_nama)){
                        if(_is_not_null_($var_kodemenu)){
                            require_once("../" . def_directory_classes_master . "class_menu.php");
                            $var_class_menu = new _class_menu_();
                            
                            if(!$var_class_menu->_is_kodemenu_exist2_($var_kodemenu)){
                                if(is_uploaded_file($var_gambar)){
                                    move_uploaded_file($var_gambar, "../" . def_directory_images_menu . $var_menuid . ".jpg");
                                }

                                $var_class_menu->_save_data_($var_menuid, $var_nama, $var_kodemenu, $var_restoranid, $var_jenisid, $var_activeyn, $var_keterangan);
                                $var_class_menu->_set_data_($var_menuid);

                                $session_success = $var_menuid . " & " . $var_nama . " (Sudah disimpan)";
                                _set_session_register_("session_success");
                            }else{
                                $session_error = "Menu Inisial sudah ada";
                                _set_session_register_("session_error");
                            }
                        }else{
                            $session_error = "Kode Inisial harap diisi terlebih dahulu";
                            _set_session_register_("session_error");
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
                    $var_menuid = _set_variable_http_("processid");

                    require_once("../" . def_directory_classes_master . "class_menu.php");
                    $var_class_menu = new _class_menu_();

                    if($var_class_menu->_is_primary_exist_($var_menuid)){
                        $var_class_menu->_delete_data_($var_menuid);

                        if(is_file("../" . def_directory_images_menu . $var_menuid . ".jpg")){
                            unlink("../" . def_directory_images_menu . $var_menuid . ".jpg");
                        }

                        $session_success = "Berhasil Dihapus";
                        _set_session_register_("session_success");
                    }
                }
            }
        }else{
            require_once("../" . def_directory_classes_master . "class_menu.php");
            $var_class_menu = new _class_menu_();
        }
    }else{
        require_once("../" . def_directory_classes_master . "class_menu.php");
        $var_class_menu = new _class_menu_();
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
                    require_once("../" . def_directory_classes_master . "class_menu.php");
                    $var_class_menu = new _class_menu_();

                    require_once(def_directory_modules . "menu/" . "module_add.php");
                ?>
                </td>
                <?php
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "update")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_menuid = _set_variable_http_("processid");

                    if(_is_not_null_($var_menuid)){
                        require_once("../" . def_directory_classes_master . "class_menu.php");
                        $var_class_menu = new _class_menu_();
                        if(!$var_class_menu->_is_primary_exist_($var_menuid)){
                            ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "menu/" . "module_error.php");
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_menu->_set_data_($var_menuid);

                    require_once(def_directory_modules . "menu/" . "module_update.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "menu/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"]) && $HTTP_GET_VARS["action"] == "true"){
                        require_once(def_directory_modules . "menu/" . "module_update.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "menu/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "delete")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_menuid = _set_variable_http_("processid");

                    if(_is_not_null_($var_menuid)){
                        require_once("../" . def_directory_classes_master . "class_menu.php");
                        $var_class_menu = new _class_menu_();

                        if(!$var_class_menu->_is_primary_exist_($var_menuid)){
                            ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        require_once(def_directory_modules . "menu/" . "module_delete.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "menu/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_menu->_set_data_($var_menuid);

                    require_once(def_directory_modules . "menu/" . "module_delete.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "menu/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "menu/" . "module_delete.php");
                    }else{
                        require_once(def_directory_modules . "menu/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top" align="center"><?php
                    require_once(def_directory_modules . "menu/" . "module_view.php");
                    ?></td>
                    <?php } ?>
            </tr>
        </table>

        <?php require_once(def_directory_includes . "application_bottom.php") ?>
    </body>
</html>