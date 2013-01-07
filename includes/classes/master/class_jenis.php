<?php
	class _class_jenis_{
		var $var_array_jenis;

		var $var_jenisid;
		var $var_nama;

		function _class_jenis_($var_jenisid = "", $var_nama = ""){
			$var_criteria = "";

			if(_is_not_null_($var_jenisid)){
				$var_criteria = "jenisid LIKE '%" . _set_input_string_($var_jenisid) . "%'";
			}

			if(_is_not_null_($var_nama)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "nama LIKE '%" . _set_input_string_($var_nama) . "%'";
			}
			
			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}

			$this->var_array_jenis = array();

			$var_query_link = _set_query_("SELECT * FROM " . def_table_jenis . $var_criteria);

			while($var_array_jenis = _set_fetch_array_($var_query_link)){
				$this->var_array_jenis[$var_array_jenis['jenisid']] = array('nama' => $var_array_jenis['nama']);
			}
		}

		function _is_primary_exist_($var_jenisid){
			if(!_is_not_null_($var_jenisid)){
				return false;
			}

			$var_query_link = _set_query_("SELECT jenisid FROM " . def_table_jenis . " WHERE jenisid='" . _set_input_string_($var_jenisid) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

		function _set_data_($var_jenisid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_jenis . " WHERE jenisid='" . _set_input_string_($var_jenisid) . "'");

			while($var_array_jenis = _set_fetch_array_($var_query_link)){
				$this->var_jenisid = $var_array_jenis['jenisid'];
				$this->var_nama = $var_array_jenis['nama'];
			}
		}

		function _save_data_($var_jenisid, $var_nama){
			if(!_is_not_null_($var_jenisid)){
				return false;
			}

			if(!_is_not_null_($var_nama)){
				return false;
			}
			
			if($this->_is_primary_exist_($var_jenisid)){
				return _set_query_("UPDATE " . def_table_jenis . " SET nama='" . _set_input_string_($var_nama) . "' WHERE jenisid='" . _set_input_string_($var_jenisid) . "'");
			}else{
            	return _set_query_("INSERT INTO " . def_table_jenis . " VALUES ('" . _set_input_string_($var_jenisid) . "', '" . _set_input_string_($var_nama) . "')");
            }
		}
        
		function _delete_data_($var_jenisid){
			if(!_is_not_null_($var_jenisid)){
				return false;
			}

			if($this->_is_primary_exist_($var_jenisid)){
				_set_query_("DELETE FROM " . def_table_jenis . " WHERE jenisid='" . _set_input_string_($var_jenisid) . "'");

                $var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE jenisid='" . _set_input_string_($var_jenisid) . "'");

                while($var_array_menu = _set_fetch_array_($var_query_link)){
                    _set_query_("DELETE FROM " . def_table_pesan_detil . " WHERE menuid='" . _set_input_string_($var_array_menu['menuid']) . "'");
                    _set_query_("DELETE FROM " . def_table_keranjang . " WHERE menuid='" . _set_input_string_($var_array_menu['menuid']) . "'");
                    _set_query_("DELETE FROM " . def_table_daftarharga . " WHERE menuid='" . _set_input_string_($var_array_menu['menuid']) . "'");
                }

                _set_query_("DELETE FROM " . def_table_menu . " WHERE jenisid='" . _set_input_string_($var_jenisid) . "'");
			}else{
				return false;
			}
		}

		function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_jenis);

			$var_array_jenis = array();

            $var_array_jenis[] = array('id' => '', 'text' => 'Silahkan Pilih');

			while(list($var_key, $var_value) = each($this->var_array_jenis)){
				$var_array_jenis[] = array('id' => $var_key, 'text' => $var_value['nama']);
			}

			return _set_pulldown_db_($var_pulldown_id, $var_array_jenis, $var_default, $var_parameter, $var_reinsert_value);
		}
	}
?>