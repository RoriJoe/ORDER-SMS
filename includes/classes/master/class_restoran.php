<?php
	class _class_restoran_{
		var $var_array_restoran;

		var $var_restoranid;
		var $var_nama;
		var $var_buka;
        var $var_tutup;
        var $var_activeyn;
        var $var_handphone;

		function _class_restoran_($var_restoranid = "", $var_nama = "", $var_activeyn = ""){
			$var_criteria = "";

			if(_is_not_null_($var_restoranid)){
				$var_criteria = "restoranid LIKE '%" . _set_input_string_($var_restoranid) . "%'";
			}

			if(_is_not_null_($var_nama)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "nama LIKE '%" . _set_input_string_($var_nama) . "%'";
			}

			if(!_is_not_null_($var_activeyn)){
                $var_activeyn = def_no;
            }

            if(_is_not_null_($var_criteria)){
				$var_criteria .= " AND ";
			}

			$var_criteria .= "activeyn = '" . _set_input_string_($var_activeyn) . "'";

			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}

			$this->var_array_restoran = array();

			$var_query_link = _set_query_("SELECT * FROM " . def_table_restoran . $var_criteria);

			while($var_array_restoran = _set_fetch_array_($var_query_link)){
				$this->var_array_restoran[$var_array_restoran['restoranid']] = array('nama' => $var_array_restoran['nama'],
																				'buka' => $var_array_restoran['buka'],
																				'tutup' => $var_array_restoran['tutup'],
																				'activeyn' => $var_array_restoran['activeyn'],
                                                                                'handphone' => $var_array_restoran['handphone']);
			}
		}

		function _is_primary_exist_($var_restoranid){
			if(!_is_not_null_($var_restoranid)){
				return false;
			}

			$var_query_link = _set_query_("SELECT restoranid FROM " . def_table_restoran . " WHERE restoranid='" . _set_input_string_($var_restoranid) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

		function _set_data_($var_restoranid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_restoran . " WHERE restoranid='" . _set_input_string_($var_restoranid) . "'");

			while($var_array_restoran = _set_fetch_array_($var_query_link)){
				$this->var_restoranid = $var_array_restoran['restoranid'];
				$this->var_nama = $var_array_restoran['nama'];
				$this->var_buka = $var_array_restoran['buka'];
				$this->var_tutup = $var_array_restoran['tutup'];
                $this->var_activeyn = $var_array_restoran['activeyn'];
                $this->var_handphone = $var_array_restoran['handphone'];
			}
		}

		function _save_data_($var_restoranid, $var_nama, $var_buka, $var_tutup, $var_activeyn, $var_handphone){
			if(!_is_not_null_($var_restoranid)){
				return false;
			}

			if(!_is_not_null_($var_nama)){
				return false;
			}

			if(!_is_not_null_($var_buka)){
				return false;
			}

            if(!_is_not_null_($var_tutup)){
				return false;
			}

            if(!_is_not_null_($var_activeyn)){
				$var_activeyn = def_no;
			}

            if($this->_is_primary_exist_($var_restoranid)){
                return _set_query_("UPDATE " . def_table_restoran . " SET nama='" . _set_input_string_($var_nama) . "', buka='" . _set_input_string_($var_buka) . "', tutup='" . _set_input_string_($var_tutup) . "', activeyn='" . _set_input_string_($var_activeyn) . "', handphone='" . _set_input_string_($var_handphone) . "' WHERE restoranid='" . _set_input_string_($var_restoranid) . "'");
            }else{
                return _set_query_("INSERT INTO " . def_table_restoran . " VALUES ('" . _set_input_string_($var_restoranid) . "', '" . _set_input_string_($var_nama) . "', '" . _set_input_string_($var_buka) . "', '" . _set_input_string_($var_tutup) . "', '" . _set_input_string_($var_activeyn) . "', '" . _set_input_string_($var_handphone) . "')");
            }
		}
        
		function _delete_data_($var_restoranid){
			if(!_is_not_null_($var_restoranid)){
				return false;
			}

			if($this->_is_primary_exist_($var_restoranid)){
				_set_query_("DELETE FROM " . def_table_restoran . " WHERE restoranid='" . _set_input_string_($var_restoranid) . "'");

                $var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE restoranid='" . _set_input_string_($var_restoranid) . "'");

                while($var_array_menu = _set_fetch_array_($var_query_link)){
                    _set_query_("DELETE FROM " . def_table_pesan_detil . " WHERE menuid='" . _set_input_string_($var_array_menu['menuid']) . "'");
                    _set_query_("DELETE FROM " . def_table_keranjang . " WHERE menuid='" . _set_input_string_($var_array_menu['menuid']) . "'");
                    _set_query_("DELETE FROM " . def_table_daftarharga . " WHERE menuid='" . _set_input_string_($var_array_menu['menuid']) . "'");
                }

                _set_query_("DELETE FROM " . def_table_menu . " WHERE restoranid='" . _set_input_string_($var_restoranid) . "'");
			}else{
				return false;
			}
		}

		function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_restoran);

			$var_array_restoran = array();

            $var_array_restoran[] = array('id' => '', 'text' => 'Silahkan Pilih');

			while(list($var_key, $var_value) = each($this->var_array_restoran)){
				$var_array_restoran[] = array('id' => $var_key, 'text' => $var_value['nama']);
			}

			return _set_pulldown_db_($var_pulldown_id, $var_array_restoran, $var_default, $var_parameter, $var_reinsert_value);
		}

        function _set_increment_id_(){
			$var_query_link = _set_query_("SELECT restoranid FROM " . def_table_restoran);

			if(_get_num_rows_($var_query_link) > 0){
				$var_hole = 0;

				for($var_counter=1; $var_counter <= _get_num_rows_($var_query_link); $var_counter++){
					$var_check_link = _set_query_("SELECT restoranid FROM " . def_table_restoran . " WHERE restoranid='" . _set_input_string_(_set_padding_($var_counter, 3, "0", false)) . "'");

					if(_get_num_rows_($var_check_link) <= 0){
						$var_hole = $var_counter;

						break;
					}
				}

				if($var_hole == 0){
					$var_hole = _get_num_rows_($var_query_link) + 1;
				}

				return _set_padding_($var_hole, 3, "0", false);
			}else{
				return _set_padding_("1", 3, "0", false);
			}
		}
	}
?>