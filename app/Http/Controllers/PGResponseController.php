<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use DB;
use APP;

class PGResponseController extends Controller
{
	//Upon transaction success
    public function success(Request $request)
    {
    	dd($request);
    }

    //Upon transaction failure
    public function fail(Request $request)
    {
    	dd($request);
    }

    //Upon cancellation from user at PG side
    public function cancel(Request $request)
    {
    	dd($request);
    }
}
