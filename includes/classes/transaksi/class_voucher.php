<?php
	class _class_voucher_{
		var $var_array_voucher;

		var $var_voucherid;
		var $var_userid;
        var $var_tanggal;
        var $var_jumlah;
        var $var_keterangan;

		function _class_voucher_($var_voucherid = "", $var_userid = "", $var_daritanggal = "", $var_sampaitanggal = ""){
			$var_criteria = "";

            if(_is_not_null_($var_voucherid)){
				$var_criteria = "voucherid LIKE '%" . _set_input_string_($var_voucherid) . "%'";
			}

			if(_is_not_null_($var_userid)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "userid = '" . _set_input_string_($var_userid) . "'";
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

			$this->var_array_voucher = array();
            
			$var_query_link = _set_query_("SELECT * FROM " . def_table_voucher . $var_criteria);
            
			while($var_array_voucher = _set_fetch_array_($var_query_link)){
				$this->var_array_voucher[$var_array_voucher['voucherid']] = array('userid' => $var_array_voucher['userid'],
                                                                                   'tanggal' => $var_array_voucher['tanggal'],
                                                                                    'jumlah' => $var_array_voucher['jumlah'],
                                                                                    'keterangan' => $var_array_voucher['keterangan']);
			}
		}

		function _is_primary_exist_($var_voucherid){
			if(!_is_not_null_($var_voucherid)){
				return false;
			}

			$var_query_link = _set_query_("SELECT voucherid FROM " . def_table_voucher . " WHERE voucherid='" . _set_input_string_($var_voucherid) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

		function _set_data_($var_voucherid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_voucher . " WHERE voucherid='" . _set_input_string_($var_voucherid) . "'");

			while($var_array_voucher = _set_fetch_array_($var_query_link)){
				$this->var_voucherid = $var_array_voucher['voucherid'];
				$this->var_userid = $var_array_voucher['userid'];
                $this->var_tanggal = $var_array_voucher['tanggal'];
                $this->var_jumlah = $var_array_voucher['jumlah'];
                $this->var_keterangan = $var_array_voucher['keterangan'];
			}
		}

        function _get_voucher_($var_userid){
            if(!_is_not_null_($var_userid)){
                return 0;
            }

            $var_query_link = _set_query_("SELECT jumlah FROM " . def_table_voucher . " WHERE userid='" . _set_input_string_($var_userid) . "'");

            $var_jumlah = 0;

			while($var_array_voucher = _set_fetch_array_($var_query_link)){
                $var_jumlah += _set_double_($var_array_voucher['jumlah'], 0);
			}

            $var_query_link = _set_query_("SELECT jumlah FROM " . def_table_output . " WHERE userid='" . _set_input_string_($var_userid) . "'");

            while($var_array_output = _set_fetch_array_($var_query_link)){
                $var_jumlah -= _set_double_($var_array_output['jumlah'], 0);
			}

            return $var_jumlah;
        }

        function _decrement_voucher_($var_userid, $var_jumlah){
            if(!_is_not_null_($var_userid)){
				return false;
			}

            $var_outputid = $this->_set_increment_output_id_($var_userid);

            return _set_query_("INSERT INTO " . def_table_output . " VALUES ('" . _set_input_string_($var_outputid) . "', '" . _set_input_string_($var_userid) . "', NOW(), " . _set_input_string_($var_jumlah) . ", '')");
        }

		function _save_data_($var_voucherid, $var_userid, $var_jumlah, $var_keterangan){
			if(!_is_not_null_($var_voucherid)){
				return false;
			}

			if(!_is_not_null_($var_userid)){
				return false;
			}
			
			if($this->_is_primary_exist_($var_voucherid)){
                return _set_query_("UPDATE " . def_table_voucher . " SET jumlah=" . _set_input_string_($var_jumlah) . ", keterangan='" . _set_input_string_($var_keterangan) . "' WHERE voucherid='" . _set_input_string_($var_voucherid) . "'");
			}else{
                return _set_query_("INSERT INTO " . def_table_voucher . " VALUES ('" . _set_input_string_($var_voucherid) . "', '" . _set_input_string_($var_userid) . "', DATE(NOW()), " . _set_input_string_($var_jumlah) . ", '" . _set_input_string_($var_keterangan) . "')");
            }
		}
        
		function _delete_data_($var_voucherid){
			if(!_is_not_null_($var_voucherid)){
				return false;
			}

			if($this->_is_primary_exist_($var_voucherid)){
				return _set_query_("DELETE FROM " . def_table_voucher . " WHERE voucherid='" . _set_input_string_($var_voucherid) . "'");
			}else{
				return false;
			}
		}

		function _set_pulldown_($var_pulldown_id = "", $var_default = "", $var_parameter = "", $var_reinsert_value = true){
			reset($this->var_array_voucher);

			$var_array_voucher = array();

            $var_array_voucher[] = array('id' => '', 'text' => 'Silahkan Pilih');

			while(list($var_key, $var_value) = each($this->var_array_voucher)){
				$var_array_voucher[] = array('id' => $var_key, 'text' => $var_value['userid']);
			}

			return _set_pulldown_db_($var_pulldown_id, $var_array_voucher, $var_default, $var_parameter, $var_reinsert_value);
		}

        function _set_increment_id_(){
			$var_query_link = _set_query_("SELECT voucherid FROM " . def_table_voucher);

            date_default_timezone_set('Asia/Krasnoyarsk');
            
			if(_get_num_rows_($var_query_link) > 0){
				$var_hole = 0;

				for($var_counter=1; $var_counter <= _get_num_rows_($var_query_link); $var_counter++){
					$var_check_link = _set_query_("SELECT voucherid FROM " . def_table_voucher . " WHERE voucherid='" . _set_input_string_(date("dmY") . _set_padding_($var_counter, 3, "0", false)) . "'");

					if(_get_num_rows_($var_check_link) <= 0){
						$var_hole = $var_counter;

						break;
					}
				}

				if($var_hole == 0){
					$var_hole = _get_num_rows_($var_query_link) + 1;
				}

				return date("dmY") . _set_padding_($var_hole, 3, "0", false);
			}else{
				return date("dmY") . _set_padding_("1", 3, "0", false);
			}
		}

        function _set_increment_output_id_($var_userid){
			$var_query_link = _set_query_("SELECT outputid FROM " . def_table_output);

            date_default_timezone_set('Asia/Krasnoyarsk');

			if(_get_num_rows_($var_query_link) > 0){
				$var_hole = 0;

				for($var_counter=1; $var_counter <= _get_num_rows_($var_query_link); $var_counter++){
                    $var_check_link = _set_query_("SELECT outputid FROM " . def_table_output . " WHERE outputid='" . _set_input_string_(_set_padding_($var_userid, 15)) . _set_input_string_(date("dmY") . _set_padding_($var_counter, 2, "0", false)) . "'");

					if(_get_num_rows_($var_check_link) <= 0){
						$var_hole = $var_counter;

						break;
					}
				}

				if($var_hole == 0){
					$var_hole = _get_num_rows_($var_query_link) + 1;
				}

				return _set_input_string_(_set_padding_($var_userid, 15)) . date("dmY") . _set_padding_($var_hole, 2, "0", false);
			}else{
				return _set_input_string_(_set_padding_($var_userid, 15)) . date("dmY") . _set_padding_("1", 2, "0", false);
			}
		}
	}
?>