<?php
	class _class_gammu_{
		var $var_gammu = "..\\gammu\\gammu.exe";

        var $var_messages;
        var $var_inbox;
        var $var_outbox;

        var $var_inboxphone = 0;
        var $var_inboxsim = 0;
        var $var_outboxphone = 0;
        var $var_outboxsim = 0;
        var $var_simmessagecount = 0;
        var $var_simmessageunreadcount = 0;
        var $var_phonemessagecount = 0;
        var $var_phonemessageunreadcount = 0;
		
		function _class_gammu_($var_gammu){
			if(_is_not_null_($var_gammu)){
				$this->var_gammu = $var_gammu;
			}
		}
		
		function _gammu_execute_($var_exe, &$var_respon){
			$var_respon = array();
			
			if(file_exists($this->var_gammu)){
                ob_start();
                    passthru($var_exe);
                    $var_respon = ob_get_contents();
                ob_end_clean();
			}else{
				$var_respon = "File $this->var_gammu tidak ditemukan";
			}
		}
		
		function _gammu_info_(&$var_respon){
			$this->_gammu_execute_($this->var_gammu . " --identify", $var_result);
            
            if(_is_not_null_($var_result)){
                $var_respon = explode("\n", $var_result);
            }
		}

        function _gammu_message_count_(){
            $this->_gammu_execute_($this->var_gammu . " --monitor 1", $var_result);
            
            $var_array_result = explode("\n", $var_result);

            for($var_counter=0; $var_counter<count($var_array_result); $var_counter++){
                if(substr($var_array_result[$var_counter], 0, 7) == "SIM SMS"){
                    $var_temp = explode(":", $var_array_result[$var_counter]);
                    $var_temp2 = explode(",", $var_temp[1]);

                    $this->var_simmessagecount = trim(substr($var_temp2[0], 0, strpos($var_temp2[0], 'used')));
                    $this->var_simmessageunreadcount = trim(substr($var_temp2[1], 0, strpos($var_temp2[1], 'unread')));
                }elseif(substr($var_array_result[$var_counter], 0, 9) == "Phone SMS"){
                    $var_temp = explode(":", $var_array_result[$var_counter]);
                    $var_temp2 = explode(",", $var_temp[1]);

                    $this->var_phonemessagecount = trim(substr($var_temp2[0], 0, strpos($var_temp2[0], 'used')));
                    $this->var_phonemessageunreadcount = trim(substr($var_temp2[1], 0, strpos($var_temp2[1], 'unread')));
                }
            }
        }

        function _gammu_get_(&$var_respon){
            $this->_gammu_execute_($this->var_gammu . " nothing --getsmsfolders", $var_result);

            if(!_is_not_null_($var_result)){
                $var_respon = "Error on Device / Not Supported";

                return 0;
            }

            $var_array_result = explode("\n", $var_result);

            if(!isset($var_array_result)){
                $var_respon = $var_result;

                return 0;
            }

            for($var_counter=0; $var_counter<count($var_array_result)-1; $var_counter++){
                if(preg_match("/^(.). \"(.+)Inbox\", phone\s*/", $var_array_result[$var_counter], $var_temp)){
                    $this->var_inboxphone = trim(str_replace("\n","", $var_temp[1]));
                }elseif(preg_match("/^(.). \"(.+)Inbox\", SIM\s*/", $var_array_result[$var_counter], $var_temp)){
                    $this->var_inboxsim = trim(str_replace("\n","", $var_temp[1]));
                }elseif(preg_match("/^(.). \"(.+)Outbox\", phone\s*/", $var_array_result[$var_counter], $var_temp)){
                    $this->var_outboxphone = trim(str_replace("\n","", $var_temp[1]));
                }elseif(preg_match("/^(.). \"(.+)Outbox\", SIM\s*/", $var_array_result[$var_counter], $var_temp)){
                    $this->var_outboxsim = trim(str_replace("\n","", $var_temp[1]));
                }else{
                    $var_respon = $var_result;

                    return 0;
                }
            }

            $var_trimdata = array(" ", "\n", "\r", "\t", "\"", "'");

            $this->_gammu_execute_($this->var_gammu . " nothing --getallsms", $var_result);

            $var_array_result = explode("\n", $var_result);
            
            $var_x = 0;
            $var_y = 0;

            date_default_timezone_set('Asia/Krasnoyarsk');

            for($var_counter=0; $var_counter<count($var_array_result)-1; $var_counter++){
                if(eregi("^SMS message", $var_array_result[$var_counter])) continue;
                
                if(preg_match("/Location (.+), folder \"(.+)\"/", $var_array_result[$var_counter], $var_temp)){
                    $var_folder = $var_temp[2];

                    if($var_folder == "Outbox"){
                        $var_fid = $var_x;
                        $var_x++;
                    }

                    if($var_folder == "Inbox"){
                        $var_fid = $var_y;
                        $var_y++;
                    }

                    $var_data[$var_folder][$var_fid] = array();
                    $var_data[$var_folder][$var_fid]['location'] = trim($var_temp[1]);
                    $var_data[$var_folder][$var_fid]['body'] = "";
                    $var_data[$var_folder][$var_fid]['number'] = "";
                    $var_data[$var_folder][$var_fid]['senttime'] = "";
                }elseif(preg_match("/^SMSC number(.+): \"(.+)\"/", $var_array_result[$var_counter], $var_temp)){
                    $var_data[$var_folder][$var_fid]['smsc'] = trim($var_temp[2]);
                }elseif(preg_match("/^Reference number(.+): (.+)/", $var_array_result[$var_counter], $var_temp)){
                    $var_data[$var_folder][$var_fid]['refnum'] = trim($var_temp[2]);
                }elseif(preg_match("/^Sent (.+): (.+)/", $var_array_result[$var_counter], $var_temp)){
                    $var_time = strtotime(trim($var_temp[2]));

                    if(!$var_time or $var_time <=0){
                        $var_time = date("U");
                    }

                    $var_data[$var_folder][$var_fid]['senttime']= date("Y-m-d H:i:s", $var_time);
                }elseif(preg_match("/^Coding (.+): (.+)\s*/", $var_array_result[$var_counter], $var_temp)){
                    $var_data[$var_folder][$var_fid]['coding'] = trim($var_temp[2]);
                }elseif(preg_match("/^Remote number(.+): \"(.+)\"\s*/", $var_array_result[$var_counter], $var_temp)){
                    $var_number = trim($var_temp[2]);

                    $var_data[$var_folder][$var_fid]['number'] = $var_number;
                }elseif(preg_match("/^(.+) : (.+)\s*/", $var_array_result[$var_counter], $var_temp)){
                    $var_data[$var_folder][$var_fid][trim(str_replace($var_trimdata, "", $var_temp[1]))] = trim($var_temp[2]);
                }elseif(preg_match("/^Status (.+): (.+)\s*/", $var_array_result[$var_counter], $var_temp)){
                    $var_data[$var_folder][$var_fid]['status'] = trim($var_temp[2]);
                }elseif(preg_match("/(.+)Concatenated \(linked\) message, ID \((.+)\) (.+), part (.+) of (.+)/", $var_array_result[$var_counter], $var_temp)){
                    $var_data[$var_folder][$var_fid]['link']['coding'] = trim($var_temp[2]);
                    $var_data[$var_folder][$var_fid]['link']['id'] = trim($var_temp[3]);
                    $var_data[$var_folder][$var_fid]['link']['part'] = trim($var_temp[4]);
                }else{
                    if(preg_match("/(.+) SMS parts in (.+) SMS sequences/", $var_array_result[$var_counter], $var_temp)) continue;
                    
                    $var_data[$var_folder][$var_fid]['body'] .= htmlspecialchars(trim(addslashes($var_array_result[$var_counter])));
                }
           }

           $this->var_messages = $var_data;
        }

		function _gammu_inbox_(&$var_respon){
            $this->_gammu_get_(&$var_respon);

            $this->var_inbox = array();
            
            if($this->var_messages){
                for($var_counter=0; $var_counter<count($this->var_messages['Inbox']); $var_counter++){
                    $this->var_inbox[$var_counter]['number'] = $this->var_messages['Inbox'][$var_counter]['number'];
                    $this->var_inbox[$var_counter]['senttime'] = $this->var_messages['Inbox'][$var_counter]['senttime'];
                    $this->var_inbox[$var_counter]['body'] = $this->var_messages['Inbox'][$var_counter]['body'];

                    _set_query_("INSERT INTO " . def_table_inbox . " VALUES ('', '" . _set_input_string_($this->var_inbox[$var_counter]['body']) . "', '" . _set_input_string_($this->var_inbox[$var_counter]['number']) . "', '" . _set_input_string_($this->var_inbox[$var_counter]['senttime']) . "')");
                }

                $this->_gammu_delete_all_($var_temp, $this->var_inboxphone);
                $this->_gammu_delete_all_($var_temp, $this->var_inboxsim);
            }
		}

        function _gammu_outbox_(&$var_respon){
            $this->_gammu_get_(&$var_respon);

            $this->var_inbox = array();

            if($this->var_messages){
                for($var_counter=0; $var_counter<count($this->var_messages['Outbox']); $var_counter++){
                    $this->var_outbox[$var_counter]['number'] = $this->var_messages['Outbox'][$var_counter]['number'];
                    $this->var_outbox[$var_counter]['senttime'] = $this->var_messages['Outbox'][$var_counter]['senttime'];
                    $this->var_outbox[$var_counter]['body'] = $this->var_messages['Outbox'][$var_counter]['body'];

                    _set_query_("INSERT INTO " . def_table_outbox . " VALUES ('', '" . _set_input_string_($this->var_outbox[$var_counter]['body']) . "', '" . _set_input_string_($this->var_outbox[$var_counter]['number']) . "', '" . _set_input_string_($this->var_outbox[$var_counter]['senttime']) . "')");
                }

                $this->_gammu_delete_all_($var_temp, $this->var_outboxphone);
                $this->_gammu_delete_all_($var_temp, $this->var_outboxsim);
            }
        }

        function _gammu_send_(&$var_respon, $var_handphone, $var_message){
            $this->_gammu_execute_("echo " . $var_message . " | " . $this->var_gammu . " --sendsms TEXT " . $var_handphone, &$var_result);

            if(_is_not_null_($var_result)){
                $var_respon = $var_result;
            }
        }

        function _gammu_delete_all_(&$var_respon, $var_folder){
            $this->_gammu_execute_($this->var_gammu . " --deleteallsms " . $var_folder, &$var_result);

            $var_respon = $var_result;
        }
	}
?>