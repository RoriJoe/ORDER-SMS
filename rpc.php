<?php
require_once("includes/application_startup.php");

if(isset($HTTP_GET_VARS["menuid"]) && isset($HTTP_GET_VARS["userid"])){
    $var_userid = _set_variable_http_("userid");
    $var_menuid = _set_variable_http_("menuid");
    $var_qty = _set_variable_http_("qty");

    _check_it_($var_userid, $var_menuid, $var_qty, &$var_subtotal, &$var_total);

    if(is_numeric($var_qty)){
        require_once(def_directory_classes_transaksi . "class_voucher.php");
        $var_class_voucher = new _class_voucher_();

        $var_voucher = $var_class_voucher->_get_voucher_($var_userid);
        
        if($var_total > $var_voucher){
            echo('[[' . $var_subtotal . '|' . $var_total . '|' . _set_error2_($var_voucher) . ']]');
        }else{
            echo('[[' . $var_subtotal . '|' . $var_total . '|' . _set_success_() . ']]');
        }
    }else{
        echo('[[0|0|' . _set_error1_() . ']]');
    }
}

_set_session_close_();
_set_close_connection_();

function _check_it_($var_userid, $var_menuid, $var_qty, &$var_subtotal, &$var_total){
    require_once(def_directory_classes . "class_keranjang.php");
    $var_class_keranjang = new _class_keranjang_();

    $var_subtotal = 0;
    $var_total = 0;

    $var_query_link = _set_query_("SELECT menuid, qty FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($var_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");

    while($var_menu = _set_fetch_array_($var_query_link)){
        $var_subtotal += ((int)$var_qty * _set_double_($var_class_keranjang->_set_harga_($var_menu['menuid']), 0));
    }

    $var_query_link = _set_query_("SELECT menuid, qty FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($var_userid) . "'");

    while($var_menu = _set_fetch_array_($var_query_link)){
        if($var_menu['menuid'] == $var_menuid){
            $var_total += ((int)$var_qty * _set_double_($var_class_keranjang->_set_harga_($var_menu['menuid']), 0));
        }else{
            $var_total += ((int)$var_menu['qty'] * _set_double_($var_class_keranjang->_set_harga_($var_menu['menuid']), 0));
        }
    }
}

function _set_error1_(){
    $var_html = '<tr>';
    $var_html .= '<td align="center" class="myerror">';
    $var_html .= _set_input_("txt_confirm", "false", "hidden");
    $var_html .= _set_label_("", "Mohon Masukkan Qty yang valid");
    $var_html .= '</td>';
    $var_html .= '</tr>';

    return $var_html;
}

function _set_error2_($var_voucher){
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
    
    $var_html = '<tr>';
    $var_html .= '<td colspan="2" align="center" class="myerror">' . _set_label_("", "Voucher anda tidak mencukupi, Silahkan tambah voucher anda. Voucher = Rp. " . $var_voucher);
    $var_html .= '</td></tr><tr>';
    $var_html .= '<td>' . _set_label_("", "Kirim ke") . '</td>';
    $var_html .= '<td>';
    $var_html .= _set_pulldown_("slt_alamat", $var_array_alamat, 24);
    $var_html .= '</td></tr><tr>';
    $var_html .= '<td colspan="5" align="right" class="mytable_cpt">' . _set_submit_("", "Konfirmasi") . '</td></tr>';

    return $var_html;
}

function _set_success_(){
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

    $var_html = '<tr>';
    $var_html .= '<td>' . _set_label_("", "Kirim ke") . '</td>';
    $var_html .= '<td>';
    $var_html .= _set_pulldown_("slt_alamat", $var_array_alamat, 24);
    $var_html .= '</td></tr><tr>';
    $var_html .= '<td colspan="2" align="right" class="mytable_cpt">' . _set_submit_("", "Konfirmasi") . '</td></tr>';

    return $var_html;
}
?>