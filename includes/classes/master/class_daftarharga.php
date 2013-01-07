<?php
	class _class_daftarharga_{
		var $var_array_daftarharga;
        
		var $var_kode;
        var $var_menuid;
		var $var_tanggal;
        var $var_harga;

		function _class_daftarharga_($var_menuid = "", $var_daritanggal = "", $var_sampaitanggal = ""){
			$var_criteria = "";

			if(_is_not_null_($var_menuid)){
				$var_criteria = "menuid = '" . _set_input_string_($var_menuid) . "'";
			}

			if(!_is_not_null_($var_daritanggal)){
                $var_daritanggal = "(DATE(NOW()))";
            }
            if(!_is_not_null_($var_sampaitanggal)){
                $var_sampaitanggal = "(DATE(NOW()))";
            }
            if(_is_not_null_($var_criteria)){
                $var_criteria .= " AND ";
            }

            if($var_daritanggal == "(DATE(NOW()))"){
                $var_criteria .= "tanggal >= " . _set_input_string_($var_daritanggal);
            }else{
                $var_criteria .= "tanggal >= '" . _set_input_string_($var_daritanggal) . "'";
            }

            if($var_sampaitanggal == "(DATE(NOW()))"){
                $var_criteria .= " AND tanggal <= " . _set_input_string_($var_sampaitanggal);
            }else{
                $var_criteria .= " AND tanggal <= '" . _set_input_string_($var_sampaitanggal) . "'";
            }

			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}

			$this->var_array_daftarharga = array();
            
			$var_query_link = _set_query_("SELECT * FROM " . def_table_daftarharga . $var_criteria);

			while($var_array_daftarharga = _set_fetch_array_($var_query_link)){
				$this->var_array_daftarharga[$var_array_daftarharga['kode']] = array('menuid' => $var_array_daftarharga['menuid'],
                                                                                    'tanggal' => $var_array_daftarharga['tanggal'],
                                                                                    'harga' => $var_array_daftarharga['harga']);
			}
		}

		function _is_primary_exist_($var_menuid, $var_tanggal){
			if(!_is_not_null_($var_menuid)){
				return false;
			}

            if(!_is_not_null_($var_tanggal)){
				return false;
			}else{
                if($var_tanggal == "NOW()"){
                    date_default_timezone_set('Asia/Krasnoyarsk');
                    $var_tanggal = date("Y-m-d");
                }
            }

            $var_kode = _set_padding_($var_menuid, 3) .  $var_tanggal;

			$var_query_link = _set_query_("SELECT kode FROM " . def_table_daftarharga . " WHERE kode='" . _set_input_string_($var_kode) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

        function _is_primary_exist2_($var_kode){
			if(!_is_not_null_($var_kode)){
				return false;
			}

			$var_query_link = _set_query_("SELECT kode FROM " . def_table_daftarharga . " WHERE kode='" . _set_input_string_($var_kode) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

		function _set_data_($var_kode){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_daftarharga . " WHERE kode='" . _set_input_string_($var_kode) . "'");

			while($var_array_daftarharga = _set_fetch_array_($var_query_link)){
				$this->var_kode = $var_array_daftarharga['kode'];
				$this->var_menuid = $var_array_daftarharga['menuid'];
                $this->var_tanggal = $var_array_daftarharga['tanggal'];
                $this->var_harga = $var_array_daftarharga['harga'];
			}
		}

		function _save_data_($var_menuid, $var_tanggal, $var_harga){
			if(!_is_not_null_($var_menuid)){
				return false;
			}

			if(!_is_not_null_($var_tanggal)){
				return false;
			}else{
                if($var_tanggal == "NOW()"){
                    date_default_timezone_set('Asia/Krasnoyarsk');
                    $var_tanggal = date("Y-m-d");
                }
            }

            $var_kode = _set_padding_($var_menuid, 3) . $var_tanggal;

			if($this->_is_primary_exist2_($var_kode)){
				return _set_query_("UPDATE " . def_table_daftarharga . " SET harga=" . _set_input_string_($var_harga) . " WHERE kode='" . _set_input_string_($var_kode) . "'");
			}else{
                return _set_query_("INSERT INTO " . def_table_daftarharga . " VALUES ('" . _set_input_string_($var_kode) . "', '" . _set_input_string_($var_menuid) . "', '" . _set_input_string_($var_tanggal) . "', " . _set_input_string_($var_harga) . ")");
            }
		}

        function _save_data2_($var_kode, $var_harga){
			if(!_is_not_null_($var_kode)){
				return false;
			}
            
			if($this->_is_primary_exist2_($var_kode)){
				return _set_query_("UPDATE " . def_table_daftarharga . " SET harga=" . _set_input_string_($var_harga) . " WHERE kode='" . _set_input_string_($var_kode) . "'");
			}
		}

		function _delete_data_($var_kode){
			if(!_is_not_null_($var_kode)){
				return false;
			}

			if($this->_is_primary_exist2_($var_kode)){
				return _set_query_("DELETE FROM " . def_table_daftarharga . " WHERE kode='" . _set_input_string_($var_kode) . "'");
			}else{
				return false;
			}
		}

        function _delete_data2_($var_menuid){
			if(!_is_not_null_($var_menuid)){
				return false;
			}

			return _set_query_("DELETE FROM " . def_table_daftarharga . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");
		}

		function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_daftarharga);

			$var_array_daftarharga = array();

			while(list($var_key, $var_value) = each($this->var_array_daftarharga)){
				$var_array_daftarharga[] = array('id' => $var_key, 'text' => $var_value['tanggal'] . ' - ' . $var_value['harga']);
			}

			return _set_pulldown_db_($var_pulldown_id, $var_array_daftarharga, $var_default, $var_parameter, $var_reinsert_value);
		}
	}
?>