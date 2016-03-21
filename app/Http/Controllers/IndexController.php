<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Config;
use App;
use DB;

class IndexController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Index Controller
	|--------------------------------------------------------------------------
	|
	| This is a landing and main controller. Responsible for many leading functions like home, about us etc.
	|
	*/

	/**
	 * Landing function
	 *
	 * @return view
	 */

    public function index()
    {	
    	//fetch all the categories
    	$objCategory = App\CategoryMaster::all();

    	//fetch all the item types
    	$objType = App\TypeMaster::all();

    	//get category id versus category name array
    	$arrCetegory_id_obj = getKeyValueArray('cat_id','name',$objCategory,'object',true);

    	$arrType_id_obj = getKeyValueArray('type_id','name',$objType,'object',true);

    	foreach ($objCategory as $key => $category) {

    		$arrItemCategoryWise[$category->cat_id] = DB::table('item_master')
    					->join('type_master','item_master.item_type','=','type_master.type_id')
    					->join('category_master','type_master.category','=','category_master.cat_id')
    					->select('item_master.*','type_master.type_code','type_master.name as type_name','category_master.name as cat_name','category_master.cat_code')
    					->where('status',1)
    					->where('category_master.cat_id',$category->cat_id)
    					->limit(4)	
    					->get();
            $arrItemCategoryWise_featured[$category->cat_id] =  DB::table('item_master')
                        ->join('type_master','item_master.item_type','=','type_master.type_id')
                        ->join('category_master','type_master.category','=','category_master.cat_id')
                        ->select('item_master.*','type_master.type_code','type_master.name as type_name','category_master.name as cat_name','category_master.cat_code')
                        ->where('status',1)
                        ->where('category_master.cat_id',$category->cat_id)
                        ->where('item_master.featured',1)
                        ->limit(4)  
                        ->get();           
    	}				

    	return view('home',compact('arrItemCategoryWise_featured','objCategory','objType','arrCetegory_id_obj','arrType_id_obj','arrItemCategoryWise'));
    }

    /**
	 * Contact us function. Uses both get and post. Uses post for form submission.  
	 *
	 * @return view
	 */
    public function contact_us(Request $request)
    {	
    	$form['name']      = filter_form_input($request->input('name',''));
    	$form['email']     = filter_form_input($request->input('email',''));
    	$form['message']   = filter_form_input($request->input('message',''));
    	$message = '';

    	if ($request->isMethod('post')) 
    	{
	    	if($form['name'] != '' && $form['email'] != '' && $form['message'] != '')
	    	{
	    		if (filter_var($form['email'], FILTER_VALIDATE_EMAIL))
	    		{
	    			//send email code
	    		}
	    		else
	    		{
	    			$message = 'Please enter a valid email address';
	    		}
	    	}
	    	else
	    	{
	    		$message = 'Please fill in all the fields';
	    	}
    	}
    	return view('contact_us',['message'=>$message,'form'=>$form]);
    }

    /**
     * About us function. Uses both get and post. Uses post for form submission.  
     *
     * @return view
     */
    public function about_us(Request $request)
    {   
        return view('about_us');
    }
}
