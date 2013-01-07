<?php
	require_once("includes/application_directory.php");
	require_once(def_directory_includes . "application_error.php");
	
	if (function_exists("ini_get") && (ini_get("register_globals") == false)){
		ini_set("register_globals", "on");
	}
	
	require_once(def_directory_includes . "application_content.php");
	require_once(def_directory_includes . "application_name.php");
	require_once(def_directory_includes . "application_setting.php");
	require_once(def_directory_includes . "application_table.php");
	
	require_once(def_directory_functions . "function_general.php");
	require_once(def_directory_functions . "function_control.php");	
	require_once(def_directory_functions . "function_compability.php");
	require_once(def_directory_functions . "function_database.php");
	
	_set_connection_(def_server_name, def_database_username, def_database_password);
	_set_select_database_(def_database_name);
	
	if(!isset($PHP_SELF)){
		$PHP_SELF = $HTTP_SERVER_VARS["PHP_SELF"];
	}
	
	require_once(def_directory_functions . "function_session.php");
	
	define("def_session_write_directory", "tmp");
	
	_set_session_name_("orderid");
	_set_session_save_path_(def_session_write_directory);
	
	if(function_exists("session_set_cookie_params")){
		session_set_cookie_params(0, def_http_cookie_path, def_http_cookie_domain);
	}elseif(function_exists("ini_set")){
		ini_set("session.cookie_lifetime", "0");
		ini_set("session.cookie_path", def_http_cookie_path);
		ini_set("session.cookie_domain", def_http_cookie_domain);
	}
	
	if(isset($HTTP_POST_VARS[_set_session_name_()])) {
		_set_session_id_($HTTP_POST_VARS[_set_session_name_()]);
	}elseif(isset($HTTP_GET_VARS[_set_session_name_()]) ) {
		_set_session_id_($HTTP_GET_VARS[_set_session_name_()]);
	}
	
	_set_session_start_();
	
	if(function_exists("ini_get") && (ini_get("register_globals") == false)){
		extract($_SESSION, EXTR_OVERWRITE + EXTR_REFS);
	}
?>