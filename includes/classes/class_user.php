<?php
	class _class_user_{
		var $var_userid;
		var $var_username;
		
		function _class_user_(){
		}
		
		function _set_login_($var_userid){
			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT userid FROM " . def_table_login . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
				return _set_query_("UPDATE " . def_table_login . " SET logindate=NOW(), userip='" . $_SERVER['REMOTE_ADDR'] . "'");
			}else{
				return _set_query_("INSERT INTO " . def_table_login . " VALUES ('" . _set_input_string_($var_userid) . "', NOW(), '" . $_SERVER['REMOTE_ADDR'] . "')");
			}
		}
		
		function _set_data_($var_userid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			while($var_array_user = _set_fetch_array_($var_query_link)){
				$this->var_userid = $var_array_user['userid'];
				$this->var_username = $var_array_user['username'];
			}
		}
		
		function _is_user_exist_($var_userid, $var_userpwd = ""){
			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT userid, userpwd FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
				if(_is_not_null_($var_userpwd)){
					$var_array_user = _set_fetch_array_($var_query_link);
					
					if($var_array_user["userpwd"] == md5($var_userpwd)){
						return true;
					}else{
						return false;
					}
				}else{
					return true;
				}
			}else{
				return false;
			}
		}
		
		function _is_active_($var_userid){
			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT activeyn FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
				$var_array_user = _set_fetch_array_($var_query_link);
				
				if($var_array_user["activeyn"] == def_yes){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		function _is_status_($var_userid){
			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT statusyn FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
				$var_array_user = _set_fetch_array_($var_query_link);
				
				if($var_array_user["statusyn"] == def_yes){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		function _is_admin_($var_userid){
			if(_is_not_null_($var_userid)){
				if($var_userid == def_administrator){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
?>