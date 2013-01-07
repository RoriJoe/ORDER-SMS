<?php
	class _class_keranjang_{
		var $var_contents;
		var $var_total;
		var $var_cartid;
		
		function _class_keranjang_(){
			$this->_reset_();
		}
		
		function _reset_($var_reset = false){
			global $session_userid;
			
			$this->var_contents = array();
			$this->var_total = 0;
			
			if(_is_session_registered_('session_userid') && ($var_reset == true)){
				_set_query_("DELETE FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "'");
			}
			
			unset($this->var_cartid);
		}
		
		function _restore_contents_(){
			global $session_userid;
			
			if(!_is_session_registered_("session_userid")){
				return false;
			}
			
			if(is_array($this->var_contents)){
				reset($this->var_contents);
				
				while(list($var_menuid,) = each($this->var_contents)){
					$var_qty = $this->var_contents[$var_menuid]['qty'];
					
					$var_query_link = _set_query_("SELECT menuid FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
					
					if(_get_num_rows_($var_query_link) > 0){
						_set_query_("UPDATE " . def_table_keranjang . " qty=" . _set_input_string_($var_qty) . " WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
					}else{
						_set_query_("INSERT INTO " . def_table_keranjang . " VALUES('', '" . _set_input_string_($session_userid) . "', '" . _set_input_string_($var_menuid) . "', " . _set_input_string_($var_qty) . ", NOW()");
					}
				}
			}
			
			$this->_reset_(false);
			
			$var_query_link = _set_query_("SELECT menuid, qty, tanggal FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "'");
			
			while($var_menu = _set_fetch_array_($var_query_link)){
				$this->var_contents[$var_menu['menuid']] = array('qty' => (int)$var_menu['qty'],
                                                                 'tanggal' => $var_menu['tanggal']);
			}
		}
		
		function _add_cart_($var_menuid, $var_qty = 1){
			global $session_userid;
			
			if((int)$var_qty > def_max_qty){
				$var_qty = def_max_qty;
			}
			
			$var_query_link = _set_query_("SELECT activeyn FROM " . def_table_menu . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");
			
			if(_get_num_rows_($var_query_link)){
				$var_menu = _set_fetch_array_($var_query_link);
				
				if($var_menu['activeyn'] == def_yes){
					if($this->_is_incart_($var_menuid)){
						$this->_update_qty_($var_menuid, $var_qty);
					}else{
						$this->var_contents[$var_menuid] = array('qty' => (int)$var_qty);
						
						if(_is_session_registered_('session_userid')){
							_set_query_("INSERT INTO " . def_table_keranjang . " VALUES('', '" . _set_input_string_($session_userid) . "', '" . _set_input_string_($var_menuid) . "', " . _set_input_string_($var_qty) . ", NOW())");
						}
					}
				}
			}
			
			$this->var_cartid = $this->_generate_cartid_();
		}
		
		function _update_qty_($var_menuid, $var_qty){
			global $session_userid;
			
			if(_is_session_registered_("session_userid")){
                $var_prev_qty = (int)_set_field_value(def_table_keranjang, "qty", "userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
                
                _set_query_("UPDATE " . def_table_keranjang . " SET qty=" . ($var_prev_qty + $var_qty) . ", tanggal=NOW() WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
            }
		}

        function _update_qty2_($var_menuid, $var_qty){
            global $session_userid;

			if(_is_session_registered_("session_userid")){
                _set_query_("UPDATE " . def_table_keranjang . " SET qty=" . $var_qty . ", tanggal=NOW() WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
            }
        }

        function _remove_($var_menuid){
            global $session_userid;
            
            unset($this->var_contents[$var_menuid]);
            
            if(_is_session_registered_('session_userid')){
                _set_query_("DELETE FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
            }
            
            $this->var_cartid = $this->_generate_cartid_();
        }
		
		function _is_incart_($var_menuid){
            global $session_userid;
            
            $var_query_link = _set_query_("SELECT nokeranjang FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
            
            if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}
		
		function _cleanup_(){
			global $session_userid;
			
			if(_is_session_registered_('session_userid')){
                _set_query_("DELETE FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "'");
            }
		}

        function _calculate_($var_menuid){
            global $session_userid;

            $this->var_total = 0;

			if(!_is_session_registered_("session_userid")){
				return 0;
			}

            if(_is_not_null_($var_menuid)){
                $var_query_link = _set_query_("SELECT menuid, qty FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
            }else{
                $var_query_link = _set_query_("SELECT menuid, qty FROM " . def_table_keranjang . " WHERE userid='" . _set_input_string_($session_userid) . "'");
            }

            while($var_menu = _set_fetch_array_($var_query_link)){
                $this->var_total += ((int)$var_menu['qty'] * _set_double_($this->_set_harga_($var_menu['menuid']), 0));
            }
        }

        function _set_harga_($var_menuid){
            $var_query_link = _set_query_("SELECT * FROM " . def_table_daftarharga . " WHERE menuid='" . _set_input_string_($var_menuid) . "' ORDER BY tanggal DESC");

            if(_get_num_rows_($var_query_link) > 0){
                $var_array_daftarharga = _set_fetch_array_($var_query_link);

                return _set_double_($var_array_daftarharga['harga'], 0);
            }else{
                return 0;
            }
        }
		
		function _generate_cartid_($var_length = 5){
            return _set_random_value_($var_length);
		}
	}
?>