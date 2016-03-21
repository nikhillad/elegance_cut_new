<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
use Config;

class TypeController extends Controller
{
     /**
	 * Index function. List items under specific type
	 *
	 * @return view
	 */    
	public function index(Request $request,$cat_code='',$type_code = '')
	{
		if($type_code != '' && $cat_code != '')
		{	
			$objType = App\TypeMaster::where('type_code',$type_code)->first();
			$objCategory = App\CategoryMaster::where('cat_code',$cat_code)->first();
			
			if(null == $objType || null == $objCategory)
				abort(404);

			//create an object of a pagination class
			$pagination = new \Pagination();

			//set number of records per page
			$pagination->setRecordsPerPage(18);

			//set links call method (PHP for simple full callback or JS for javascript function call (in case your fetching data using ajax))
			$pagination->setRenderMode('PHP');

			//get page number if its been ser in URL 
			if(isset($_GET['page']))
				$page = $_GET['page'];
			else
				$page = 1;

			//set page number
			$pagination->setPage($page);

			//get items for the category
			$itemCount = DB::table('item_master')
				->join('type_master','item_master.item_type','=','type_master.type_id')
				->join('category_master','type_master.category','=','category_master.cat_id')
				->select('item_master.*')
				->where('status',1)
				->where('type_master.type_code',$type_code)
				->where('type_master.category',$objCategory->cat_id)		
				->count();

			//set number of total records
			$pagination->setTotalRecords($itemCount);

			//calculate offset (copy and paste this to your code)
			$offset = ($page - 1) * $pagination->getRecordsPerPage();

			//get items for the category
			$objItems = DB::table('item_master')
				->join('type_master','item_master.item_type','=','type_master.type_id')
				->join('category_master','type_master.category','=','category_master.cat_id')
				->select('item_master.*','type_master.type_code','type_master.name as type_name','category_master.name as cat_name','category_master.cat_code')
				->where('status',1)
				->where('type_master.type_code',$type_code)
				->where('type_master.category',$objCategory->cat_id)
				->skip($offset)
				->take($pagination->getRecordsPerPage())	
				->get();

			return view('type_items',compact('objType','objItems','objCategory','pagination'));
		}	
		else
		{
			abort(404);
		}
	}
}
