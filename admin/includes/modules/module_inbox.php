<table border="0" width="100%" cellpadding="5" cellspacing="2">
	<tr>
		<td align="center" class="mytitle">
			<?php echo(_set_label_("", "KOTAK MASUK")); ?>
		</td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="0" cellspacing="0" class="myform">
	<tr>
		<td align="right">
			<form action="<?php echo(_set_link_(def_application_inbox, "process=search")); ?>" method="post">
				<table border="0" cellpadding="2" cellspacing="0">
					<tr>
						<td align="left" class="mytext">
							<?php echo(_set_label_("", "No Handphone")); ?>
						</td>
						<td>
							<?php echo(_set_input_("txt_nohp", "", "text")); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<?php echo(_set_submit_("", "Cari", "submit")); ?>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>

<table border="0" cellpadding="5" cellspacing="2">
	<?php if(_is_session_registered_("session_process")){ ?>
	<tr>
		<td align="center" class="mycaption">
			<table border="0" cellpadding="3" cellspacing="3">
				<tr>
					<td colspan="2">
						<?php echo(_set_label_("", $session_process)); ?>
					</td>
				</tr>
				<tr>
					<td align="left">
						<?php echo(_set_hyperlink_(def_application_inbox, "Hapus", "", "process=delete&processid=" . $HTTP_GET_VARS["processid"] . "&action=true")) ?>
					</td>
					<td align="right">
						<?php echo(_set_hyperlink_(def_application_inbox, "Tidak")) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		_set_session_unregister_("session_process");
	}
	?>

    <?php
        if(_set_variable_http_("process") == "deleteall"){
    ?>
    <tr>
        <td align="center" class="mycaption">
            <table border="0" cellpadding="5" cellspacing="2">
                <tr>
                    <td colspan="2" align="center">
                        <?php echo(_set_label_("", "Apakah Anda Yakin Untuk Menghapus Semuanya?")); ?>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <?php
                            echo(_set_hyperlink_(def_application_inbox, "Hapus", "", "process=deleteall&action=true"));
                        ?>
                    </td>
                    <td align="right">
                        <?php echo(_set_hyperlink_(def_application_inbox, "Tidak")) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php } ?>
	<?php if(_is_session_registered_("session_success")){ ?>
	<tr>
		<td align="center" class="mysuccess">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<?php echo(_set_label_("", $session_success)); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		_set_session_unregister_("session_success");
	}
	?>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" class="mytable_brw">
				<tr>
					<td colspan="5" class="mytable_cpt">
						<?php echo(_set_label_("", "DAFTAR KOTAK MASUK")); ?>
					</td>
				</tr>
				<tr>
					<td width="150px">
						<?php echo(_set_label_("", "Tanggal")); ?>
					</td>
					<td width="200px">
						<?php echo(_set_label_("", "No Handphone")); ?>
					</td>
					<td width="300px">
						<?php echo(_set_label_("", "Pesan")); ?>
					</td>
					<td width="15px">&nbsp;</td>
					<td width="15px">
                        <?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_inbox , "", "20px", "20px", "Hapus Semua", "", "process=deleteall")); ?>
                    </td>
				</tr>
				<?php
					if(isset($var_class_inbox) && is_object($var_class_inbox)){
						if(_is_not_null_($var_class_inbox->var_array_inbox)){
                            require_once("../" . def_directory_classes_master . "class_pemakai.php");
                            $var_class_pemakai = new _class_pemakai_();

                            require_once("../" . def_directory_classes_transaksi . "class_pesan.php");
                            $var_class_pesan = new _class_pesan_();

                            require_once("../" . def_directory_classes_transaksi . "class_voucher.php");
                            $var_class_voucher = new _class_voucher_();

                            while(list($var_key, $var_value) = each($var_class_inbox->var_array_inbox)){
                                if($var_value['statusyn'] != def_yes){
                                    if(preg_match(def_kode_registrasi, $var_value['pesan'], $var_temp)){
                                        if(!$var_class_pemakai->_is_exist2_(str_replace("+62", "0", $var_value['nohp']))){
                                            $var_class_pemakai->_save_data_(str_replace("+62", "0", $var_value['nohp']), $var_temp[1], str_replace("+62", "0", $var_value['nohp']), def_no, def_no, "", "", str_replace("+62", "0", $var_value['nohp']), "", def_no);

                                            $var_class_inbox->_delete_data_($var_key);
                                        }else{
                                            if($var_class_setting->_is_autoreply_()){
                                                $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), def_registrasi_exists);
                                            }
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~Pemakai Sudah Ada~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <?php
                                            $var_class_inbox->_save_data2_($var_key);
                                        }
                                    }elseif(preg_match(def_kode_pesan, $var_value['pesan'], $var_temp)){
                                        if(!$var_class_pemakai->_is_exist2_(str_replace("+62", "0", $var_value['nohp']))){
                                            if($var_class_setting->_is_autoreply_()){
                                                $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), def_user_problem);
                                            }

                                            $var_class_inbox->_save_data2_($var_key);
                                        }else{
                                            if($var_class_pesan->_check_sms_($var_temp[1], $var_alamat)){
                                                $var_class_pemakai->_set_data2_(str_replace("+62", "0", $var_value['nohp']));

                                                if($var_class_pemakai->var_activeyn == def_yes){
                                                    if($var_class_pemakai->var_statusyn == def_yes){
                                                        if($var_class_pemakai->var_handphoneyn == def_yes){
                                                            $var_voucher = $var_class_voucher->_get_voucher_($var_class_pemakai->var_userid);

                                                            $var_harga = $var_class_pesan->_calculate_sms_($var_temp[1]);

                                                            if($var_harga > $var_voucher){
                                                                if($var_class_setting->_is_autoreply_()){
                                                                    $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), "Voucher anda tidak mencukupi, Silahkan tambah voucher anda. Voucher = Rp. " . $var_voucher);
                                                                }
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~Voucher tidak cukup~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <?php
                                                                $var_class_inbox->_save_data2_($var_key);
                                                            }else{
                                                                $var_notransaksi = $var_class_pesan->_save_data_header_($var_class_pemakai->var_userid, $var_alamat);
                                                                $var_class_pesan->_save_data_detil2_($var_notransaksi, $var_temp[1]);

                                                                $var_class_voucher->_decrement_voucher_($var_class_pemakai->var_userid, $var_harga);

                                                                $var_class_inbox->_delete_data_($var_key);

                                                                if($var_class_setting->_is_autoreply_()){
                                                                    $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), "Transaksi anda berhasil, Menu Anda siap diantar segera. No Transaksi Anda : " . $var_notransaksi);
                                                                }
                                                            }
                                                        }else{
                                                            if($var_class_setting->_is_autoreply_()){
                                                                $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), def_handphone_problem);
                                                            }
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~Handphone Bermasalah~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <?php
                                                            $var_class_inbox->_save_data2_($var_key);
                                                        }
                                                    }else{
                                                        if($var_class_setting->_is_autoreply_()){
                                                            $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), def_status_problem);
                                                        }
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~Status Bermasalah~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <?php
                                                        $var_class_inbox->_save_data2_($var_key);
                                                    }
                                                }else{
                                                    if($var_class_setting->_is_autoreply_()){
                                                        $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), def_active_problem);
                                                    }
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~Aktivasi Bermasalah~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <?php
                                                    $var_class_inbox->_save_data2_($var_key);
                                                }
                                            }else{
                                                if($var_class_setting->_is_autoreply_()){
                                                    $var_class_gammu->_gammu_send_($var_respon, str_replace("+62", "0", $var_value['nohp']), def_pesan_problem);
                                                }
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~Format Pesan Salah~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <?php
                                                $var_class_inbox->_save_data2_($var_key);
                                            }
                                        }
                                    }else{
                    ?>
                    <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'])); ?>
                        </td>
                        <td align="center">
                            <?php echo(_set_image_link_("../" . def_directory_images_buttons . "reply.gif", def_application_write, "", "20px", "20px", "Balas", "", "txt_nohp=" . str_replace("+62", "0", $var_value['nohp']) . "&processid=" . $var_key)); ?>
                        </td>
                        <td align="center">
                            <?php echo(_set_image_link_("../" . def_directory_images_buttons . "delete.png", def_application_inbox , "", "20px", "20px", "Hapus", "", "process=delete&processid=" . $var_key)); ?>
                        </td>
                    </tr>

                    <?php
                                    }
                                }else{
				?>
                <tr>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['tanggal'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['nohp'])); ?>
                        </td>
                        <td class="mytable_cnt">
                            <?php echo(_set_label_("", $var_value['pesan'] . " ~ERROR~")); ?>
                        </td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
<?php                           }
                            }
                        }
                    }
?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo(_set_hyperlink_(def_application_inbox, "Ambil Dari Handphone", 'class="mysquarebutton"', "process=handphone")); ?>
		</td>
	</tr>
	<?php if(_is_session_registered_("session_error")){ ?>
	<tr>
		<td align="center" class="myerror">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<?php echo(_set_label_("", $session_error)); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		_set_session_unregister_("session_error");
	}
	?>
</table>