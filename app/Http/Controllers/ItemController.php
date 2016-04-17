<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
use Config;

class ItemController extends Controller
{
    public function index(Request $request,$item_id = '')
    {
    	if($item_id != '')
    	{
    		$objItem = App\ItemMaster::where('item_id',$item_id)->where('status',1)->first();

    		if(null != $objItem)
    		{
    			//fetch all the categories
		    	$objCategory = App\CategoryMaster::all();

		    	//fetch all the item types
		    	$objType = App\TypeMaster::all();

		    	//get category id versus category name array
		    	$arrCetegory_id_obj = getKeyValueArray('cat_id','name',$objCategory,'object',true);

		    	$arrType_id_obj = getKeyValueArray('type_id','name',$objType,'object',true);


                //get coupon information if any
                $objCouponMaster = DB::table('coupon_master')
                        ->join('coupon_type_master','coupon_type_master.coupon_id','=','coupon_master.coupon_id')
                        ->where('coupon_master.status', 1)
                        ->where('coupon_type_master.type_id', $objItem->item_type)
                        ->select('coupon_master.*')
                        ->get();

                        
                $size = null;
                $message = '';
                $show_size_chart = false;

                //set this true always
                $show_size_chart=true;

                if($show_size_chart==true)
                {
                    //get item sizes
                    $objSizes = DB::table('item_size_master')->where('item_id',$objItem->item_id)
                            ->join('size_master','size_master.size_id','=','item_size_master.size_id')
                            ->select('item_size_master.*','size_master.*')
                            ->get();

                    $arrSize_id_size_code = getKeyValueArray('size_id','size_code',$objSizes,'object',false);        
                }

                //get selected item size
                $size = filter_form_input($request->input('size',''));
                $selected_size_available_qty = 0;

                //get total available quantity
                $total_available_qty = 0; 
                if($show_size_chart)
                {
                    foreach ($objSizes as $key => $value) {
                        $total_available_qty = $total_available_qty + $value->qty;

                        if($size == $value->size_code)
                            $selected_size_available_qty = $value->qty;
                    }
                }
                else
                {
                    if($objItem->qty != null)
                        $total_available_qty = $objItem->qty;
                }


                //add to cart
                if ($request->isMethod('post')) 
                {
                    //check size is valid
                    if($show_size_chart ==  true)
                    {  
                        $size_valid = false;
                        
                        foreach ($objSizes as $key => $value) {
                           if($value->qty > 0 && $value->size_code == $size)
                              $size_valid = true;    
                        }

                        if(!$size_valid)
                            $message[] = 'Plese select size first.';
                    }   
                      
                    $qty = filter_form_input($request->input('qty',''));

                    if($message == '')
                    {
                        if($qty != '' && is_numeric($qty) && $qty <= $selected_size_available_qty)
                        {
                            if($this->user_session->is_logged_in == true)
                                $user_id = $this->user_session->user_id;
                            else
                                $user_id = null;

                            if($this->user_session->is_logged_in)
                            {
                                $check_if_already_added = App\CartMaster::where( function ( $query )
                                            {
                                                $query->where('user_id',(int)$this->user_session->user_id)
                                                    ->orWhere('session_id',session_id());
                                            })
                                            ->where('item_id',(int)$objItem->item_id)->first();
                            }
                            else
                            {
                                $check_if_already_added = App\CartMaster::where('session_id',session_id())->where('item_id',(int)$objItem->item_id)->first();
                            }

                            if(null == $check_if_already_added)
                            {
                                //add to cart
                                DB::connection('mongodb')->table('cart')->insert(
                                    ['item_id' => (int)$objItem->item_id, 'user_id' => (int)$user_id, 'session_id' => session_id(), 'qty'=> (int)$qty, 'size' => $size, 'price' => (int)$objItem->price, 'coupon_added'=>0, 'added_at'=>getMongoDate(date('Y-m-d H:i:s'))]
                                );

                                return redirect()->route('cart');
                            }
                            else
                            {
                                $message[] = 'You already have added this item to your cart.';
                            }
                        }
                        else
                        {   
                           $message[] = 'Oops! the selected quantity is not available. Plese select lesser quantity.';
                        }
                    }

                }
		    	//other product images
		    	$objProductImages = array();

                if(is_array($message))
                {
                    $temp = '';

                    foreach($message as $value)
                    {
                        $temp = $temp.$value.'<br>';
                    }

                    $message = $temp;
                }

    			return view('product.product',compact('objCouponMaster','total_available_qty','message','show_size_chart','objSizes','objProductImages','objItem','objCategory','objType','arrCetegory_id_obj','arrType_id_obj'));
    		}
    		else
    		{
    			abort(404);
    		}
    	}
    	else
    	{
    		abort(404);
    	}
    }

    public function add_to_cart()
    {

    }
}
