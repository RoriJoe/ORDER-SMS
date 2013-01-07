<?php
	class _class_handphone_{
		var $var_array_handphone;
		
		var $var_model;
		var $var_port;
		var $var_connection;
		var $var_activeyn;
		
		function _class_handphone_($var_model = "", $var_port = "", $var_connection = ""){
			$var_criteria = "";
			
			if(_is_not_null_($var_model)){
				$var_criteria = "model LIKE '%" . _set_input_string_($var_model) . "%'";
			}
			
			if(_is_not_null_($var_port)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}
				
				$var_criteria .= "port LIKE '%" . _set_input_string_($var_port) . "%'";
			}
			
			if(_is_not_null_($var_connection)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}
				
				$var_criteria .= "connection LIKE '%" . _set_input_string_($var_connection) . "%'";
			}
			
			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}
			
			$this->var_array_handphone = array();
			
			$var_query_link = _set_query_("SELECT * FROM " . def_table_handphone . $var_criteria);
			
			while($var_array_handphone = _set_fetch_array_($var_query_link)){
				$this->var_array_handphone[$var_array_handphone['handphoneno']] = array('model' => $var_array_handphone['model'],
																				'port' => $var_array_handphone['port'],
																				'connection' => $var_array_handphone['connection'],
																				'activeyn' => $var_array_handphone['activeyn']);
			}
		}
		
		function _is_primary_exist_($var_handphoneno){
			if(!_is_not_null_($var_handphoneno)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT handphoneno FROM " . def_table_handphone . " WHERE handphoneno=" . _set_input_string_($var_handphoneno));
			
			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}
		
		function _set_data_($var_handphoneno){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_handphone . " WHERE handphoneno=" . _set_input_string_($var_handphoneno));
			
			while($var_array_handphone = _set_fetch_array_($var_query_link)){
				$this->var_model = $var_array_handphone['model'];
				$this->var_port = $var_array_handphone['port'];
				$this->var_connection = $var_array_handphone['connection'];
				$this->var_activeyn = $var_array_handphone['activeyn'];
			}
		}
		
		function _save_data_($var_model, $var_port, $var_connection){
			if(!_is_not_null_($var_model)){
				return false;
			}
			
			if(!_is_not_null_($var_port)){
				return false;
			}
			
			if(!_is_not_null_($var_connection)){
				return false;
			}
			
			return _set_query_("INSERT INTO " . def_table_handphone . " VALUES ('', '" . _set_input_string_($var_model) . "', '" . _set_input_string_($var_port) . "', '" . _set_input_string_($var_connection) . "', 'N')");
		}
		
		function _set_handphone_($var_handphoneno){
			_set_query_("UPDATE " . def_table_handphone . " SET activeyn='N'");
			_set_query_("UPDATE " . def_table_handphone . " SET activeyn='Y' WHERE handphoneno='" . _set_input_string_($var_handphoneno) . "'");
		}
		
		function _delete_data_($var_handphoneno){
			if(!_is_not_null_($var_handphoneno)){
				return false;
			}
			
			if($this->_is_primary_exist_($var_handphoneno)){
				return _set_query_("DELETE FROM " . def_table_handphone . " WHERE handphoneno=" . _set_input_string_($var_handphoneno));
			}else{
				return false;
			}
		}
		
		function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_handphone);
			
			$var_array_handphone = array();
			
			while(list($var_key, $var_value) = each($this->var_array_handphone)){
				if($var_value['activeyn'] == "Y"){
						$var_default = $var_key;
				}
				
				$var_array_handphone[] = array('id' => $var_key, 'text' => $var_value['model'] . " | " . $var_value['port'] . " | " . $var_value['connection']);
			}
			
			return _set_pulldown_db_($var_pulldown_id, $var_array_handphone, $var_default, $var_parameter, $var_reinsert_value);
		}
	}
?>