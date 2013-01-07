<?php
	class _class_setting_{
		var $var_handphoneno;
		var $var_srvnumber;
		var $var_autorefresh;
		var $var_autoreply;
		
		function _class_setting_(){
			$this->_get_handphoneno_();
			$this->_get_srvnumber_();
			$this->_get_autorefresh_();
			$this->_get_autoreply_();
		}
		
		function _get_handphoneno_(){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_setting . " WHERE name='connectivity'");
			
			if(_get_num_rows_($var_query_link) > 0){
				$var_objsetting = _set_fetch_array_($var_query_link);
				
				$this->var_port = $var_objsetting["value"];
			}else{
				$this->var_port = "";
			}
		}
		
		function _get_srvnumber_(){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_setting . " WHERE name='service center'");
			
			if(_get_num_rows_($var_query_link) > 0){
				$var_objsetting = _set_fetch_array_($var_query_link);
				
				$this->var_srvnumber = $var_objsetting["value"];						
			}else{
				$this->var_srvnumber = "";
			}
		}
		
		function _get_autorefresh_(){
			$var_query_link = _set_query_("SELECT * FROM ". def_table_setting . " WHERE name='auto refresh'");
			
			if(_get_num_rows_($var_query_link) > 0){
				$var_objsetting = _set_fetch_array_($var_query_link);
				
				$this->var_autorefresh = $var_objsetting["value"];
			}else{
				$this->var_autorefresh = "";
			}
		}
		
		function _get_autoreply_(){
			$var_query_link = _set_query_("SELECT * FROM ". def_table_setting . " WHERE name='auto reply'");
			
			if(_get_num_rows_($var_query_link) > 0){
				$var_objsetting = _set_fetch_array_($var_query_link);
				
				if(trim($var_objsetting["value"]) == "1"){
					$this->var_autoreply = 'checked="check"';
				}else{
					$this->var_autoreply = "";
				}
			}else{
				$this->var_autoreply = "";
			}
		}

        function _is_autoreply_(){
            $var_query_link = _set_query_("SELECT * FROM ". def_table_setting . " WHERE name='auto reply'");

			if(_get_num_rows_($var_query_link) > 0){
				$var_objsetting = _set_fetch_array_($var_query_link);

				if(trim($var_objsetting["value"]) == "1"){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
        }
		
		function _set_data_($var_name, $var_value){
			$var_query_link = _set_query_("SELECT * FROM ". def_table_setting . " WHERE name='" . $var_name . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
				_set_query_("UPDATE setting SET value='" . $var_value . "' WHERE name='" . $var_name . "'");
			}else{
				_set_query_("INSERT INTO setting VALUES ('', '" . $var_name . "', '" . $var_value . "')");
			}
		}
		
		function _set_gammurc_($var_handphoneno){
			require_once("../" . def_directory_classes_master . "class_handphone.php");
			$var_class_handphone = new _class_handphone_();
			
			if($var_class_handphone->_is_primary_exist_($var_handphoneno)){
				$var_class_handphone->_set_handphone_($var_handphoneno);
				$var_class_handphone->_set_data_($var_handphoneno);
				
				$var_contents = '[gammu]' . "\n" .
								'model=' . $var_class_handphone->var_model . "\n" .
								'port=' . $var_class_handphone->var_port . "\n" .
								'connection=' . $var_class_handphone->var_connection . "\n";
				
				$var_file = fopen("../gammu/gammurc", "w");
				$var_file2 = fopen("gammurc", "w");
				
				fputs($var_file, $var_contents);
				fputs($var_file2, $var_contents);
				fclose($var_file);
				fclose($var_file2);
			}
		}
	}
?>