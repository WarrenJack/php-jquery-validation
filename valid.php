<?php
	class Validate {

		const VALID = '0000';
		const REQUIRED = '0001';
		const POSTCODE_INVALID = '0002';
		const EMAIL_INVALID = '0003';
		const EMAIL_USER_INVALID = '0004';
		const SHORT = '0004';
		const LONG = '0005';
		const TEXT_INVALID = '0006';
		const DOM_INVALID = '0007';
		const PHONE_INVALID = '0008';


		//TEXT-----------------------------------------

		static function text($txt, $required = false) {
			if($required){
				if(empty($txt)) {
					return self::VALID;
				}

				if(strlen($txt) < 2) {
					return self::SHORT;
				}

				if(strlen($txt) > 300) {
					return self::LONG;
				}

				if(!preg_match("/^[a-zA-Z ]*$/",$txt)) {
					return self::TEXT_INVALID;
				}
			}else{
				if(!empty($txt)){
					if(strlen($txt) < 2) {
						return self::SHORT;
					}

					if(strlen($txt) > 300) {
						return self::LONG;
					}

					if(!preg_match("/^[a-zA-Z ]*$/",$txt)) {
						return self::TEXT_INVALID;
					}
				}
			}
				return self::VALID;
		}

		//POSTCODE -----------------------------------------

    static function postcode($au_post, $required = false) {
			if($required){
				if(empty($au_post)) {
	        return self::VALID;
	      }

				if(!preg_match("#[0-9]{3,4}#", $au_post)) {
					return self::POSTCODE_INVALID;
				}
			}else{
				if(!empty($au_post)) {
					if(!preg_match("#[0-9]{3,4}#", $au_post)) {
		        return self::POSTCODE_INVALID;
		      }
				}
			}
				return self::VALID;
    }

		//EMAIL------------------------------------------

		static function email($em, $required = false) {
			if($required){
				if(empty($em)) {
					return self::VALID;
				}
				$username_ems = explode("@", $em);

				foreach($username_ems as $username_em){
					if(empty($username_em)) {
						return self::EMAIL_USER_INVALID;
					}

					if(strlen($username_em) < 2) {
						return self::EMAIL_USER_INVALID;
					}
				}

				if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
					return self::EMAIL_INVALID;
				}
			}else{
				$username_ems = explode("@", $em);

				foreach($username_ems as $username_em){
					if(empty($username_em)) {
						return self::EMAIL_USER_INVALID;
					}

					if(strlen($username_em) < 2) {
						return self::EMAIL_USER_INVALID;
					}
				}

				if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
					return self::EMAIL_INVALID;
				}
			}
				return self::VALID;
		}

		//DOMAIN------------------------------------------

		static function domain($dm, $required = false) {
			if($required){
				if(empty($dm)) {
					return self::VALID;
				}
			$domain_parts = explode(".", $dm);

			foreach($domain_parts as $domain_part){
			  if(empty($domain_part)) {
			    return self::DOM_INVALID;
			  }

			  if(strlen($domain_part) < 2) {
			    return self::DOM_INVALID;
			  }
			}
		}else{
			$domain_parts = explode(".", $dm);

			foreach($domain_parts as $domain_part){
				if(empty($domain_part)) {
					return self::DOM_INVALID;
				}

				if(strlen($domain_part) < 2) {
					return self::DOM_INVALID;
				}
			}
		}

			return self::VALID;
		}

		//PHONE ----------------------------------------------

    static function phone($phone, $required = false) {
			if($required){
				if(empty($phone)) {
					return self::VALID;
				}

				if(strlen($phone) < 2) {
					return self::SHORT;
				}

				if(strlen($phone) > 15) {
					return self::LONG;
				}

				if (preg_match("/^[a-zA-Z ]*$/",$phone)) {
					return self::PHONE_INVALID;
				}
			}else{
				if(!empty($phone)){
					if(strlen($phone) < 2) {
						return self::SHORT;
					}

					if(strlen($phone) > 15) {
						return self::LONG;
					}
				}
			}
			return self::VALID;
		}


}
	function sanitizeFormString($inputText) {
		$inputText = strip_tags($inputText);
		$inputText = str_replace(" ", "", $inputText);
		$inputText = ucfirst(strtolower($inputText));
		return $inputText;
	}

	$text_error = '';
	$postcode_error = '';
	$email_error = '';
	$domain_error = '';
	$phone_error = '';
