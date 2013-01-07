<?php
require_once("includes/application_startup.php");

if(_is_session_registered_("session_userid")){
    if(isset($HTTP_GET_VARS["process"])){
        if($HTTP_GET_VARS["process"] == "search"){
            $var_notransaksi = _set_variable_http_("txt_notransaksi", false);
            $var_userid = _set_variable_http_("slt_userid", false);
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

            require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
            $var_class_pesan = new _class_pesan_($var_notransaksi, $var_userid, $var_daritanggal, $var_sampaitanggal);
        }elseif($HTTP_GET_VARS["process"] == "update"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_notransaksi = _set_variable_http_("txt_notransaksi", false);
                    $var_keterangan = _set_variable_http_("txt_keterangan", false);

                    require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
                    $var_class_pesan = new _class_pesan_();
                    $var_class_pesan->_confirm_data_header_($var_notransaksi, $var_keterangan);
                    $var_class_pesan->_set_data_($var_notransaksi);

                    $session_success = $var_notransaksi . " (Sudah disimpan)";
                    _set_session_register_("session_success");
                }
            }
        }else if($HTTP_GET_VARS["process"] == "delete"){
            if(isset($HTTP_GET_VARS["action"])){
                if($HTTP_GET_VARS["action"] == "true"){
                    $var_notransaksi = _set_variable_http_("processid");

                    require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
                    $var_class_pesan = new _class_pesan_();

                    if($var_class_pesan->_is_primary_exist_header_($var_notransaksi)){
                        $var_class_pesan->_delete_data_($var_notransaksi);

                        $session_success = "Berhasil Dihapus";
                        _set_session_register_("session_success");
                    }
                }
            }
        }else if($HTTP_GET_VARS["process"] == "kirim"){
            if(isset($HTTP_GET_VARS["action"]) && $HTTP_GET_VARS["action"] == "true"){
                $var_restoranid = _set_variable_http_("restoranid");
                $var_menuid = _set_variable_http_("menuid");
                $var_qty = _set_numeric_(_set_variable_http_("qty"));
                $var_notransaksi = _set_variable_http_("notransaksi");
                $var_handphone = _set_field_value(def_table_restoran, "handphone", "restoranid='" . _set_input_string_($var_restoranid) . "'");

                if($var_qty > 0){
                    if(_is_not_null_($var_handphone)){
                        require_once("../" . def_directory_classes . "class_gammu.php");
                        $var_class_gammu = new _class_gammu_("..\\gammu\\gammu.exe");

                        $var_class_gammu->_gammu_send_(&$var_respon, $var_handphone, "PESAN MENU " . _set_field_value(def_table_menu, "nama", "menuid='" . _set_input_string_($var_menuid) . "'") . " SEBANYAK " . $var_qty);

                        $session_success = "Sudah Terkirim";
                        _set_session_register_("session_success");
                    }else{
                        $session_error = "Nomor Handphone Harap Diinput terlebih dahulu";
                        _set_session_register_("session_error");
                    }
                }else{
                    $session_error = "Qty harus > 0";
                    _set_session_register_("session_error");
                }

                _set_location_(_set_link_(def_application_order, "process=update&processid=" . $var_notransaksi));
            }
        }else{
            require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
            $var_class_pesan = new _class_pesan_();
        }
    }else{
        require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
        $var_class_pesan = new _class_pesan_();
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
                <?php if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "update")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_notransaksi = _set_variable_http_("processid");

                    if(_is_not_null_($var_notransaksi)){
                        require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
                        $var_class_pesan = new _class_pesan_();
                        if(!$var_class_pesan->_is_primary_exist_header_($var_notransaksi)){
                            ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "pesan/" . "module_error.php");
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_pesan->_set_data_($var_notransaksi);

                    require_once(def_directory_modules . "pesan/" . "module_update.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "pesan/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"]) && $HTTP_GET_VARS["action"] == "true"){
                ?>

                <script type="text/javascript">
                    _set_clear_menu_report_();
                    
                    <?php
                        $var_query_link = _set_query_("SELECT * FROM " . def_table_pesan_detil . " WHERE notransaksi='" . _set_input_string_($var_class_pesan->var_notransaksi) . "'");

                        while($var_array_pesan = _set_fetch_array_($var_query_link)){
                            $var_class_pesan->_calculate_($var_notransaksi, $var_array_pesan['menuid']);
                    ?>
                        _set_menu_report_("<?php echo(_set_field_value(def_table_menu, "nama", "menuid='" . $var_array_pesan['menuid'] . "'")); ?>", "<?php echo($var_array_pesan['qty']); ?>", "<?php echo($var_class_pesan->var_total); ?>");
                    <? } $var_class_pesan->_calculate_($var_notransaksi, ""); ?>

                    _set_report_("<?php echo($var_notransaksi); ?>", "<?php echo(_set_field_value(def_table_pemakai, "username", "userid='" . _set_input_string_($var_class_pesan->var_userid) . "'")); ?>", "<?php echo($var_class_pesan->var_tanggal); ?>", "<?php echo($var_class_pesan->var_total); ?>");
                </script>

                <?php
                        require_once(def_directory_modules . "pesan/" . "module_update.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "pesan/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else if(isset($HTTP_GET_VARS["process"]) && ($HTTP_GET_VARS["process"] == "delete")){
                if(isset($HTTP_GET_VARS["processid"])){
                    $var_notransaksi = _set_variable_http_("processid");

                    if(_is_not_null_($var_notransaksi)){
                        require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
                        $var_class_pesan = new _class_pesan_();

                        if(!$var_class_pesan->_is_primary_exist_header_($var_notransaksi)){
                            ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        require_once(def_directory_modules . "pesan/" . "module_delete.php");
                    }else{
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "pesan/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }else{
                    ?>
                <td valign="top"><?php
                    $var_class_pesan->_set_data_($var_notransaksi);

                    require_once(def_directory_modules . "pesan/" . "module_delete.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    $session_error = "Harap Mengikuti Prosedur";
                    _set_session_register_("session_error");

                    require_once(def_directory_modules . "pesan/" . "module_error.php");
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top"><?php
                    if(isset($HTTP_GET_VARS["action"])){
                        $session_error = "Harap Mengikuti Prosedur";
                        _set_session_register_("session_error");

                        require_once(def_directory_modules . "pesan/" . "module_delete.php");
                    }else{
                        require_once(def_directory_modules . "pesan/" . "module_error.php");
                    }
                    ?></td>
                    <?php
                }
            }else{
                ?>
                <td valign="top" align="center"><?php
                    require_once(def_directory_modules . "pesan/" . "module_view.php");
                    ?></td>
                    <?php } ?>
            </tr>
        </table>

        <?php require_once(def_directory_includes . "application_bottom.php") ?>
    </body>
</html>