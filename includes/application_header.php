<div class="myheader">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="mycaption" align="center">
                <?php echo(_set_label_("", def_text_description));  ?>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <?php echo(_set_image_link_(def_directory_images . "Gambar untuk halaman depan.gif", "", "", "187", "269")); ?>
            </td>
        </tr>
    </table>
</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" class="mymenu">
    <tr>
        <td align="right">
            <table border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_home, "Home", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <td width="10px"><?php echo(_set_label_("", " | ")); ?></td>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_account, "My Account", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <td width="10px"><?php echo(_set_label_("", " | ")); ?></td>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_menu, "Daftar Menu", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <td width="10px"><?php echo(_set_label_("", " | ")); ?></td>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_restoran, "Daftar Restoran", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <td width="10px"><?php echo(_set_label_("", " | ")); ?></td>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_contactus, "Contact Us", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <td width="10px"><?php echo(_set_label_("", " | ")); ?></td>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_help, "Help", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <?php if(_is_session_registered_("session_userid")){ ?>
                    <td width="10px"><?php echo(_set_label_("", " | ")); ?></td>
                    <td>
                        <?php
                        echo(_set_hyperlink_(def_application_logout, "Logout", 'class="mylinkheader"'));
                        ?>
                    </td>
                    <?php } ?>
                </tr>
            </table>
        </td>
    </tr>
</table>