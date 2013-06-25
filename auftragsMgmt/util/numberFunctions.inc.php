<?php

function floatConverter($str, $set=FALSE) {            
	if(preg_match("/([0-9\.,-]+)/", $str, $match)) {
		// Found number in $str, so set $str that number
		$str = $match[0];
		
		if(strstr($str, ',')) {
			// A comma exists, that makes it easy, cos we assume it separates the decimal part.
			$str = str_replace('.', '', $str);    // Erase thousand seps
			$str = str_replace(',', '.', $str);    // Convert , to . for floatval command
                
			return floatval($str);
		} else {
			// No comma exists, so we have to decide, how a single dot shall be treated
			if(preg_match("/^[0-9]*[\.]{1}[0-9-]+$/", $str) == TRUE && $set['single_dot_as_decimal'] == TRUE) {
				// Treat single dot as decimal separator
				return floatval($str);    
			} else {
				// Else, treat all dots as thousand seps
				$str = str_replace('.', '', $str);    // Erase thousand seps
				return floatval($str);
			}                
		}
	} else {
		// No number found, return zero
		return 0;
	}
}