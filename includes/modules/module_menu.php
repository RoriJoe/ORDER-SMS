<table border="0" width="100%" cellpadding="10" cellspacing="0" align="center">
	<tr>
		<td align="center" class="mytitle">
            <?php
                if(isset($HTTP_GET_VARS["restoranid"])){
                    echo(_set_label_("", "Daftar Menu (" . _set_field_value(def_table_restoran, "nama", "restoranid='" . _set_input_string_(_set_variable_http_("restoranid")) . "'") . ")", 'class="mylabel large"'));
                }else{
                    echo(_set_label_("", "Daftar Menu", 'class="mylabel large"'));
                }
            ?>
		</td>
	</tr>
    <tr>
        <td align="left">
            <?php
            if(isset($HTTP_GET_VARS["menuid"]) && isset($HTTP_GET_VARS["action"]) && (_set_variable_http_("action") == "true")){
            ?>

            <?php
                require_once(def_directory_classes_master . "class_menu.php");
                $var_class_menu = new _class_menu_();

                $var_menuid = _set_variable_http_("menuid");

                $var_class_menu->_set_data_($var_menuid);
            ?>

            <table border="0" width="100%" cellpadding="5" cellspacing="5" class="myform">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="2" cellspacing="2">
                            <tr>
                                <td align="center" colspan="3">
                                    <?php echo(_set_image_link_(def_directory_images_menu . $var_class_menu->var_menuid . ".jpg", "", "", "100px", "100px", $var_class_menu->var_nama)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo(_set_label_("", "Nama")); ?>
                                </td>
                                <td><?php echo(_set_label_("", " : ")); ?></td>
                                <td>
                                    <?php echo(_set_label_("", $var_class_menu->var_nama)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo(_set_label_("", "Keterangan")); ?>
                                </td>
                                <td><?php echo(_set_label_("", " : ")); ?></td>
                                <td>
                                    <?php echo(_set_label_("", $var_class_menu->var_keterangan)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo(_set_label_("", "Kode SMS")); ?>
                                </td>
                                <td><?php echo(_set_label_("", " : ")); ?></td>
                                <td>
                                    <?php echo(_set_label_("", $var_class_menu->var_kodemenu)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo(_set_label_("", "Harga")); ?>
                                </td>
                                <td><?php echo(_set_label_("", " : ")); ?></td>
                                <td>
                                    <?php echo(_set_label_("", "Rp. " . $var_class_menu->var_harga)); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php echo(_set_hyperlink_(def_application_pesan, "Pesan Sekarang", "", "menuid=" . $var_menuid . "&restoranid=" . _set_variable_http_("restoranid") . "&process=pesan")); ?>
                    </td>
                </tr>
            </table>

            <?php }else{ ?>

            <?php
                require_once(def_directory_classes_master . "class_menu.php");

                if(isset($HTTP_GET_VARS["restoranid"])){
                    $var_class_menu = new _class_menu_("", "", _set_variable_http_("restoranid"), "", def_yes);
                }else{
                    $var_class_menu = new _class_menu_("", "", "", "", def_yes);
                }
                
                if(_is_not_null_($var_class_menu->var_array_menu)){
                    $var_counter = 1;
            ?>
                <table border="0" width="100%" cellpadding="3" cellspacing="3">
                    <?php
                        while(list($var_key, $var_value) = each($var_class_menu->var_array_menu)){
                            $var_counter++;
                    ?>
                    <?php if(($var_counter%2) == 0){ ?>
                    <tr>
                    <?php } ?>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <?php
                                            echo(_set_image_link_(def_directory_images_menu . $var_key . ".jpg", "", "", "100px", "100px", $var_value['nama']));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <?php
                                            echo(_set_hyperlink_(def_application_menu, $var_value['nama'], "", "menuid=" . $var_key . "&restoranid=" . $var_value['restoranid'] . "&action=true"));
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    <?php if(($var_counter%2) != 0){ ?>
                    </tr>
                    <?php } ?>
                    <?php
                        }
                    ?>
                </table>
            <?php
                }
            }
            ?>
        </td>
    </tr>
</table>