<?php
	function _set_link_($var_link_url, $var_link_parameter = "", $var_ssid = true){
		if(!_is_not_null_($var_link_url)){
			return '';
		}
		
		if(_is_not_null_($var_link_parameter)){
			if($var_ssid){
				return $var_link_url . '?' . $var_link_parameter . '&' . SID;
			}else{
				return $var_link_url . '?' . $var_link_parameter;
			}
		}else{
			if($var_ssid){
				return $var_link_url . '?' . SID;
			}else{
				return $var_link_url;
			}
		}
	}

	function _set_hyperlink_($var_link_url, $var_link_text = "", $var_parameter = "", $var_link_parameter = "", $var_span = true, $var_ssid = true){
		if(!_is_not_null_($var_link_url)){
			return $var_link_text;
		}
		
		$var_hyperlink_value = '<a href="' . _set_link_($var_link_url, $var_link_parameter, $var_ssid) . '"';
		
		if(_is_not_null_($var_parameter)){
			$var_hyperlink_value .= ' ' . $var_parameter;
		}
		
		if($var_span == true){
			$var_hyperlink_value .= '><span>' . $var_link_text . '</span></a>';
		}else{
			$var_hyperlink_value .= '>' . $var_link_text . '</a>';
		}
		
		return $var_hyperlink_value;
	}

	function _set_image_link_($var_image_url, $var_link_url = "", $var_image_id = "", $var_image_height = "", $var_image_width = "", $var_image_text = "", $var_parameter = "", $var_link_parameter = "", $var_image_border = "0", $var_ssid = true, $var_parameter_image = ""){
		if(!_is_not_null_($var_image_url)){
			return $var_link_url;
		}
		
		if(!_is_not_null_($var_parameter_image)){
			$var_parameter_image = ' ' . $var_parameter_image . ' ';
		}
		
		$var_image_value = '<img id="' . $var_image_id . '" src="' . $var_image_url . '" height="' . $var_image_height . '" width="' . $var_image_width . '" border="'. $var_image_border . '" alt="' . $var_image_text . '"' . $var_parameter_image . '>';
		
		$var_image_value = _set_hyperlink_($var_link_url, $var_image_value, $var_parameter, $var_link_parameter, false, $var_ssid);
		
		return $var_image_value;
	}
	
	function _set_label_($var_label_id, $var_label_text = "", $var_parameter = ""){
		$var_label_value = '<label id="' . $var_label_id . '" name="' . $var_label_id . '"';
		
		if(_is_not_null_($var_parameter)){
			$var_label_value .= ' ' . $var_parameter;
		}
		
		$var_label_value .= '>' . $var_label_text . '</label>';
		
		return $var_label_value;
	}
	
	function _set_pulldown_($var_pulldown_id, $var_array_value, $var_size = 0, $var_value = "", $var_parameter = "", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		
		$var_pulldown_value = '<select name="' . $var_pulldown_id . '"';
		
		if(_is_not_null_($var_parameter)){
			$var_pulldown_value .= ' ' . $var_parameter;
		}
		
		$var_pulldown_value .= '>';
		
		if(($var_reinsert_value == true) && 
			((isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])) || 
			(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])))){
			if(isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_GET_VARS[$var_pulldown_id]);
			}elseif(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_POST_VARS[$var_pulldown_id]);
			}
		}
		
		for($var_counter = 0; $var_counter <= $var_size; $var_counter++){
			$var_pulldown_value .= '<option value="' . $var_array_value["id"][$var_counter] . '"';
			
			if($var_value == $var_array_value["id"][$var_counter]) {
				$var_pulldown_value .= " SELECTED";
			}
			
			$var_pulldown_value .= '>' . $var_array_value["text"][$var_counter] . '</option>';
		}
		
		$var_pulldown_value .= '</select>';
		
		return $var_pulldown_value;
	}
	
	function _set_pulldown_db_($var_pulldown_id, $var_array_value, $var_value = "", $var_parameter = "", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		
		$var_pulldown_value = '<select name="' . $var_pulldown_id . '"';
		
		if(_is_not_null_($var_parameter)){
			$var_pulldown_value .= ' ' . $var_parameter;
		}
		
		$var_pulldown_value .= '>';
		
		if(($var_reinsert_value == true) && 
			((isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])) || 
			(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])))){
			if(isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_GET_VARS[$var_pulldown_id]);
			}elseif(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_POST_VARS[$var_pulldown_id]);
			}
		}
		
		for($var_counter = 0, $var_size = sizeof($var_array_value); $var_counter < $var_size; $var_counter++){
			$var_pulldown_value .= '<option value="' . $var_array_value[$var_counter]['id'] . '"';
			
			if($var_value == $var_array_value[$var_counter]['id']) {
				$var_pulldown_value .= " SELECTED";
			}
			
			$var_pulldown_value .= '>' . $var_array_value[$var_counter]['text'] . '</option>';
		}
		
		$var_pulldown_value .= '</select>';
		
		return $var_pulldown_value;
	}

    function _set_checkbox_($var_check_id, $var_default_value = "", $var_type = "checkbox", $var_checked = false, $var_text = "", $var_parameter = "", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;

		$var_checkbox_value = '<input type="' . $var_type . '" id="' . $var_check_id . '" name="' . $var_check_id . '"';

		if($var_reinsert_value == true){
			if(isset($HTTP_GET_VARS[$var_check_id]) && is_string($HTTP_GET_VARS[$var_check_id])){
				if(_set_variable_http_($var_check_id) == $var_default_value){
					$var_checkbox_value .= ' CHECKED';
				}
			}elseif(isset($HTTP_POST_VARS[$var_check_id]) && is_string($HTTP_POST_VARS[$var_check_id])){
				if(_set_variable_http_($var_check_id, false) == $var_default_value){
					$var_checkbox_value .= ' CHECKED';
				}
			}
		}else{
            if($var_checked == def_yes){
				$var_checkbox_value .= ' CHECKED';
			}
        }

		if(_is_not_null_($var_default_value)){
			$var_checkbox_value .= ' value="' . $var_default_value . '"';
		}

		if(_is_not_null_($var_parameter)){
			$var_checkbox_value .= ' ' . $var_parameter;
		}

		$var_checkbox_value .= ' />' . _set_label_("", $var_text, 'for="' . $var_check_id . '"');

		return $var_checkbox_value;
	}
	
	function _set_input_($var_input_id, $var_value = "", $var_type = "text", $var_parameter = "", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		
		$var_input_value = '<input type="' . $var_type . '" id="' . $var_input_id . '" name="' . $var_input_id . '"';
		
		if(($var_reinsert_value == true) && 
			((isset($HTTP_GET_VARS[$var_input_id]) && is_string($HTTP_GET_VARS[$var_input_id])) || 
			(isset($HTTP_POST_VARS[$var_input_id]) && is_string($HTTP_POST_VARS[$var_input_id])))){
			if(isset($HTTP_GET_VARS[$var_input_id]) && is_string($HTTP_GET_VARS[$var_input_id])){
				$var_value = stripslashes($HTTP_GET_VARS[$var_input_id]);
			}elseif(isset($HTTP_POST_VARS[$var_input_id]) && is_string($HTTP_POST_VARS[$var_input_id])){
				$var_value = stripslashes($HTTP_POST_VARS[$var_input_id]);
			}
		}
		
		if(_is_not_null_($var_value)){
			$var_input_value .= ' value="' . $var_value . '"';
		}
		
		if(_is_not_null_($var_parameter)){
			$var_input_value .= ' ' . $var_parameter;
		}
		
		$var_input_value .= ' />';
		
		return $var_input_value;
	}
	
	function _set_textarea_($var_textarea_id, $var_value = "", $var_parameter = "", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		
		$var_textarea_value = '<textarea name="' . $var_textarea_id . '"';
		
		if(($var_reinsert_value == true) && 
			((isset($HTTP_GET_VARS[$var_textarea_id]) && is_string($HTTP_GET_VARS[$var_textarea_id])) || 
			(isset($HTTP_POST_VARS[$var_textarea_id]) && is_string($HTTP_POST_VARS[$var_textarea_id])))){
			if(isset($HTTP_GET_VARS[$var_textarea_id]) && is_string($HTTP_GET_VARS[$var_textarea_id])){
				$var_value = stripslashes($HTTP_GET_VARS[$var_textarea_id]);
			}elseif(isset($HTTP_POST_VARS[$var_textarea_id]) && is_string($HTTP_POST_VARS[$var_textarea_id])){
				$var_value = stripslashes($HTTP_POST_VARS[$var_textarea_id]);
			}
		}
		
		if(_is_not_null_($var_parameter)){
			$var_textarea_value .= ' ' . $var_parameter;
		}
		
		$var_textarea_value .= '>';
		
		if(_is_not_null_($var_value)){
			$var_textarea_value .= $var_value;
		}
		
		$var_textarea_value .= '</textarea>';
		
		return $var_textarea_value;
	}
	
	function _set_image_submit_($var_link_url, $var_link_text = "", $var_parameter = ""){
		$var_image_value = '<input type="image" src="' . $var_link_url . '" border="0" alt="' . $var_link_text . '"';
		
		if(_is_not_null_($var_link_text)){
			$var_image_value .= ' title=" ' . $var_link_text . '" value="' . $var_link_text . '"';
		}
			
		if(_is_not_null_($var_parameter)){
			$var_image_value .= ' ' . $var_parameter;
		}
			
		$var_image_value .= '>';
		
		return $var_image_value;
	}
	
	function _set_submit_($var_input_id, $var_value = "", $var_type = "submit", $var_parameter = ""){
		$var_submit_value = '<input id="' . $var_input_id . '" type="' . $var_type . '" value="' . $var_value . '"';
			
		if(_is_not_null_($var_parameter)){
			$var_submit_value .= ' ' . $var_parameter;
		}
			
		$var_submit_value .= '>';
		
		return $var_submit_value;
	}

    function _set_pulldown_time_($var_pulldown_id, $var_value = "", $var_parameter = "", $var_type = "hour", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;

		$var_pulldown_value = '<select name="' . $var_pulldown_id . '"';

		if(_is_not_null_($var_parameter)){
			$var_pulldown_value .= ' ' . $var_parameter;
		}

		$var_pulldown_value .= '>';

		if(($var_reinsert_value == true) &&
			((isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])) ||
			(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])))){
			if(isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_GET_VARS[$var_pulldown_id]);
			}elseif(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_POST_VARS[$var_pulldown_id]);
			}
		}

		if($var_type == "hour"){
			$var_size = 23;
		}else if($var_type == "minute"){
			$var_size = 59;
		}else if($var_type == "second"){
			$var_size = 59;
		}else{
			$var_size = 0;
		}

		for($var_counter = 0; $var_counter <= $var_size; $var_counter++){
			$var_pulldown_value .= '<option value="' . _set_padding_($var_counter, 2, "0", false) . '"';

			if($var_value == _set_padding_($var_counter, 2, "0", false)) {
				$var_pulldown_value .= " SELECTED";
			}

			$var_pulldown_value .= '>' . _set_padding_($var_counter, 2, "0", false) . '</option>';
		}

		$var_pulldown_value .= '</select>';

		return $var_pulldown_value;
	}

    function _set_pulldown_date_($var_pulldown_id, $var_value = "", $var_parameter = "", $var_type = "day", $var_reinsert_value = true){
		global $HTTP_GET_VARS, $HTTP_POST_VARS;

		$var_pulldown_value = '<select name="' . $var_pulldown_id . '"';

		if(_is_not_null_($var_parameter)){
			$var_pulldown_value .= ' ' . $var_parameter;
		}

		$var_pulldown_value .= '>';

		if(($var_reinsert_value == true) &&
			((isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])) ||
			(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])))){
			if(isset($HTTP_GET_VARS[$var_pulldown_id]) && is_string($HTTP_GET_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_GET_VARS[$var_pulldown_id]);
			}elseif(isset($HTTP_POST_VARS[$var_pulldown_id]) && is_string($HTTP_POST_VARS[$var_pulldown_id])){
				$var_value = stripslashes($HTTP_POST_VARS[$var_pulldown_id]);
			}
		}else{
            date_default_timezone_set('Asia/Krasnoyarsk');
            
            if($var_type == "day"){
                $var_value = date("d");
            }elseif($var_type == "month"){
                $var_value = date("m");
            }elseif($var_type == "year"){
                $var_value = date("Y");
            }
        }

        $var_start = 1;
        
		if($var_type == "day"){
			$var_size = 31;
		}else if($var_type == "month"){
			$var_size = 12;
		}else if($var_type == "year"){
			$var_size = 2100;
            $var_start = 2008;
		}else{
			$var_size = 0;
		}

		for($var_counter = $var_start; $var_counter <= $var_size; $var_counter++){
            if($var_type != "year"){
                $var_pulldown_value .= '<option value="' . _set_padding_($var_counter, 2, "0", false) . '"';
            }else{
                $var_pulldown_value .= '<option value="' . $var_counter . '"';
            }

            if($var_type != "year"){
                if($var_value == _set_padding_($var_counter, 2, "0", false)) {
                    $var_pulldown_value .= " SELECTED";
                }
            }else{
                if($var_value == $var_counter) {
                    $var_pulldown_value .= " SELECTED";
                }
            }

            if($var_type != "year"){
                $var_pulldown_value .= '>' . _set_padding_($var_counter, 2, "0", false) . '</option>';
            }else{
                $var_pulldown_value .= '>' . $var_counter . '</option>';
            }
		}

		$var_pulldown_value .= '</select>';

		return $var_pulldown_value;
	}
?>