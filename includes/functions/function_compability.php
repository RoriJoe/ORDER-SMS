<?php
	function _do_magic_quotes_gpc_(&$var_array_value){
		if(!is_array($var_array_value)){
			return false;
		}
		
		reset($var_array_value);
		
		while(list($var_key, $var_value) = each($var_array_value)){
			if(is_array($var_array_value[$var_key])){
				_do_magic_quotes_gpc_($var_array_value[$var_key]);
			}else{
				$var_array_value[$var_key] = addslashes($var_value);
			}
		}
		
		reset($var_array_value);
	}

	$HTTP_GET_VARS =& $_GET;
	$HTTP_POST_VARS =& $_POST;
	$HTTP_COOKIE_VARS =& $_COOKIE;
	$HTTP_SESSION_VARS =& $_SESSION;
	$HTTP_POST_FILES =& $_FILES;
	$HTTP_SERVER_VARS =& $_SERVER;
	
	if(!get_magic_quotes_gpc()){
		_do_magic_quotes_gpc_($HTTP_GET_VARS);
		_do_magic_quotes_gpc_($HTTP_POST_VARS);
		_do_magic_quotes_gpc_($HTTP_COOKIE_VARS);
	}
?>