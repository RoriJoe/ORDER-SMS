<?php
	class _class_contactus_{
		var $var_array_contactus;

		var $var_contactusid;
        var $var_email;
		var $var_nama;
        var $var_tanggal;
        var $var_pesan;

		function _class_contactus_($var_email = "", $var_nama = "", $var_tanggal = ""){
			$var_criteria = "";

			if(_is_not_null_($var_email)){
				$var_criteria = "email LIKE '%" . _set_input_string_($var_email) . "%'";
			}

			if(_is_not_null_($var_nama)){
				if(_is_not_null_($var_criteria)){
					$var_criteria .= " AND ";
				}

				$var_criteria .= "nama LIKE '%" . _set_input_string_($var_nama) . "%'";
			}

            if(!_is_not_null_($var_tanggal)){
                $var_tanggal = "(DATE(NOW()))";
            }
            if(!_is_not_null_($var_tanggal)){
                $var_tanggal = "(DATE(NOW()))";
            }
            if(_is_not_null_($var_criteria)){
                $var_criteria .= " AND ";
            }

            if($var_tanggal == "(DATE(NOW()))"){
                $var_criteria .= "tanggal >= " . _set_input_string_($var_tanggal);
            }else{
                $var_criteria .= "tanggal >= '" . _set_input_string_($var_tanggal) . "'";
            }

			if(_is_not_null_($var_criteria)){
				$var_criteria = " WHERE " . $var_criteria;
			}

			$this->var_array_contactus = array();

			$var_query_link = _set_query_("SELECT * FROM " . def_table_contactus . $var_criteria);

			while($var_array_contactus = _set_fetch_array_($var_query_link)){
				$this->var_array_contactus[$var_array_contactus['contactusid']] = array('email' => $var_array_contactus['email'],
                                                                                        'nama' => $var_array_contactus['nama'],
                                                                                        'tanggal' => $var_array_contactus['tanggal'],
                                                                                        'pesan' => $var_array_contactus['pesan']);
			}
		}

		function _is_primary_exist_($var_contactusid){
			if(!_is_not_null_($var_contactusid)){
				return false;
			}

			$var_query_link = _set_query_("SELECT contactusid FROM " . def_table_contactus . " WHERE contactusid='" . _set_input_string_($var_contactusid) . "'");

			if(_get_num_rows_($var_query_link) > 0){
				return true;
			}else{
				return false;
			}
		}

		function _set_data_($var_contactusid){
			$var_query_link = _set_query_("SELECT * FROM " . def_table_contactus . " WHERE contactusid='" . _set_input_string_($var_contactusid) . "'");

			while($var_array_contactus = _set_fetch_array_($var_query_link)){
				$this->var_contactusid = $var_array_contactus['contactusid'];
                $this->var_email = $var_array_contactus['email'];
				$this->var_nama = $var_array_contactus['nama'];
                $this->var_tanggal = $var_array_contactus['tanggal'];
                $this->var_pesan = $var_array_contactus['pesan'];
			}
		}

		function _save_data_($var_email, $var_nama, $var_pesan){
			if(!_is_not_null_($var_email)){
				return false;
			}

			if(!_is_not_null_($var_nama)){
				return false;
			}

			return _set_query_("INSERT INTO " . def_table_contactus . " VALUES ('" . $this->_set_increment_id_() . "', '" . _set_input_string_($var_email) . "', '" . _set_input_string_($var_nama) . "', DATE(NOW()), '" . _set_input_string_($var_pesan) . "')");
		}

		function _delete_data_($var_contactusid){
			if(!_is_not_null_($var_contactusid)){
				return false;
			}

			if($this->_is_primary_exist_($var_contactusid)){
				return _set_query_("DELETE FROM " . def_table_contactus . " WHERE contactusid='" . _set_input_string_($var_contactusid) . "'");
			}else{
				return false;
			}
		}

        function _set_increment_id_(){
			$var_query_link = _set_query_("SELECT contactusid FROM " . def_table_contactus);

            date_default_timezone_set('Asia/Krasnoyarsk');

			if(_get_num_rows_($var_query_link) > 0){
				$var_hole = 0;

				for($var_counter=1; $var_counter <= _get_num_rows_($var_query_link); $var_counter++){
					$var_check_link = _set_query_("SELECT contactusid FROM " . def_table_contactus . " WHERE contactusid='" . _set_input_string_(date("dmY") . _set_padding_($var_counter, 5, "0", false)) . "'");

					if(_get_num_rows_($var_check_link) <= 0){
						$var_hole = $var_counter;

						break;
					}
				}

				if($var_hole == 0){
					$var_hole = _get_num_rows_($var_query_link) + 1;
				}

				return date("dmY") . _set_padding_($var_hole, 5, "0", false);
			}else{
				return date("dmY") . _set_padding_("1", 5, "0", false);
			}
		}
	}
?>