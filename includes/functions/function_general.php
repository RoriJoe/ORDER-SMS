<?php
	function _set_exit_application_(){
		_set_session_close_();
		
		exit();
	}
	
	function _set_encode_($var_source){
		return rawurlencode(htmlentities($var_source, ENT_NOQUOTES, "UTF-8"));
	}
	
	function _set_location_($var_location){
		header("Location: " . $var_location);

        _set_exit_application_();
	}
	
	function _set_parse_($var_read_text, $var_separator = ";"){
		return split($var_separator, $var_read_text);
	}
	
	function _is_not_null_($var_value){
		if(is_array($var_value)){
			if(sizeof($var_value) > 0){
				return true;
			}else{
				return false;
			}
		}else{
			if(($var_value != "") && (strtolower($var_value) != 'null') && (strlen(trim($var_value)) > 0)){
				return true;
			}else{
				return false;
			}
		}
	}

    function _set_numeric_($var_value){
		if(!_is_not_null_($var_value)){
			return 0;
		}

		if(is_numeric($var_value)){
			return (int)$var_value;
		}else{
			return 0;
		}
	}

	function _set_double_($var_value, $var_precision){
		if(!_is_not_null_($var_value)){
			$var_value = 0;
		}

		if(!is_numeric($var_value)){
			$var_value = 0;
		}

		$var_value = number_format($var_value, $var_precision, ".", "");

		return $var_value;
	}
	
	function _set_variable_http_($var_http, $var_get = true){
		if($var_get == true){
			if(isset($HTTP_GET_VARS[$var_http])){
				return stripslashes($HTTP_GET_VARS[$var_http]);
			}elseif(isset($_GET[$var_http])){
				return stripslashes($_GET[$var_http]);
			}
		}elseif($var_get == false){
			if(isset($HTTP_POST_VARS[$var_http])){
				return stripslashes($HTTP_POST_VARS[$var_http]);
			}elseif(isset($_POST[$var_http])){
                if(is_array($_POST[$var_http])){
                    return $_POST[$var_http];
                }else{
                    return stripslashes($_POST[$var_http]);
                }
			}
		}else{		
			return;
		}
	}
	
	function _set_padding_($var_value, $var_padding = 0, $var_padding_char = " ", $var_left = true){
		if(strlen($var_value)%$var_padding != 0){
			if($var_left == true){
				$var_value .= str_repeat($var_padding_char, $var_padding-(strlen($var_value)%$var_padding));
			}else{
				$var_value = str_repeat($var_padding_char, $var_padding-(strlen($var_value)%$var_padding)) . $var_value;
			}
		}

		return $var_value;
	}

    function _set_random_value_($var_length){
        $var_random_value = '';

        while(strlen($var_random_value) < $var_length){
            $var_char = _set_random_(0, 9);

            if(ereg('^[0-9]$', $var_char)){
                $var_random_value .= $var_char;
            }
        }

        return $var_random_value;
    }

    function _set_random_($var_min = null, $var_max = null){
        static $var_seeded;

        if(!isset($var_seeded)){
            mt_srand((double) microtime()*1000000);
            $var_seeded = true;
        }

        if(isset($var_min) && isset($var_max)){
            if($var_min >= $var_max){
                return $var_min;
            }else{
                return mt_rand($var_min, $var_max);
            }
        }else{
            return mt_rand();
        }
    }
?>