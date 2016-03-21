<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $user_session = array();

	 function __construct() {

	 	session_start();
	 	 
	 	$this->user_session = validate_session();

	 	$protocol = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$web_root = $protocol . $_SERVER['HTTP_HOST'];

		define('WEB_ROOT',$web_root);
		define('DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT']);
	 }	
}
