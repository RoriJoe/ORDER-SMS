<?php
	class _class_outbox_{
		var $var_array_outbox;
		
		var $var_pesan;
		var $var_nohp;
		var $var_tanggal;
		
		function _class_outbox_($var_pesanno = "", $var_nohp = "", $var_tanggal = ""){
			$var_criteria = "";
			
			if(_is_not_null_($var_pesanno)){
				$var_criteria = "pesanno = " . _set_input_string_($var_pesanno);
			}
			
			if(_is_not_null_($var_nohp)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}
				
				$var_criteria .= "nohp LIKE '%" . _set_input_string_($var_nohp) . "%'";
			}
			
			if(_is_not_null_($var_tanggal)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}
				
				$var_criteria .= "tanggal = '" . _set_input_string_($var_tanggal) . "'";
			}
			
			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}
			
			$this->var_array_outbox = array();
			
			$var_query_link = _set_query_("SELECT * FROM " . def_table_outbox . $var_criteria);
			
			while($var_array_outbox = _set_fetch_array_($var_query_link)){
				$this->var_array_outbox[$var_array_outbox['pesanno']] = array('nohp' => $var_array_outbox['nohp'],
																			'pesan' => $var_array_outbox['pesan'],
																			'tanggal' => $var_array_outbox['tanggal']);
			}
		}
		
		function _is_primary_exist_($var_pesanno){
			if(!_is_not_null_($var_pesanno)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT pesanno FROM " . def_table_outbox . " WHERE pesanno=" . _set_input_string_($var_pesanno));
			
			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}
		
		function _delete_data_($var_pesanno){
			if(!_is_not_null_($var_pesanno)){
				return false;
			}
			
			if($this->_is_primary_exist_($var_pesanno)){
				return _set_query_("DELETE FROM " . def_table_outbox . " WHERE pesanno=" . _set_input_string_($var_pesanno));
			}else{
				return false;
			}
		}

        function _delete_all_(){
            return _set_query_("TRUNCATE TABLE " . def_table_outbox);
        }
		
		function _save_data_($var_pesan, $var_nohp, $var_tanggal = "NOW()", $var_pesanno = ""){
			if(_is_not_null_($var_pesanno)){
				if(_is_primary_exist_($var_pesanno)){
					_set_query_("UPDATE " . def_table_outbox . " SET pesan='" . _set_input_string_($var_pesan) . "', nohp='" . _set_input_string_($var_nohp) . "', tanggal=" . $var_tanggal . " WHERE pesanno='" . _set_input_string_($var_pesanno) . "'");
				}else{
					_set_query_("INSERT INTO " . def_table_outbox . " VALUES ('', '" . _set_input_string_($var_pesan) . "', '" . _set_input_string_($var_nohp) . "', " . $var_tanggal . ")");
				}
			}else{
				_set_query_("INSERT INTO " . def_table_outbox . " VALUES ('', '" . _set_input_string_($var_pesan) . "', '" . _set_input_string_($var_nohp) . "', " . $var_tanggal . ")");
			}
		}
	}
?>