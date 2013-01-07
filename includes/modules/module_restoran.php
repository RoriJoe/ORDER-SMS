<table border="0" width="100%" cellpadding="10" cellspacing="0" align="center">
	<tr>
		<td align="center" class="mytitle">
			<?php echo(_set_label_("", "Daftar Restoran", 'class="mylabel large"')); ?>
		</td>
	</tr>
    <tr>
        <td align="left">
            <?php
                require_once(def_directory_classes_master . "class_restoran.php");
                $var_class_restoran = new _class_restoran_("", "", def_yes);
                
                if(_is_not_null_($var_class_restoran->var_array_restoran)){
                    $var_counter = 1;
            ?>
                <table border="0" width="100%" cellpadding="5" cellspacing="5">
                    <?php
                        while(list($var_key, $var_value) = each($var_class_restoran->var_array_restoran)){
                            $var_counter++;
                    ?>
                    <?php if(($var_counter%2) == 0){ ?>
                    <tr>
                    <?php } ?>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <?php echo(_set_image_link_(def_directory_images_restoran . $var_key . ".jpg", "", "", "150px", "200px")); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <?php
                                            echo(_set_hyperlink_(def_application_menu, $var_value['nama'], "", "restoranid=" . $var_key));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <?php
                                            echo(_set_label_("", "Buka dari jam " . $var_value['buka'] . " sampai " . $var_value['tutup'], ""));
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
            ?>
        </td>
    </tr>
</table>