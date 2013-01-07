<?php
	class _class_menu_{
		var $var_array_menu;

		var $var_menuid;
		var $var_nama;
		var $var_kodemenu;
        var $var_restoranid;
        var $var_jenisid;
        var $var_activeyn;
        var $var_keterangan;
        var $var_harga;

		function _class_menu_($var_menuid = "", $var_nama = "", $var_restoranid = "", $var_jenisid = "", $var_activeyn = ""){
			$var_criteria = "";

			if(_is_not_null_($var_menuid)){
				$var_criteria = "menuid LIKE '%" . _set_input_string_($var_menuid) . "%'";
			}

			if(_is_not_null_($var_nama)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "nama LIKE '%" . _set_input_string_($var_nama) . "%'";
			}

			if(_is_not_null_($var_restoranid)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "restoranid = '" . _set_input_string_($var_restoranid) . "'";
			}
			
			if(_is_not_null_($var_jenisid)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "jenisid = '" . _set_input_string_($var_jenisid) . "'";
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

			$this->var_array_menu = array();
            
			$var_query_link = _set_query_("SELECT * FROM " . def_table_menu . $var_criteria);
            
			while($var_array_menu = _set_fetch_array_($var_query_link)){
				$this->var_array_menu[$var_array_menu['menuid']] = array('nama' => $var_array_menu['nama'],
																				'kodemenu' => $var_array_menu['kodemenu'],
																				'restoranid' => $var_array_menu['restoranid'],
																				'jenisid' => $var_array_menu['jenisid'],
                                                                                'activeyn' => $var_array_menu['activeyn'],
                                                                                'keterangan' => $var_array_menu['keterangan'],
                                                                                'harga' => $this->_set_harga_($var_array_menu['menuid']));
			}
		}

		function _is_primary_exist_($var_menuid){
			if(!_is_not_null_($var_menuid)){
				return false;
			}

			$var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

        function _is_kodemenu_exist_($var_kodemenu){
            if(!_is_not_null_($var_kodemenu)){
				return false;
			}

			$var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE kodemenu='" . _set_input_string_($var_kodemenu) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
        }

        function _is_kodemenu_exist2_($var_kodemenu){
            if(!_is_not_null_($var_kodemenu)){
				return false;
			}

			$var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE kodemenu='" . _set_input_string_($var_kodemenu) . "'");

			if(_get_num_rows_($var_query_link) > 1){
				return true;
			}else{
				return false;
			}
        }

		function _set_data_($var_menuid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_menu . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");

			while($var_array_menu = _set_fetch_array_($var_query_link)){
				$this->var_menuid = $var_array_menu['menuid'];
				$this->var_nama = $var_array_menu['nama'];
				$this->var_kodemenu = $var_array_menu['kodemenu'];
				$this->var_restoranid = $var_array_menu['restoranid'];
                $this->var_jenisid = $var_array_menu['jenisid'];
                $this->var_activeyn = $var_array_menu['activeyn'];
                $this->var_keterangan = $var_array_menu['keterangan'];
                $this->var_harga = $this->_set_harga_($var_array_menu['menuid']);
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

		function _save_data_($var_menuid, $var_nama, $var_kodemenu, $var_restoranid, $var_jenisid, $var_activeyn, $var_keterangan){
			if(!_is_not_null_($var_menuid)){
				return false;
			}

			if(!_is_not_null_($var_nama)){
				return false;
			}

			if(!_is_not_null_($var_kodemenu)){
				return false;
			}

            if(!_is_not_null_($var_activeyn)){
                $var_activeyn = def_no;
            }

            if($this->_is_primary_exist_($var_menuid)){
                return _set_query_("UPDATE " . def_table_menu . " SET nama='" . _set_input_string_($var_nama) . "', kodemenu='" . _set_input_string_($var_kodemenu) . "', restoranid='" . _set_input_string_($var_restoranid) . "', jenisid='" . _set_input_string_($var_jenisid) . "', activeyn='" . _set_input_string_($var_activeyn) . "', keterangan='" . _set_input_string_($var_keterangan) . "' WHERE menuid='" . _set_input_string_($var_menuid) . "'");
            }else{
                return _set_query_("INSERT INTO " . def_table_menu . " VALUES ('" . _set_input_string_($var_menuid) . "', '" . _set_input_string_($var_nama) . "', '" . _set_input_string_($var_kodemenu) . "', '" . _set_input_string_($var_restoranid) . "', '" . _set_input_string_($var_jenisid) . "', '" . _set_input_string_($var_activeyn) . "', '" . _set_input_string_($var_keterangan) . "')");
            }
		}
        
		function _delete_data_($var_menuid){
			if(!_is_not_null_($var_menuid)){
				return false;
			}

			if($this->_is_primary_exist_($var_menuid)){
				_set_query_("DELETE FROM " . def_table_menu . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");
                _set_query_("DELETE FROM " . def_table_pesan_detil . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");
                _set_query_("DELETE FROM " . def_table_keranjang . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");
                _set_query_("DELETE FROM " . def_table_daftarharga . " WHERE menuid='" . _set_input_string_($var_menuid) . "'");
			}else{
				return false;
			}
		}

		function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_menu);

			$var_array_menu = array();

            $var_array_menu[] = array('id' => '', 'text' => 'Silahkan Pilih');

			while(list($var_key, $var_value) = each($this->var_array_menu)){
                if($var_value['activeyn'] == def_yes){
                    $var_array_menu[] = array('id' => $var_key, 'text' => $var_value['nama']);
                }
			}

			return _set_pulldown_db_($var_pulldown_id, $var_array_menu, $var_default, $var_parameter, $var_reinsert_value);
		}

        function _set_increment_id_(){
			$var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu);

			if(_get_num_rows_($var_query_link) > 0){
				$var_hole = 0;

				for($var_counter=1; $var_counter <= _get_num_rows_($var_query_link); $var_counter++){
					$var_check_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE menuid='" . _set_input_string_(_set_padding_($var_counter, 3, "0", false)) . "'");

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