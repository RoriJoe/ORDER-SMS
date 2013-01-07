<?php
require_once("includes/application_startup.php");

if(_is_session_registered_("session_userid")){
    if(isset($HTTP_GET_VARS["process"])){
        if($HTTP_GET_VARS["process"] == "add"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_menuid = _set_variable_http_("slt_menuid", false);
                    $var_harga = _set_double_(_set_variable_http_("txt_harga", false), 0);

                    if(_is_not_null_($var_menuid)){
                        if(_is_not_null_($var_harga) && $var_harga > 0){
                            require_once("../" . def_directory_classes_master . "class_daftarharga.php");
                            $var_class_daftarharga = new _class_daftarharga_();

                            if(!$var_class_daftarharga->_is_primary_exist_($var_menuid, "NOW()")){
                                $var_class_daftarharga->_save_data_($var_menuid, "NOW()", $var_harga);

                                $session_success = $var_menuid . " & " . $var_harga . " (Sudah disimpan)";
                                _set_session_register_("session_success");
                            }else{
                                $session_error = "Daftar Harga Sekarang sudah ada";
                                _set_session_register_("session_error");
                            }
                        }else{
                            $session_error = "Harga harap diisi terlebih dahulu";
                            _set_session_register_("session_error");
                        }
                    }else{
                        $session_error = "Menu harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "search"){
            $var_menuid = _set_variable_http_("slt_menuid", false);
            $var_daritanggal = _set_variable_http_("slt_daritanggal", false);
            $var_daribulan = _set_variable_http_("slt_daribulan", false);
            $var_daritahun = _set_variable_http_("slt_daritahun", false);
            $var_sampaitanggal = _set_variable_http_("slt_sampaitanggal", false);
            $var_sampaibulan = _set_variable_http_("slt_sampaibulan", false);
            $var_sampaitahun = _set_variable_http_("slt_sampaitahun", false);

            if(!checkdate($var_daribulan, $var_daritanggal, $var_daritahun)){
                $var_daritanggal = '';
            }else{
                $var_daritanggal = $var_daritahun . '-' . $var_daribulan . '-' . $var_daritanggal;
            }

            if(!checkdate($var_sampaibulan, $var_sampaitanggal, $var_sampaitahun)){
                $var_sampaitanggal = '';
            }else{
                $var_sampaitanggal = $var_sampaitahun . '-' . $var_sampaibulan . '-' . $var_sampaitanggal;
            }

            require_once("../" . def_directory_classes_master . "class_daftarharga.php");
            $var_class_daftarharga = new _class_daftarharga_($var_menuid, $var_daritanggal, $var_sampaitanggal);
        }else if($HTTP_GET_VARS["process"] == "update"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_kode = _set_variable_http_("txt_kode", false);
                    $var_harga = _set_double_(_set_variable_http_("txt_harga", false), 0);

                    if(_is_not_null_($var_harga)){
                        require_once("../" . def_directory_classes_master . "class_daftarharga.php");
                        $var_class_daftarharga = new _class_daftarharga_();
                        $var_class_daftarharga->_save_data2_($var_kode, $var_harga);
                        $var_class_daftarharga->_set_data_($var_kode);

                        $session_success = $var_class_daftarharga->var_menuid . " & " . $var_harga . " (Sudah disimpan)";
                        _set_session_register_("session_success");
                    }else{
                        $session_error = "Harga harap diisi terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "delete"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_kode = _set_variable_http_("processid");

                    require_once("../" . def_directory_classes_master . "class_daftarharga.php");
                    $var_class_daftarharga = new _class_daftarharga_();

                    if($var_class_daftarharga->_is_primary_exist2_($var_kode)){
                        $var_class_daftarharga->_delete_data_($var_kode);

                        $session_success = "Berhasil Dihapus";
                        _set_session_register_("session_success");
                    }
                }
            }
        }else{
            require_once("../" . def_directory_classes_master . "class_daftarharga.php");
            $var_class_daftarharga = new _class_daftarharga_();
        }
    }else{
        require_once("../" . def_directory_classes_master . "class_daftarharga.php");
        $var_class_daftarharga = new _class_daftarharga_();
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
                    require_once(def_directory_modules . "daftarharga/" . "module_add.php");
                ?>
                </td>
                <?php
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "update")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_kode = _set_variable_http_("processid");

                    if(_is_not_null_($var_kode)){
                        require_once("../" . def_directory_classes_master . "class_daftarharga.php");
                        $var_class_daftarharga = new _class_daftarharga_();
                        if(!$var_class_daftarharga->_is_primary_exist2_($var_kode)){
                            ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "daftarharga/" . "module_error.php");
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_daftarharga->_set_data_($var_kode);

                    require_once(def_directory_modules . "daftarharga/" . "module_update.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "daftarharga/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"]) && $HTTP_GET_VARS["action"] == "true"){
                        require_once(def_directory_modules . "daftarharga/" . "module_update.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "daftarharga/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "delete")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_kode = _set_variable_http_("processid");

                    if(_is_not_null_($var_kode)){
                        require_once("../" . def_directory_classes_master . "class_daftarharga.php");
                        $var_class_daftarharga = new _class_daftarharga_();

                        if(!$var_class_daftarharga->_is_primary_exist2_($var_kode)){
                            ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        require_once(def_directory_modules . "daftarharga/" . "module_delete.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "daftarharga/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_daftarharga->_set_data_($var_kode);

                    require_once(def_directory_modules . "daftarharga/" . "module_delete.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "daftarharga/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "daftarharga/" . "module_delete.php");
                    }else{
                        require_once(def_directory_modules . "daftarharga/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top" align="center"><?php
                    require_once(def_directory_modules . "daftarharga/" . "module_view.php");
                    ?></td>
                    <?php } ?>
            </tr>
        </table>

        <?php require_once(def_directory_includes . "application_bottom.php") ?>
    </body>
</html>