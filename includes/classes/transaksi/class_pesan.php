<?php
    class _class_pesan_{
        var $var_array_pesan;

        var $var_notransaksi;
        var $var_userid;
        var $var_tanggal;
        var $var_statusyn;
        var $var_alamat;
        var $var_keterangan;
        var $var_total;

        var $var_array_alamat = array(
"GDG1LT1",
"GDG1LT2",
"GDG1LT3",
"GDG1LT4",
"GDG1LT5",
"GDG2LT1",
"GDG2LT2",
"GDG2LT3",
"GDG2LT4",
"GDG2LT5",
"GDG3LT1",
"GDG3LT2",
"GDG3LT3",
"GDG3LT4",
"GDG3LT5",
"GDG4LT1",
"GDG4LT2",
"GDG4LT3",
"GDG4LT4",
"GDG4LT5",
"GDG5LT1",
"GDG5LT2",
"GDG5LT3",
"GDG5LT4",
"GDG5LT5");
        var $var_array_alamat2 = array(
"Gedung 1, Lantai 1",
"Gedung 1, Lantai 2",
"Gedung 1, Lantai 3",
"Gedung 1, Lantai 4",
"Gedung 1, Lantai 5",
"Gedung 2, Lantai 1",
"Gedung 2, Lantai 2",
"Gedung 2, Lantai 3",
"Gedung 2, Lantai 4",
"Gedung 2, Lantai 5",
"Gedung 3, Lantai 1",
"Gedung 3, Lantai 2",
"Gedung 3, Lantai 3",
"Gedung 3, Lantai 4",
"Gedung 3, Lantai 5",
"Gedung 4, Lantai 1",
"Gedung 4, Lantai 2",
"Gedung 4, Lantai 3",
"Gedung 4, Lantai 4",
"Gedung 4, Lantai 5",
"Gedung 5, Lantai 1",
"Gedung 5, Lantai 2",
"Gedung 5, Lantai 3",
"Gedung 5, Lantai 4",
"Gedung 5, Lantai 5");

        function _class_pesan_($var_notransaksi = "", $var_userid = "", $var_daritanggal = "", $var_sampaitanggal = ""){
			$var_criteria = "";

            if(_is_not_null_($var_notransaksi)){
				$var_criteria = "notransaksi LIKE '%" . _set_input_string_($var_notransaksi) . "%'";
			}

			if(_is_not_null_($var_userid)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "userid = '" . _set_input_string_($var_userid) . "'";
			}

			if(!_is_not_null_($var_daritanggal)){
                $var_daritanggal = "DATE(NOW())";
            }
            if(!_is_not_null_($var_sampaitanggal)){
                $var_sampaitanggal = "DATE(NOW())";
            }
            if(_is_not_null_($var_criteria)){
                $var_criteria .= " AND ";
            }

            if($var_daritanggal == "DATE(NOW())"){
                $var_criteria .= "tanggal >= " . _set_input_string_($var_daritanggal);
            }else{
                $var_criteria .= "tanggal >= '" . _set_input_string_($var_daritanggal) . "'";
            }

            if($var_sampaitanggal == "DATE(NOW())"){
                $var_criteria .= " AND tanggal <= " . _set_input_string_($var_sampaitanggal);
            }else{
                $var_criteria .= " AND tanggal <= '" . _set_input_string_($var_sampaitanggal) . "'";
            }

            if(_is_not_null_($var_criteria)){
                $var_criteria .= " AND ";
            }

            $var_criteria .= "statusyn = '" . def_no . "'";

			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}

			$this->var_array_pesan = array();

			$var_query_link = _set_query_("SELECT * FROM " . def_table_pesan_header . $var_criteria);
            
			while($var_array_pesan = _set_fetch_array_($var_query_link)){
				$this->var_array_pesan[$var_array_pesan['notransaksi']] = array('userid' => $var_array_pesan['userid'],
                                                                                   'tanggal' => $var_array_pesan['tanggal'],
                                                                                    'statusyn' => $var_array_pesan['statusyn'],
                                                                                    'alamat' => $var_array_pesan['alamat'],
                                                                                    'keterangan' => $var_array_pesan['keterangan']);
			}
		}

        function _is_primary_exist_header_($var_notransaksi){
			if(!_is_not_null_($var_notransaksi)){
				return false;
			}

			$var_query_link = _set_query_("SELECT notransaksi FROM " . def_table_pesan_header . " WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

        function _is_primary_exist_detil_($var_nodetil){
			if(!_is_not_null_($var_nodetil)){
				return false;
			}

			$var_query_link = _set_query_("SELECT nodetil FROM " . def_table_pesan_detil . " WHERE nodetil='" . _set_input_string_($var_nodetil) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

        function _save_data_header_($var_userid, $var_alamat){
            if(!_is_not_null_($var_userid)){
				return false;
			}

            date_default_timezone_set('Asia/Krasnoyarsk');
            $var_notransaksi = $this->_set_increment_id_();

            if($this->_is_primary_exist_header_($var_notransaksi)){
                _set_query_("UPDATE " . def_table_pesan_header . " SET tanggal=NOW(), alamat='" . _set_input_string_($var_alamat) . "' WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");
            }else{
                _set_query_("INSERT INTO " . def_table_pesan_header . " VALUES ('" . _set_input_string_($var_notransaksi) . "', '" . _set_input_string_($var_userid) . "', NOW(), '" . def_no . "', '" . _set_input_string_($var_alamat) . "', '')");
            }

            return $var_notransaksi;
        }

        function _confirm_data_header_($var_notransaksi, $var_keterangan){
            if(!_is_not_null_($var_notransaksi)){
				return false;
			}

            if($this->_is_primary_exist_header_($var_notransaksi)){
                _set_query_("UPDATE " . def_table_pesan_header . " SET statusyn='" . def_yes . "', keterangan='" . _set_input_string_($var_keterangan) . "' WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");
            }
        }

        function _save_data_detil_($var_notransaksi, $var_menuid, $var_qty){
            if(!_is_not_null_($var_notransaksi)){
				return false;
			}

            if(!_is_not_null_($var_menuid)){
				return false;
			}

            $var_nodetil = _set_padding_($var_notransaksi, 10) . _set_padding_($var_menuid, 3);

            if($this->_is_primary_exist_detil_($var_nodetil)){
                _set_query_("UPDATE " . def_table_pesan_detil . " SET qty=" . _set_input_string_($var_qty) . " WHERE nodetil='" . _set_input_string_($var_nodetil) . "'");
            }else{
                _set_query_("INSERT INTO " . def_table_pesan_detil . " VALUES ('" . _set_input_string_($var_nodetil) . "', '" . _set_input_string_($var_menuid) . "', '" . _set_input_string_($var_notransaksi) . "' , " . _set_input_string_($var_qty) . ")");
            }
        }

        function _save_data_detil2_($var_notransaksi, $var_value){
            if(!_is_not_null_($var_notransaksi)){
				return false;
			}

            if(!_is_not_null_($var_value)){
				return false;
			}

            $var_array_value = _set_parse_(trim($var_value), ",");

            if(count($var_array_value) > 1){
                for($var_counter=0; $var_counter<count($var_array_value); $var_counter++){
                    $var_array_pesan = _set_parse_(trim($var_array_value[$var_counter]), ' ');

                    $this->_save_data_detil_($var_notransaksi, _set_field_value(def_table_menu, "menuid", "kodemenu='" . _set_input_string_($var_array_pesan[0]) . "'"), (int)$var_array_pesan[1]);
                }
            }else{
                $var_array_pesan = _set_parse_(trim($var_array_value[$var_counter]), ' ');

                $this->_save_data_detil_($var_notransaksi, _set_field_value(def_table_menu, "menuid", "kodemenu='" . _set_input_string_($var_array_pesan[0]) . "'"), (int)$var_array_pesan[1]);
            }
        }

        function _set_increment_id_(){
			$var_query_link = _set_query_("SELECT notransaksi FROM " . def_table_pesan_header);

            date_default_timezone_set('Asia/Krasnoyarsk');

			if(_get_num_rows_($var_query_link) > 0){
				$var_hole = 0;

				for($var_counter=1; $var_counter <= _get_num_rows_($var_query_link); $var_counter++){
					$var_check_link = _set_query_("SELECT notransaksi FROM " . def_table_pesan_header . " WHERE notransaksi='" . _set_input_string_(date("dmY") . _set_padding_($var_counter, 2, "0", false)) . "'");

					if(_get_num_rows_($var_check_link) <= 0){
						$var_hole = $var_counter;

						break;
					}
				}

				if($var_hole == 0){
					$var_hole = _get_num_rows_($var_query_link) + 1;
				}

				return date("dmY") . _set_padding_($var_hole, 2, "0", false);
			}else{
				return date("dmY") . _set_padding_("1", 2, "0", false);
			}
		}

        function _set_data_($var_notransaksi){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_pesan_header . " WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");

			while($var_array_pesan = _set_fetch_array_($var_query_link)){
				$this->var_notransaksi = $var_array_pesan['notransaksi'];
				$this->var_userid = $var_array_pesan['userid'];
                $this->var_tanggal = $var_array_pesan['tanggal'];
                $this->var_statusyn = $var_array_pesan['statusyn'];
                $this->var_alamat = $var_array_pesan['alamat'];
                $this->var_keterangan = $var_array_pesan['keterangan'];
			}
		}

        function _delete_data_($var_notransaksi){
			if(!_is_not_null_($var_notransaksi)){
				return false;
			}

            if($this->_is_primary_exist_header_($var_notransaksi)){
				_set_query_("DELETE FROM " . def_table_pesan_header . " WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");
                _set_query_("DELETE FROM " . def_table_pesan_detil . " WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");
			}else{
				return false;
			}
		}

        function _calculate_($var_notransaksi, $var_menuid){
            $this->var_total = 0;

			if(_is_not_null_($var_menuid)){
                $var_query_link = _set_query_("SELECT menuid, qty FROM " . def_table_pesan_detil . " WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "' AND menuid='" . _set_input_string_($var_menuid) . "'");
            }else{
                $var_query_link = _set_query_("SELECT menuid, qty FROM " . def_table_pesan_detil . " WHERE notransaksi='" . _set_input_string_($var_notransaksi) . "'");
            }

            while($var_menu = _set_fetch_array_($var_query_link)){
                $this->var_total += ((int)$var_menu['qty'] * _set_double_($this->_set_harga_($var_menu['menuid']), 0));
            }
        }

        function _calculate_sms_($var_value){
            $var_total = 0;

            $var_array_value = _set_parse_(trim($var_value), ",");

            if(count($var_array_value) > 1){
                for($var_counter=0; $var_counter<count($var_array_value); $var_counter++){
                    $var_array_pesan = _set_parse_(trim($var_array_value[$var_counter]), ' ');

                    $var_total += ((int)$var_array_pesan[1] * _set_double_($this->_set_harga_(_set_field_value(def_table_menu, "menuid", "kodemenu='" . _set_input_string_($var_array_pesan[0]) . "'")), 0));
                }
            }else{
                $var_array_pesan = _set_parse_(trim($var_array_value[0]), ' ');
                
                $var_total += ((int)$var_array_pesan[1] * _set_double_($this->_set_harga_(_set_field_value(def_table_menu, "menuid", "kodemenu='" . _set_input_string_($var_array_pesan[0]) . "'")), 0));
            }

            return $var_total;
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

        function _check_sms_($var_value, &$var_alamat){
            $var_array_value = _set_parse_(trim($var_value), ",");
            
            if(count($var_array_value) > 1){
                $var_check = true;
                
                for($var_counter=0; $var_counter<count($var_array_value)-1; $var_counter++){
                    $var_array_pesan = _set_parse_(trim($var_array_value[$var_counter]), ' ');
                    
                    if(count($var_array_pesan) == 2){
                        if($this->_check_sms_format_($var_array_pesan, $var_alamat)){
                            $var_check = true;
                        }else{
                            $var_check = false;
                        }
                    }else{
                        $var_check = false;
                    }
                }

                $var_array_pesan = _set_parse_(trim($var_array_value[$var_counter]), ' ');
                
                if(count($var_array_pesan) == 3){
                    if($this->_check_sms_format_($var_array_pesan, $var_alamat)){
                        $var_check = true;
                    }else{
                        $var_check = false;
                    }
                }else{
                    $var_check = false;
                }

                return $var_check;
            }else{
                $var_array_pesan = _set_parse_(trim($var_array_value[0]), ' ');

                if(count($var_array_pesan) == 3){
                    if($this->_check_sms_format_($var_array_pesan, $var_alamat)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }

        function _check_sms_format_($var_array_value, &$var_alamat){
            if(count($var_array_value) == 2){
                $var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE kodemenu='" . _set_input_string_($var_array_value[0]) . "'");

                if(_get_num_rows_($var_query_link)){
                    if(is_numeric($var_array_value[1])){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }elseif(count($var_array_value) == 3){
                $var_query_link = _set_query_("SELECT menuid FROM " . def_table_menu . " WHERE kodemenu='" . _set_input_string_($var_array_value[0]) . "'");

                if(_get_num_rows_($var_query_link)){
                    if(is_numeric($var_array_value[1])){
                        for($var_counter=0; $var_counter<count($this->var_array_alamat); $var_counter++){
                            if(trim(strtoupper($var_array_value[2])) == $this->var_array_alamat[$var_counter]){
                                $var_alamat = $this->var_array_alamat2[$var_counter];

                                return true;
                            }
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
?>