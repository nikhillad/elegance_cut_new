<?php

function thumbnailImage($imagePath) {
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->setbackgroundcolor('rgb(64, 64, 64)');
    $imagick->thumbnailImage(300, 300, true, true);
    //header("Content-Type: image/jpg");
    return $imagick->getImageBlob();
}

function filter_form_input($input = '')
{
	if($input == '')
		return '';

	return strip_tags(trim($input));
}	

function getKeyValueArray($key,$value,$input_array,$type='array',$full_obj_response=false)
{
	if($type == 'array')
	{
		$output_array = array();

		foreach ($input_array as $val) {
			if($full_obj_response)
				$output_array[$val[$key]] = $val;
			else
				$output_array[$val[$key]] = $val[$value];
		}
	}
	else if($type == 'object')
	{
		$output_array = array();

		foreach ($input_array as $val) {
			if($full_obj_response)
				$output_array[$val->$key] = $val;
			else
				$output_array[$val->$key] = $val->$value;
		}
	}	
	else
	{
		return null;
	}

	return $output_array;
}

function login($objUser,$remember_me = false)
{
	//session_start();
	if(empty($objUser) || $objUser == '')
		return false;	

	DB::table('user_master')
            ->where('user_id', $objUser->user_id)
            ->update(['last_login' => date('Y-m-d H:i:s')]);

	$_SESSION['elegance_cut_user']['obj'] = $objUser;

	$cookie_name = 'elegance_cut_user';

	if($remember_me)
		$cookie_value = $objUser->fname.'-'.$objUser->user_id.'-'.$objUser->email.'-'.env('APP_ID').'-remember';
	else
		$cookie_value = $objUser->fname.'-'.$objUser->user_id.'-'.$objUser->email.'-'.env('APP_ID').'-no_remember';

	if($remember_me)
	{
		setcookie($cookie_name, encryptCookie($cookie_value), time() + (86400 * 3650), "/"); // 86400 = 1 day, 10 Years
		$_SESSION['elegance_cut_user']['session_expire'] = time() + 86400; // 1 day
	}
	else{
		setcookie($cookie_name, encryptCookie($cookie_value), time() + (3600), "/"); // 3600 = 1 hour
		$_SESSION['elegance_cut_user']['session_expire'] = time() + 3600; // 1 hour
	}
}

function logout()
{
	unset($_SESSION['elegance_cut_user']);

	setcookie('elegance_cut_user', '', time() - (86400 * 30), "/"); // 86400 = 1 day	
}

function validate_session()
{
	$user = new stdClass();

	//check if user has any stored cookie and check for its version if yes
	//logout user if stored cookie is outdated
	if(isset($_COOKIE['elegance_cut_user']))
	{
		$arrayCookieVariables = getCookieVariables(decryptCookie($_COOKIE['elegance_cut_user']));
		if(count($arrayCookieVariables) == env('COOKIE_LENGTH') && $arrayCookieVariables[3] == env('APP_ID'))
		{
			//do nothing
		}
		else
		{
			logout();
			$user->is_logged_in = false;
			return $user;
		}
	}
	else
	{
		logout();
		$user->is_logged_in = false;
		return $user;
	}

	//check if all the session variable are in place
	if(isset($_SESSION['elegance_cut_user']) && isset($_SESSION['elegance_cut_user']['obj']))
	{
		if($_SESSION['elegance_cut_user']['session_expire'] > time())
		{
			$user = $_SESSION['elegance_cut_user']['obj'];
			$user->is_logged_in = true;
			return $user;
		}
		else if(isset($_COOKIE['elegance_cut_user']))
		{
			$arrayCookieVariables = getCookieVariables(decryptCookie($_COOKIE['elegance_cut_user']));

			if(in_array('remember', $arrayCookieVariables))
			{
				//restore session expire
				$_SESSION['elegance_cut_user']['session_expire'] = time() + 86400;
				$user = $_SESSION['elegance_cut_user']['obj'];
				$user->is_logged_in = true;
				return $user;
			}
			else
			{
				$_SESSION['elegance_cut_user']['session_expire'] = time() + 3600;
				$user = $_SESSION['elegance_cut_user']['obj'];
				$user->is_logged_in = true;
				return $user;
			}
		}
		else
		{
			logout();
			$user->is_logged_in = false;
			return $user;
		}
	}
	else
	{
		if(isset($_COOKIE['elegance_cut_user']))
		{
			$arrayCookieVariables = getCookieVariables(decryptCookie($_COOKIE['elegance_cut_user']));

			//get user data
			$objUser = App\UserMaster::where('user_id',$arrayCookieVariables[1])
						->where('status',1)
						->first();

			if(null == $objUser)
			{
				logout();
				$user->is_logged_in = false;
				return $user;
			}

			if(in_array('remember', $arrayCookieVariables))
			{
				//restore session expire
				$_SESSION['elegance_cut_user']['obj'] = $objUser;
				$_SESSION['elegance_cut_user']['session_expire'] = time() + 86400; // 1 day

				$user = $_SESSION['elegance_cut_user']['obj'];
				$user->is_logged_in = true;
				return $user;
			}
			else
			{
				//restore session expire
				$_SESSION['elegance_cut_user']['obj'] = $objUser;
				$_SESSION['elegance_cut_user']['session_expire'] = time() + 3600; // 1 hour

				$user = $_SESSION['elegance_cut_user']['obj'];
				$user->is_logged_in = true;
				return $user;
			}
		}
		else
		{
			logout();
			$user->is_logged_in = false;
			return $user;
		}
	}
}

function encryptCookie($value){
   if(!$value){return false;}
   $key = env('APP_KEY');
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
   return trim(base64_encode($crypttext)); //encode for cookie
}

function decryptCookie($value){
   if(!$value){return false;}
   $key = env('APP_KEY');
   $crypttext = base64_decode($value); //decode cookie
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
   return trim($decrypttext);
}

function getCookieVariables($cookie)
{
	return explode('-', $cookie);
}

function generate_and_send_email_verification_email($objUser = null)
{
	if($objUser == null)
		return false;

	//generate token
	$token = generate_token($objUser,config('global.token_types.verify_email'));

	$token_generated = false;

	//store token into database
	$objTokenMaster = new App\TokenMaster();

	$objTokenMaster->token = $token;
	$objTokenMaster->expire_on = date("Y-m-d H:i:s", strtotime('+1 hour'));
	$objTokenMaster->user_id = $objUser->user_id;
	$objTokenMaster->token_type = config('global.token_types.verify_email');

	try{
		$objTokenMaster->save();
		$token_generated = true;
	}
	catch(\Exception $e)
	{
		return false;
		$token_generated = false;
	}
	
	//send email with this token
	if($token_generated == true)
	{
		//send mail

	}
	else
	{
		return false;
	}

}

function generate_token($objUser,$token_type)
{
	return encryptCookie($objUser->user_id.$token_type.time()); 
}