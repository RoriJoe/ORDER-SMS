<?php
	function _set_connection_($var_server, $var_user_name, $var_password, $var_global_link = "db_link"){
		global $$var_global_link, $var_error;
		
		$var_error = false;
		
		if(empty($var_server)){
			$var_error = "No server selected.";
			
			return false;
		}
		
		$$var_global_link = mysql_connect($var_server, $var_user_name, $var_password) or $var_error = mysql_error();
		
		return $$var_global_link;
	}
	
	function _set_close_connection_($var_global_link = "db_link"){
		global $$var_global_link;
		
		return mysql_close($$var_global_link);
	}
	
	function _set_select_database_($var_database, $var_global_link = "db_link"){
		global $$var_global_link;
		
		return mysql_select_db($var_database, $$var_global_link);
	}
	
	function _set_fetch_array_($var_query_link){
		return mysql_fetch_array($var_query_link);
	}
	
	function _set_data_seek_($var_query_link, $var_row_number){
		return mysql_data_seek($var_query_link, $var_row_number);
	}
	
	function _set_query_($var_query_text, $var_global_link = "db_link"){
		global $$var_global_link;
		
		return mysql_query($var_query_text, $$var_global_link);
	}
	
	function _set_field_value($var_table_name, $var_field_name, $var_criteria, $var_global_link = "db_link"){
		global $$var_global_link;
		
		$var_query_link = _set_query_("SELECT " . $var_field_name . " FROM " . $var_table_name . " WHERE " . $var_criteria);
		
		if(_get_num_rows_($var_query_link) > 0){
			$var_array_link = _set_fetch_array_($var_query_link);
			
			return $var_array_link[$var_field_name];
		}
	}
	
	function _is_table_exist_($var_table){
		$var_query_link = _set_query_("SELECT * FROM " . $var_table);
		
		if(!$var_query_link)
			return false;
			
		return true;
	}
	
	function _set_list_fields_($var_table){
		$var_query_link = set_query("SELECT * FROM " . $var_table);
		
		$var_array_field = array();
		
		for($var_counter = 0; $var_counter < mysql_num_fields($var_query_link); $var_counter++){
			$var_array_field[$var_counter] = mysql_field_name($var_query_link, $var_counter);
		}
		
		return $var_array_field;
	}
	
	function _set_num_rows_($var_table){
		$var_query_link = _set_query_("SELECT * FROM " . $var_table);
		
		return _get_num_rows_($var_query_link);
	}
	
	function _get_num_rows_($var_query_link){
		return mysql_num_rows($var_query_link);
	}
	
	function _set_input_string_($var_value, $var_global_link = "db_link"){
		global $$var_global_link;
		
		if(function_exists("mysql_real_escape_string")){
			return mysql_real_escape_string($var_value, $$var_global_link);
		}elseif(function_exists("mysql_escape_string")){
			return mysql_escape_string($var_value);
		}
		
		return addslashes($var_value);
  }
?>