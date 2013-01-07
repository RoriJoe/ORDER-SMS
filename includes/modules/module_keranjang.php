<?php if(_is_session_registered_("session_error")){ ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="myerror">
    <tr>
        <td align="center">
            <?php echo(_set_label_("", $session_error)); ?>
        </td>
    </tr>
    <tr>
        <td align="center">
            <?php
                if($var_login == true){
                    echo(_set_hyperlink_(def_application_login, "Login Sekarang"));
                }else{
                    echo(_set_hyperlink_(def_application_keranjang, "Kembali Ke Keranjang Belanja"));
                }
            ?>
        </td>
    </tr>
</table>
<?php
        _set_session_unregister_("session_error");
    }elseif(_is_session_registered_("session_success")){
?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" class="mysuccess">
    <tr>
        <td align="center">
            <?php echo(_set_label_("", $session_success)); ?>
        </td>
    </tr>
    <tr>
        <td align="center">
            <?php
                echo(_set_hyperlink_(def_application_account, "Kembali ke My Account"));
            ?>
        </td>
    </tr>
</table>

<?php
        _set_session_unregister_("session_success");
    }else{
?>

<table border="0" width="100%" cellpadding="10" cellspacing="0" align="center">
	<tr>
		<td align="center" class="mytitle">
            <?php
                echo(_set_label_("", "Keranjang Anda", 'class="mylabel large"'));
            ?>
		</td>
	</tr>
    <tr>
        <td align="center">
            <form action="<?php echo(_set_link_(def_application_keranjang, "process=confirm&action=true")); ?>" method="post">
            <table border="0" cellpadding="5" cellspacing="5" class="mytable_brw">
                <tr>
                    <td colspan="5" align="center" class="mytable_cpt"><?php echo(_set_label_("", $var_class_pemakai->var_userid)); ?></td>
                </tr>
                <tr>
                    <td><?php echo(_set_label_("", "Menu")); ?></td>
                    <td><?php echo(_set_label_("", "Jumlah")); ?></td>
                    <td><?php echo(_set_label_("", "Tanggal")); ?></td>
                    <td><?php echo(_set_label_("", "Harga")); ?></td>
                    <td width="15px">&nbsp;</td>
                </tr>

                <?php
                    $var_class_keranjang->_restore_contents_();

                    reset($var_class_keranjang->var_contents);

                    require_once(def_directory_classes_master . "class_menu.php");
                    $var_class_menu = new _class_menu_();
                    
                    while(list($var_key, $var_value) = each($var_class_keranjang->var_contents)){
                        $var_class_menu->_set_data_($var_key);
                ?>

                <tr>
                    <td class="mytable_cnt">
                        <?php
                            echo(_set_input_("txt_menuid[]", $var_key, "hidden"));
                            echo(_set_label_("", _set_field_value(def_table_menu, "nama", "menuid='" . _set_input_string_($var_key) . "'")));
                        ?>
                    </td>
                    <td align="center" class="mytable_cnt"><?php echo(_set_input_("txt_qty" . $var_key, $var_value['qty'], "text", 'maxlength="2" style="width: 30px" onkeyup="javascript:_get_total_(\'' . $session_userid . '\', \'' . $var_key . '\', \'txt_qty' . $var_key . '\', \'lbl_subtotal' . $var_key . '\', \'lbl_total\', \'tbl_conf\');"')); ?></td>
                    <td class="mytable_cnt"><?php echo(_set_label_("", $var_value['tanggal'])); ?></td>
                    <td class="mytable_cnt">
                        <?php
                            $var_class_keranjang->_calculate_($var_key);
                            
                            echo(_set_label_("lbl_subtotal" . $var_key, "Rp. " . $var_class_keranjang->var_total));
                        ?>
                    </td>
                    <td align="center"><?php echo(_set_image_link_(def_directory_images_buttons . "delete.png", def_application_keranjang, "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key . "&action=true")); ?></td>
                </tr>

                <?php } ?>
                <tr>
                    <td colspan="3" align="right" class="mytable_cnt"><?php echo(_set_label_("", "Total")); ?></td>
                    <td align="right" class="mytable_cnt">
                        <?php
                            $var_class_keranjang->_calculate_("");
                            
                            echo(_set_label_("lbl_total", "Rp. " . $var_class_keranjang->var_total));
                        ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="5">
                <div>
                <table id="tbl_conf" width="100%" border="0" cellpadding="5" cellspacing="5" class="mytable_brw">
                <?php
                    $var_voucher = $var_class_voucher->_get_voucher_($session_userid);

                    if($var_class_keranjang->var_total > $var_voucher){
                ?>

                <tr>
                    <td colspan="5" align="center" class="myerror">
                        <?php
                            echo(_set_label_("", "Voucher anda tidak mencukupi, Silahkan tambah voucher anda. Voucher = Rp. " . $var_voucher));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo(_set_label_("", "Kirim ke")); ?></td>
                    <td colspan="2">
                        <?php
                            $var_array_alamat = array('id' => array("Gedung 1, Lantai 1",
"Gedung 1, Lantai 2",
"Gedung 1, Lantai 3",
"Gedung 1, Lantai 4",
"Gedung 1, Lantai 5",
"Gedung 2, Lantai 1",
"Gedung 2, Lantai 2",
"Gedung 2, Lantai 3",
"Gedung 2, Lantai 4",
"Gedung 2, Lantai 5",
"Gedung 3, Lantai 1",
"Gedung 3, Lantai 2",
"Gedung 3, Lantai 3",
"Gedung 3, Lantai 4",
"Gedung 3, Lantai 5",
"Gedung 4, Lantai 1",
"Gedung 4, Lantai 2",
"Gedung 4, Lantai 3",
"Gedung 4, Lantai 4",
"Gedung 4, Lantai 5",
"Gedung 5, Lantai 1",
"Gedung 5, Lantai 2",
"Gedung 5, Lantai 3",
"Gedung 5, Lantai 4",
"Gedung 5, Lantai 5"), 'text' => array("Gedung 1, Lantai 1",
"Gedung 1, Lantai 2",
"Gedung 1, Lantai 3",
"Gedung 1, Lantai 4",
"Gedung 1, Lantai 5",
"Gedung 2, Lantai 1",
"Gedung 2, Lantai 2",
"Gedung 2, Lantai 3",
"Gedung 2, Lantai 4",
"Gedung 2, Lantai 5",
"Gedung 3, Lantai 1",
"Gedung 3, Lantai 2",
"Gedung 3, Lantai 3",
"Gedung 3, Lantai 4",
"Gedung 3, Lantai 5",
"Gedung 4, Lantai 1",
"Gedung 4, Lantai 2",
"Gedung 4, Lantai 3",
"Gedung 4, Lantai 4",
"Gedung 4, Lantai 5",
"Gedung 5, Lantai 1",
"Gedung 5, Lantai 2",
"Gedung 5, Lantai 3",
"Gedung 5, Lantai 4",
"Gedung 5, Lantai 5"));

                            echo(_set_pulldown_("slt_alamat", $var_array_alamat, 24));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="right" class="mytable_cpt"><?php echo(_set_submit_("", "Konfirmasi")); ?></td>
                </tr>

                <?php }elseif($var_class_keranjang->var_total == 0){ ?>

                <tr>
                    <td colspan="5" align="center" class="myerror">
                        <?php
                            echo(_set_input_("txt_confirm", "false", "hidden"));
                            echo(_set_label_("", "Belum terdapat pesan"));
                        ?>
                    </td>
                </tr>

                <?php }else{ ?>
                
                <tr>
                    <td colspan="3"><?php echo(_set_label_("", "Kirim ke")); ?></td>
                    <td colspan="2">
                        <?php
                            $var_array_alamat = array('id' => array("Gedung 1, Lantai 1",
"Gedung 1, Lantai 2",
"Gedung 1, Lantai 3",
"Gedung 1, Lantai 4",
"Gedung 1, Lantai 5",
"Gedung 2, Lantai 1",
"Gedung 2, Lantai 2",
"Gedung 2, Lantai 3",
"Gedung 2, Lantai 4",
"Gedung 2, Lantai 5",
"Gedung 3, Lantai 1",
"Gedung 3, Lantai 2",
"Gedung 3, Lantai 3",
"Gedung 3, Lantai 4",
"Gedung 3, Lantai 5",
"Gedung 4, Lantai 1",
"Gedung 4, Lantai 2",
"Gedung 4, Lantai 3",
"Gedung 4, Lantai 4",
"Gedung 4, Lantai 5",
"Gedung 5, Lantai 1",
"Gedung 5, Lantai 2",
"Gedung 5, Lantai 3",
"Gedung 5, Lantai 4",
"Gedung 5, Lantai 5"), 'text' => array("Gedung 1, Lantai 1",
"Gedung 1, Lantai 2",
"Gedung 1, Lantai 3",
"Gedung 1, Lantai 4",
"Gedung 1, Lantai 5",
"Gedung 2, Lantai 1",
"Gedung 2, Lantai 2",
"Gedung 2, Lantai 3",
"Gedung 2, Lantai 4",
"Gedung 2, Lantai 5",
"Gedung 3, Lantai 1",
"Gedung 3, Lantai 2",
"Gedung 3, Lantai 3",
"Gedung 3, Lantai 4",
"Gedung 3, Lantai 5",
"Gedung 4, Lantai 1",
"Gedung 4, Lantai 2",
"Gedung 4, Lantai 3",
"Gedung 4, Lantai 4",
"Gedung 4, Lantai 5",
"Gedung 5, Lantai 1",
"Gedung 5, Lantai 2",
"Gedung 5, Lantai 3",
"Gedung 5, Lantai 4",
"Gedung 5, Lantai 5"));

                            echo(_set_pulldown_("slt_alamat", $var_array_alamat, 24));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="right" class="mytable_cpt"><?php echo(_set_submit_("", "Konfirmasi")); ?></td>
                </tr>

                <?php } ?>
                </table>
                </div>
                    </td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
</table>

<?php } ?>