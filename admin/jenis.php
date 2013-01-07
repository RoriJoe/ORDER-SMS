<?php
require_once("includes/application_startup.php");

if(_is_session_registered_("session_userid")){
    if(isset($HTTP_GET_VARS["process"])){
        if($HTTP_GET_VARS["process"] == "add"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_jenisid = _set_variable_http_("txt_jenisid", false);
                    $var_nama = _set_variable_http_("txt_nama", false);

                    if(_is_not_null_($var_jenisid)){
                        if(_is_not_null_($var_nama)){
                            require_once("../" . def_directory_classes_master . "class_jenis.php");
                            $var_class_jenis = new _class_jenis_();

                            if(!$var_class_jenis->_is_primary_exist_($var_jenisid)){
                                $var_class_jenis->_save_data_($var_jenisid, $var_nama);

                                $session_success = $var_jenisid . " & " . $var_nama . " (Sudah disimpan)";
                                _set_session_register_("session_success");
                            }else{
                                $session_error = "Jenis Id sudah ada";
                                _set_session_register_("session_error");
                            }
                        }else{
                            $session_error = "Nama harap diisi terlebih dahulu";
                            _set_session_register_("session_error");
                        }
                    }else{
                        $session_error = "Id Jenis harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "search"){
            $var_jenisid = _set_variable_http_("txt_jenisid", false);
            $var_nama = _set_variable_http_("txt_nama", false);

            require_once("../" . def_directory_classes_master . "class_jenis.php");
            $var_class_jenis = new _class_jenis_($var_jenisid, $var_nama);
        }else if($HTTP_GET_VARS["process"] == "update"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_jenisid = _set_variable_http_("txt_jenisid", false);
                    $var_nama = _set_variable_http_("txt_nama", false);

                    if(_is_not_null_($var_nama)){
                        require_once("../" . def_directory_classes_master . "class_jenis.php");
                        $var_class_jenis = new _class_jenis_();
                        $var_class_jenis->_save_data_($var_jenisid, $var_nama);
                        $var_class_jenis->_set_data_($var_jenisid);

                        $session_success = $var_jenisid . " & " . $var_nama . " (Sudah disimpan)";
                        _set_session_register_("session_success");
                    }else{
                        $session_error = "Nama harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "delete"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_jenisid = _set_variable_http_("processid");

                    require_once("../" . def_directory_classes_master . "class_jenis.php");
                    $var_class_jenis = new _class_jenis_();

                    if($var_class_jenis->_is_primary_exist_($var_jenisid)){
                        $var_class_jenis->_delete_data_($var_jenisid);

                        $session_success = "Berhasil Dihapus";
                        _set_session_register_("session_success");
                    }
                }
            }
        }else{
            require_once("../" . def_directory_classes_master . "class_jenis.php");
            $var_class_jenis = new _class_jenis_();
        }
    }else{
        require_once("../" . def_directory_classes_master . "class_jenis.php");
        $var_class_jenis = new _class_jenis_();
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
                    require_once(def_directory_modules . "jenis/" . "module_add.php");
                ?>
                </td>
                <?php
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "update")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_jenisid = _set_variable_http_("processid");

                    if(_is_not_null_($var_jenisid)){
                        require_once("../" . def_directory_classes_master . "class_jenis.php");
                        $var_class_jenis = new _class_jenis_();
                        if(!$var_class_jenis->_is_primary_exist_($var_jenisid)){
                            ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "jenis/" . "module_error.php");
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_jenis->_set_data_($var_jenisid);

                    require_once(def_directory_modules . "jenis/" . "module_update.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "jenis/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"]) && $HTTP_GET_VARS["action"] == "true"){
                        require_once(def_directory_modules . "jenis/" . "module_update.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "jenis/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "delete")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_jenisid = _set_variable_http_("processid");

                    if(_is_not_null_($var_jenisid)){
                        require_once("../" . def_directory_classes_master . "class_jenis.php");
                        $var_class_jenis = new _class_jenis_();

                        if(!$var_class_jenis->_is_primary_exist_($var_jenisid)){
                            ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        require_once(def_directory_modules . "jenis/" . "module_delete.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "jenis/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_jenis->_set_data_($var_jenisid);

                    require_once(def_directory_modules . "jenis/" . "module_delete.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "jenis/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "jenis/" . "module_delete.php");
                    }else{
                        require_once(def_directory_modules . "jenis/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top" align="center"><?php
                    require_once(def_directory_modules . "jenis/" . "module_view.php");
                    ?></td>
                    <?php } ?>
            </tr>
        </table>

        <?php require_once(def_directory_includes . "application_bottom.php") ?>
    </body>
</html>