<?php
	class _class_pemakai_{
		var $var_array_pemakai;
		
		var $var_userid;
        var $var_username;
        var $var_statusyn;
        var $var_activeyn;
		var $var_email;
		var $var_address;
		var $var_handphone;
        var $var_phone;
        var $var_handphoneyn;
		
		function _class_pemakai_($var_userid = "", $var_username = "", $var_statusyn = "", $var_activeyn = "", $var_handphoneyn = ""){
			$var_criteria = "";
			
			if(_is_not_null_($var_userid)){
				$var_criteria = "userid LIKE '%" . _set_input_string_($var_userid) . "%'";
			}
			
			if(_is_not_null_($var_username)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}
				
				$var_criteria .= "username LIKE '%" . _set_input_string_($var_username) . "%'";
			}

            if(!_is_not_null_($var_statusyn)){
                $var_statusyn = def_no;
            }

            if(_is_not_null_($var_criteria)){
				$var_criteria .= " AND ";
			}

			$var_criteria .= "statusyn = '" . _set_input_string_($var_statusyn) . "'";

            if(!_is_not_null_($var_activeyn)){
                $var_activeyn = def_no;
            }

            if(_is_not_null_($var_criteria)){
				$var_criteria .= " AND ";
			}

			$var_criteria .= "activeyn = '" . _set_input_string_($var_activeyn) . "'";

            if($var_handphoneyn != "~"){
                if(!_is_not_null_($var_handphoneyn)){
                    $var_handphoneyn = def_no;
                }

                if(_is_not_null_($var_criteria)){
                    $var_criteria .= " AND ";
                }

                $var_criteria .= "handphoneyn = '" . _set_input_string_($var_handphoneyn) . "'";
            }
			
			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}
			
			$this->var_array_pemakai = array();
			
			$var_query_link = _set_query_("SELECT * FROM " . def_table_pemakai . $var_criteria);
			
			while($var_array_pemakai = _set_fetch_array_($var_query_link)){
				$this->var_array_pemakai[$var_array_pemakai['userid']] = array('username' => $var_array_pemakai['username'],
                                                                            'statusyn' => $var_array_pemakai['statusyn'],
                                                                            'activeyn' => $var_array_pemakai['activeyn'],
                                                                            'email' => $var_array_pemakai['email'],
																			'address' => $var_array_pemakai['address'],
																			'handphone' => $var_array_pemakai['handphone'],
                                                                            'phone' => $var_array_pemakai['phone'],
                                                                            'handphoneyn' => $var_array_pemakai['handphoneyn']);
			}
		}
		
		function _is_primary_exist_($var_userid){
			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			$var_query_link = _set_query_("SELECT userid FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

        function _is_exist2_($var_handphone){
			if(!_is_not_null_($var_handphone)){
				return false;
			}

            if($this->_is_primary_exist_($var_handphone)){
                return true;
            }
            
            $var_query_link = _set_query_("SELECT handphone FROM " . def_table_pemakai . " WHERE handphone='" . _set_input_string_($var_handphone) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}
		
		function _set_data_($var_userid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			
			if(_get_num_rows_($var_query_link) > 0){
                $var_array_pemakai = _set_fetch_array_($var_query_link);
                
				$this->var_userid = $var_array_pemakai['userid'];
				$this->var_username = $var_array_pemakai['username'];
                $this->var_statusyn = $var_array_pemakai['statusyn'];
                $this->var_activeyn = $var_array_pemakai['activeyn'];
                $this->var_email = $var_array_pemakai['email'];
				$this->var_address = $var_array_pemakai['address'];
				$this->var_handphone = $var_array_pemakai['handphone'];
                $this->var_phone = $var_array_pemakai['phone'];
                $this->var_handphoneyn = $var_array_pemakai['handphoneyn'];
			}else{
                $this->var_userid = "";
				$this->var_username = "";
                $this->var_statusyn = def_no;
                $this->var_activeyn = def_no;
                $this->var_email = "";
				$this->var_address = "";
				$this->var_handphone = "";
                $this->var_phone = "";
                $this->var_handphoneyn = def_no;
            }
		}

        function _set_data2_($var_handphone){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_pemakai . " WHERE handphone='" . _set_input_string_($var_handphone) . "'");

            if(_get_num_rows_($var_query_link) > 0){
                $var_array_pemakai = _set_fetch_array_($var_query_link);
                
				$this->var_userid = $var_array_pemakai['userid'];
				$this->var_username = $var_array_pemakai['username'];
                $this->var_statusyn = $var_array_pemakai['statusyn'];
                $this->var_activeyn = $var_array_pemakai['activeyn'];
                $this->var_email = $var_array_pemakai['email'];
				$this->var_address = $var_array_pemakai['address'];
				$this->var_handphone = $var_array_pemakai['handphone'];
                $this->var_phone = $var_array_pemakai['phone'];
                $this->var_handphoneyn = $var_array_pemakai['handphoneyn'];
			}else{
                $this->var_userid = "";
				$this->var_username = "";
                $this->var_statusyn = def_no;
                $this->var_activeyn = def_no;
                $this->var_email = "";
				$this->var_address = "";
				$this->var_handphone = "";
                $this->var_phone = "";
                $this->var_handphoneyn = def_no;
            }
		}
		
		function _save_data_($var_userid, $var_username, $var_userpwd, $var_statusyn, $var_activeyn, $var_email, $var_address, $var_handphone, $var_phone, $var_handphoneyn){
			if(!_is_not_null_($var_userid)){
				return false;
			}

            if(!_is_not_null_($var_statusyn)){
                $var_statusyn = def_no;
            }

            if(!_is_not_null_($var_activeyn)){
                $var_activeyn = def_no;
            }

            if(!_is_not_null_($var_handphoneyn)){
                $var_handphoneyn = def_no;
            }
			
			if($this->_is_primary_exist_($var_userid)){
				if(_is_not_null_($var_userpwd)){
                    return _set_query_("UPDATE " . def_table_pemakai . " SET userpwd='" . md5(_set_input_string_($var_userpwd)) . "', username='" . _set_input_string_($var_username) . "', statusyn='" . _set_input_string_($var_statusyn) . "', activeyn='" . _set_input_string_($var_activeyn) . "', address='" . _set_input_string_($var_address) . "', email='" . _set_input_string_($var_email) . "', handphone='" . _set_input_string_($var_handphone) . "', phone='" . _set_input_string_($var_phone) . "', handphoneyn='" . _set_input_string_($var_handphoneyn) . "' WHERE userid='" . _set_input_string_($var_userid) . "'");
				}else{
                    return _set_query_("UPDATE " . def_table_pemakai . " SET username='" . _set_input_string_($var_username) . "', statusyn='" . _set_input_string_($var_statusyn) . "', activeyn='" . _set_input_string_($var_activeyn) . "', address='" . _set_input_string_($var_address) . "', email='" . _set_input_string_($var_email) . "', handphone='" . _set_input_string_($var_handphone) . "', handphoneyn='" . _set_input_string_($var_handphoneyn) . "' WHERE userid='" . _set_input_string_($var_userid) . "'");
				}
			}else{
				return _set_query_("INSERT INTO " . def_table_pemakai . " VALUES ('" . _set_input_string_($var_userid) . "', '" . _set_input_string_($var_username) . "', '" . md5(_set_input_string_($var_userpwd)) . "', '" . _set_input_string_($var_statusyn) . "', '" . _set_input_string_($var_activeyn) . "', '" . _set_input_string_($var_email) . "', '" . _set_input_string_($var_address) . "', '" . _set_input_string_($var_handphone) . "', '" . _set_input_string_($var_phone) . "', '" . _set_input_string_($var_handphoneyn) . "')");
			}
		}

        function _save_data2_($var_userid, $var_username, $var_email, $var_address, $var_handphone, $var_phone){
			if(!_is_not_null_($var_userid)){
				return false;
			}

			if($this->_is_primary_exist_($var_userid)){
                return _set_query_("UPDATE " . def_table_pemakai . " SET username='" . _set_input_string_($var_username) . "', address='" . _set_input_string_($var_address) . "', email='" . _set_input_string_($var_email) . "', handphone='" . _set_input_string_($var_handphone) . "', phone='" . _set_input_string_($var_phone) . "' WHERE userid='" . _set_input_string_($var_userid) . "'");
            }
		}

        function _save_data3_($var_userid, $var_userpwd){
			if(!_is_not_null_($var_userid)){
				return false;
			}

			if($this->_is_primary_exist_($var_userid)){
                return _set_query_("UPDATE " . def_table_pemakai . " SET userpwd='" . md5(_set_input_string_($var_userpwd)) . "' WHERE userid='" . _set_input_string_($var_userid) . "'");
            }
		}
		
		function _delete_data_($var_userid){
			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			if($this->_is_primary_exist_($var_userid)){
				_set_query_("DELETE FROM " . def_table_pemakai . " WHERE userid='" . _set_input_string_($var_userid) . "'");
                _set_query_("DELETE FROM " . def_table_voucher . " WHERE userid='" . _set_input_string_($var_userid) . "'");

                $var_query_link = _set_query_("SELECT notransaksi FROM " . def_table_pesan_header . " WHERE userid='" . _set_input_string_($var_userid) . "'");

                while($var_array_pesan_header = _set_fetch_array_($var_query_link)){
                    _set_query_("DELETE FROM " . def_table_pesan_detil . " WHERE notransaksi='" . _set_input_string_($var_array_pesan_header['notransaksi']) . "'");
                }

                _set_query_("DELETE FROM " . def_table_pesan_header . " WHERE userid='" . _set_input_string_($var_userid) . "'");
                _set_query_("DELETE FROM " . def_table_output . " WHERE userid='" . _set_input_string_($var_userid) . "'");
                _set_query_("DELETE FROM " . def_table_login . " WHERE userid='" . _set_input_string_($var_userid) . "'");
                _set_query_("DELETE FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($var_userid) . "'");
			}else{
				return false;
			}
		}

        function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_admin = false, $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_pemakai);

			$var_array_pemakai = array();

            $var_array_pemakai[] = array('id' => '', 'text' => 'Silahkan Pilih');

			while(list($var_key, $var_value) = each($this->var_array_pemakai)){
                if($var_admin == true){
                    $var_array_pemakai[] = array('id' => $var_key, 'text' => $var_key . '-' . $var_value['username']);
                }else{
                    if($var_key != "administrator"){
                        $var_array_pemakai[] = array('id' => $var_key, 'text' => $var_key . '-' . $var_value['username']);
                    }
                }
			}

			return _set_pulldown_db_($var_pulldown_id, $var_array_pemakai, $var_default, $var_parameter, $var_reinsert_value);
		}
	}
?>