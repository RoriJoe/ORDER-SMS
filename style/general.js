var var_menu_html;

function _set_focus_(var_objid){
  	if(var_objid.className == 'mytextinput'){
  		var_objid.className = 'mytextinputfcs';
  	}else{
		var_objid.className = 'mytextinput';
	}
}

function _check_message_(var_objid, var_divid, var_maxlength){
	var var_left = (parseInt(var_maxlength) - parseInt(var_objid.value.length));
	
	if(var_left < 0) var_left = 0;
	
	document.getElementById(var_divid).innerHTML = '<label id="">Tinggal ' + var_left + ' Karakter</label>';
}

function _set_clear_menu_report_(){
    var_menu_html = '';
}

function _set_menu_report_(var_menu, var_qty, var_harga){
    var_menu_html += '<tr><td>' + var_menu + '</td><td>' + var_qty + '</td><td>Rp. ' + var_harga + '</td></tr>';
}

function _set_report_(var_notransaksi, var_username, var_tanggal, var_total){
    var_html = "<html><head><title>" + var_notransaksi + "</title></head><body>";
    var_html += '<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td align="left"><table border="0" cellpadding="2" cellspacing="2"><tr><td><b>No Transaksi</b></td>';
    var_html += '<td> : </td>';
    var_html += '<td>' + var_notransaksi + '</td>';
    var_html += '</tr><tr><td><b>Pemakai</b></td>';
    var_html += '<td> : </td>';
    var_html += '<td>' + var_username + '</td>';
    var_html += '</tr><tr><td><b>Tanggal</b></td>';
    var_html += '<td> : </td>';
    var_html += '<td>' + var_tanggal + '</td>';
    var_html += '</tr></table></td></tr><tr><td align="left"><table border="1" cellpadding="2" cellspacing="2"><tr><td width="220px"><b>Menu</b></td><td width="50px"><b>Qty</b></td><td width="80px"><b>Harga</b></td></tr>';
    var_html += var_menu_html;
    var_html += '<tr><td colspan="2" align="center"><b>Total</b></td><td>Rp. ' + var_total + '</td>';
    var_html += '</tr></table></td></tr></table>';
    var_html += '<br /><label style="font-size: 11px">Terima kasih telah bertransaksi bersama kami</label>';
    var_html += "</body></html>";

    var_windows = window.open("", "report", "menubar=1, width=400, height=300, left=0, top=0");

    var_windows.document.open();
    var_windows.document.write(var_html);
    var_windows.document.close();
    var_windows.focus();
}

function _get_total_(var_userid, var_menuid, var_qty, var_subtotalid, var_totalid, var_tableid){
    var_qty = document.getElementById(var_qty).value;

    var_url = "rpc.php?userid=" + var_userid + "&menuid=" + var_menuid + "&qty=" + var_qty;

    var var_XMLHTTPRequestObject = false;

    if(window.XMLHttpRequest){
        var_XMLHTTPRequestObject = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        var_XMLHTTPRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
    }

    if(var_XMLHTTPRequestObject){
        var_XMLHTTPRequestObject.open("GET", var_url, true);

        var_XMLHTTPRequestObject.onreadystatechange = function(){
            if((var_XMLHTTPRequestObject.readyState == 4) && (var_XMLHTTPRequestObject.status == 200)){
                var var_result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\|([^|]*)\]\]/.exec(var_XMLHTTPRequestObject.responseText);
                //var var_result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(var_XMLHTTPRequestObject.responseText);
                var_result.shift();

                document.getElementById(var_subtotalid).innerHTML = "Rp. " + var_result[0];
                document.getElementById(var_totalid).innerHTML = "Rp. " + var_result[1];
                document.getElementById(var_tableid).innerHTML = var_result[2];
            }
        }

        var_XMLHTTPRequestObject.send(null);
    }
}