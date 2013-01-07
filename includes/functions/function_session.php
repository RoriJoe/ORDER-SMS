<?php
	if((PHP_VERSION >= 4.3) && ((bool)ini_get("register_globals") == false)){
		@ini_set("session.bug_compat_42", 1);
		@ini_set("session.bug_compat_warn", 0);
	}
	
	if(!$SESS_LIFE = get_cfg_var("session.gc_maxlifetime")){
		$SESS_LIFE = 1440;
	}
	
	function _session_open_($var_save_path, $var_session_name){
		return true;
	}
	
	function _session_close_(){
		return true;
	}
	
	function _session_read_($var_sessionid){
		$var_query_link = _set_query_("SELECT value FROM " . def_table_session . " WHERE sessionid='" . _set_input_string_($var_sessionid) . "' AND expiry > '" . time() . "'");
		
		$var_array_value = _set_fetch_array_($var_query_link);
		
		if(isset($var_array_value["value"])){
			return $var_array_value["value"];
		}
		
		return '';
	}
	
	function _session_write_($var_sessionid, $var_value){
		global $SESS_LIFE;
		
		$var_expiry = time() + $SESS_LIFE;
		
		$var_query_link = _set_query_("SELECT count(*) AS total FROM " . def_table_session . " WHERE sessionid='" . _set_input_string_($var_sessionid) . "'");
		
		$var_array_value = _set_fetch_array_($var_query_link);
		
		if($var_array_value["total"] > 0){
			return _set_query_("UPDATE " . def_table_session . " set expiry='" . _set_input_string_($var_expiry) . "', value='" . _set_input_string_($var_value) . "' WHERE sessionid='" . _set_input_string_($var_sessionid) . "'");
		}else{
			return _set_query_("INSERT INTO " . def_table_session . " VALUES ('" . _set_input_string_($var_sessionid) . "', '" . _set_input_string_($var_expiry) . "', '" . _set_input_string_($var_value) . "')");
		}
	}
	
	function _session_destroy_($var_sessionid){
		return _set_query_("DELETE FROM " . def_table_session . " WHERE sessionid='" . _set_input_string_($var_sessionid) . "'");
	}
	
	function _session_gc_($var_maxlifetime){
		_set_query_("DELETE FROM " . def_table_session . " WHERE expiry < '" . time() . "'");
		
		return true;
	}
	
	session_set_save_handler("_session_open_", "_session_close_", "_session_read_", "_session_write_", "_session_destroy_", "_session_gc_");
	
	function _set_session_start_(){
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS;
		
		$var_session = true;
		
		if(isset($HTTP_GET_VARS[_set_session_name_()])) {
			if(preg_match("/^[a-zA-Z0-9]+$/", $HTTP_GET_VARS[_set_session_name_()]) == false) {
				unset($HTTP_GET_VARS[_set_session_name_()]);
				
				$var_session = false;
			}
		}elseif(isset($HTTP_POST_VARS[_set_session_name_()])) {
			if (preg_match("/^[a-zA-Z0-9]+$/", $HTTP_POST_VARS[_set_session_name_()]) == false) {
				unset($HTTP_POST_VARS[_set_session_name_()]);
				
				$var_session = false;
			}
		}elseif(isset($HTTP_COOKIE_VARS[_set_session_name_()])) {
			if(preg_match("/^[a-zA-Z0-9]+$/", $HTTP_COOKIE_VARS[_set_session_name_()]) == false) {
				$var_session_data = session_get_cookie_params();
				
				setcookie(_set_session_name_(), "", time()-42000, $var_session_data["path"], $var_session_data["domain"]);
				
				$var_session = false;
			}
		}
		
		if($var_session == false){
			_set_location_(def_application_home);
		}
		
		return session_start();
	}
	
	function _set_session_close_(){
		if(function_exists("session_close")) {
			return session_close();
		}else{
			return session_write_close();
		}
	}
	
	function _set_session_id_($var_session_id = ""){
		if(!empty($var_sessionid)){
			return session_id($var_session_id);
		}else{
			return session_id();
		}
	}
	
	function _set_session_name_($var_session_name = ""){
		if(!empty($var_session_name)){
			return session_name($var_session_name);
		}else{
			return session_name();
		}
	}
	
	function _set_session_destroy_() {
		return session_destroy();
	}
	
	function _set_session_register_($var_session_text) {
		if(PHP_VERSION < 4.3){
			return session_register($var_session_text);
		}else{
			if(isset($GLOBALS[$var_session_text])){
				$_SESSION[$var_session_text] =& $GLOBALS[$var_session_text];
			}else{
				$_SESSION[$var_session_text] = null;
			}
		}
	}
	
	function _set_session_unregister_($var_session_text) {
		if(PHP_VERSION < 4.3) {
			return session_unregister($var_session_text);
		}else{
			unset($_SESSION[$var_session_text]);
		}
	}
	
	function _is_session_registered_($var_session_text) {
		if(PHP_VERSION < 4.3){
			return session_is_registered($var_session_text);
		}else{
			return array_key_exists($var_session_text, $_SESSION);
		}
	}
	
	function _set_session_save_path_($var_path = ""){
		if(!empty($var_path)){
			return session_save_path($var_path);
		}else{
			return session_save_path();
		}
	}
?>