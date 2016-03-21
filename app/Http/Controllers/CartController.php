<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
use Config;

class CartController extends Controller
{
    public function index()
    {
    	if($this->user_session->is_logged_in)
    		$user_id = $this->user_session->user_id;
    	else
    		$user_id = null;

    	//get cart details
    	if($this->user_session->is_logged_in)
    		$arrCartItems = DB::connection('mongodb')->collection('cart')->where('user_id',$user_id)->orWhere('session_id',session_id())->get();
    	else
    		$arrCartItems = DB::connection('mongodb')->collection('cart')->where('session_id',session_id())->get();
    	

    	$cart_total_price = 0;
    	$cart_total_items = 0;

    	foreach ($arrCartItems as $key => $value) {
    		$cart_total_price = $cart_total_price + ($value['price']*$value['qty']);
    		$cart_total_items++;

    		$item = App\ItemMaster::where('item_id',$value['item_id'])->where('status',1)->first();

    		if(null != $item)
    		{
    			//check if offers available for item type
    			//get coupon information if any	
	            $intCouponMaster = DB::table('coupon_master')
	                    ->join('coupon_type_master','coupon_type_master.coupon_id','=','coupon_master.coupon_id')
	                    ->where('coupon_master.status', 1)
	                    ->where('coupon_type_master.type_id', $item->item_type)
	                    ->select('coupon_master.*')
	                    ->count();

	            if($intCouponMaster > 0)        
	           		$item->offers = true;        
    			else
    				$item->offers = false;

    			$objCartItems[$value['item_id']] = $item;
    		}
    		else
    			unset($arrCartItems[$key]);
    	}

    	//shipping charges and vat
    	$shipping_charges = 0;
    	$vat = 0;

    	$total_price = $cart_total_price + $shipping_charges + $vat;

    	return view('user.cart',compact('total_price','shipping_charges','vat','objCartItems','arrCartItems','cart_total_price','cart_total_items'));
    }

    public function remove_item(Request $request, $item_id = '')
    {
    	if($item_id != '')
    	{
    		if($this->user_session->is_logged_in)
    		{
    			$arrCartItems = DB::connection('mongodb')->collection('cart')
    							->where( function ( $query )
							    {
							        $query->where('user_id',(int)$this->user_session->user_id)
							            ->orWhere('session_id',session_id());
							    })
    							->where('item_id',(int)$item_id)->delete();
    		}
    		else
    		{
    			$arrCartItems = DB::connection('mongodb')->collection('cart')->where('session_id',session_id())->where('item_id',(int)$item_id)->delete();
    		}

    	}

    	return redirect()->route('cart');
    }

    public function change_qty(Request $request)
    {
    	$qty = $request->input('qty','');
    	$item_id = $request->input('item_id','');

    	if($qty != '' && $item_id != '' && $qty > 0)
    	{
    		//check if given qty is valid
    		$objItem = App\ItemMaster::where('item_id',$item_id)->where('status',1)->first();

    		if(null == $objItem)
    		{
    			$return['error'] = true;
    			$return['message'] = 'Invalid request.';
    			return json_encode($return);
    		}

    		if($objItem->qty==null)
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

            $total_available_qty = 0; 
            if($show_size_chart)
            {
                foreach ($objSizes as $key => $value) {
                    $total_available_qty = $total_available_qty + $value->qty;
                }
            }
            else
            {
                if($objItem->qty != null)
                    $total_available_qty = $objItem->qty;
            }    

            //change quantity if every condition is satisfying
    		if($qty != '' && is_numeric($qty) && $qty <= $total_available_qty)
            {
	    		if($this->user_session->is_logged_in)
	    		{
	    			$objCartItem = App\CartMaster::where( function ( $query )
							    {
							        $query->where('user_id',(int)$this->user_session->user_id)
							            ->orWhere('session_id',session_id());
							    })
    							->where('item_id',(int)$item_id)->first();
	    		}
	    		else
	    		{
	    			$objCartItem = App\CartMaster::where('session_id',session_id())->where('item_id',(int)$item_id)->first();
	    		}

	    		if(null != $objCartItem)
	    		{
		    		$objCartItem->qty = $qty;
		    		$objCartItem->save();
	    			$return['error'] = false;
	    		}
	    		else
	    		{
	    			$return['error'] = true;
    				$return['message'] = 'Invalid request.';		
	    		}		
    		}
    		else
    		{
    			$return['error'] = true;
    			$return['message'] = 'The selected quantity is not available.';
    		}

    	}
    	else
    	{
    		$return['error'] = true;
    		$return['message'] = 'Invalid parameters.';
    	}

    	return json_encode($return);
    }

    public function apply_coupon(Request $request,$item_id='')
    {
    	$coupon_code = trim($request->input('coupon_code',''));

    	if($item_id != '' && $coupon_code != '')
    	{
    		//find item in db
    		$objItem = App\ItemMaster::where('item_id',$item_id)->where('status',1)->first();

    		//find item in mongo cart
    		if($this->user_session->is_logged_in)
    		{
    			$objCartItem = App\CartMaster::where( function ( $query )
						    {
						        $query->where('user_id',(int)$this->user_session->user_id)
						            ->orWhere('session_id',session_id());
						    })
							->where('item_id',(int)$item_id)->first();
    		}
    		else
    		{
    			$objCartItem = App\CartMaster::where('session_id',session_id())->where('item_id',(int)$item_id)->first();
    		}

    		//if item found both in database and cart
    		if(null != $objItem && null != $objCartItem)
    		{
    			//check if item is still eligible for coupon addition
    			if($objCartItem->coupon_added == 1)
    			{
    				$_SESSION['elegance_cut']['error'] = 'Coupon has already activated for this item.';
            		return redirect('cart');
    			}

	    		//get coupon information if any
	            $objCouponMaster = DB::table('coupon_master')
	                    ->join('coupon_type_master','coupon_type_master.coupon_id','=','coupon_master.coupon_id')
	                    ->where('coupon_master.status', 1)
	                    ->where('coupon_type_master.type_id', $objItem->item_type)
	                    ->where('coupon_master.coupon_code', $coupon_code)
	                    ->select('coupon_master.*')
	                    ->first();

	            if($objCouponMaster != null)
	            {
	            	//everything is fine, add the coupon
	            	$coupon_discount_rate = $objCouponMaster->discount_percent;
	            	$discount_price = ($coupon_discount_rate/100)*$objCartItem->price;

	            	$objCartItem->price = $objCartItem->price - $discount_price;
	            	
	            	try{
	            		$objCartItem->save();
	            	}
	            	catch(Exception $e)
	            	{
	            		$_SESSION['elegance_cut']['error'] = 'We are sorry, could not add the coupon. Please try again or contact our customer service.';
            			return redirect('cart');
	            	}	

	            	$objCartItem->coupon_added = 1;
	            	$objCartItem->save();

	            	$_SESSION['elegance_cut']['success'] = 'The coupon has been successfully added.';
            		return redirect('cart');

	            }   
	            else
	            {
	            	$_SESSION['elegance_cut']['error'] = 'The coupon code, you have entered is invalid.';
            		return redirect('cart');
	            }     
            }
            else
            {
            	$_SESSION['elegance_cut']['error'] = 'Sorry, This item is no longer available. You can remove it from your cart.';
            	return redirect('cart');
            }
    	}
    	else
    	{
    		$_SESSION['elegance_cut']['error'] = 'Please enter coupon code.';
    		return redirect('cart');
    	}
    }

    public function checkout(Request $request)
    {
    	if($this->user_session->is_logged_in)
    		$user_id = $this->user_session->user_id;
    	else
    		$user_id = null;

    	$objUser = $this->user_session;

    	//get cart details
    	if($this->user_session->is_logged_in)
    		$arrCartItems = DB::connection('mongodb')->collection('cart')->where('user_id',$user_id)->orWhere('session_id',session_id())->get();
    	else
    		$arrCartItems = DB::connection('mongodb')->collection('cart')->where('session_id',session_id())->get();
    	
    	//get states and countries from database
    	$arrStates = DB::connection('mongodb')->collection('states')->get();
		$arrCountries = DB::connection('mongodb')->collection('countries')->get();	

		$arrStates_code_state = getKeyValueArray('code','state',$arrStates);
		$arrCountries_code_country = getKeyValueArray('code','country',$arrCountries);

		$form['fname'] 			= filter_form_input($request->input('fname',''));
		$form['lname'] 			= filter_form_input($request->input('lname',''));
    	$form['email'] 			= filter_form_input($request->input('email',''));
    	$form['mobile'] 		= filter_form_input($request->input('mobile',''));
    	$form['zip'] 			= filter_form_input($request->input('zip',''));
    	$form['address'] 		= filter_form_input($request->input('address1','').' '.$request->input('address2',''));
    	$form['city'] 			= filter_form_input($request->input('city',''));
    	$form['state'] 			= filter_form_input($request->input('state',''));
    	$form['country'] 		= filter_form_input($request->input('country',''));

    	$message = '';
    	$open_tab = '';

    	if ($request->isMethod('post')) 
    	{

	    	if($form['fname'] != '' && $form['lname'] != '' && $form['email'] != '' 
	    		&& $form['email'] != '' && $form['mobile'] != '' && $form['zip'] != ''
	    		&& $form['address'] != '' && $form['city'] != ''
	    		)
	    	{
	    		if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL))
	    		{
	    			$message[] = '-Please enter a valid email address.';
	    		}
		    		
		    	if(strlen($form['mobile']) > 10 || strlen($form['mobile']) < 10)	
			    {
			    	$message[] = '-Please enter valid 10 digit mobile number.';		
			    }
			    if(!is_numeric($form['mobile']))
		    	{
		    		$message[] = '-Please enter valid 10 digit mobile number.';		
		    	}
			    if($form['state'] == 'select' || $form['country'] == 'select' || !array_key_exists($form['state'], $arrStates_code_state)
    			||  !array_key_exists($form['country'], $arrCountries_code_country))
    			{
    				$message[] = '-Please select your state and country.';
    			}
			    
			    if(empty($message))
			    {
			    	try{
				    	//save user in database
				    	$objUserMaster = new App\UserMaster();

				    	$objUserMaster->fname 	 = $form['fname'];
				    	$objUserMaster->lname 	 = $form['lname'];
				    	$objUserMaster->email 	 = $form['email'];
				    	$objUserMaster->mobile 	 = $form['mobile'];
				    	$objUserMaster->zip_code = $form['zip'];
				    	$objUserMaster->state 	 = $form['state'];
				    	$objUserMaster->country  = $form['country'];
				    	$objUserMaster->city 	 = $form['city'];
				    	$objUserMaster->address  = $form['address'];
				    	$objUserMaster->password = md5(time());

			    		$res = $objUserMaster->save();

			    		$LastInsertId = $objUserMaster->user_id;
			    	}
			    	catch(\Exception $e)
			    	{
			    		$message[] = 'Looks like something went wrong or mostly the email you entered, already exists. Kindly register with different email id or contact our support at <a class="yellow-link" href="mailto:'.config('global.support_email').'">'.config('global.support_email').'</a>';
			    		$open_tab = 'shippingAddressLink';
			    	}

			    	if(isset($res) && $res == true && empty($message))
			    	{
			    		$objUser = $objUserMaster;
			    		$user_id = $objUser->user_id;
			    	}
			    	else if(empty($message))
			    	{
			    		$message[] = 'Something went wrong. Please try again.';
			    		$open_tab = 'shippingAddressLink';
			    	}
			    }		
			    			
	    	}
	    	else
	    	{
	    		$message[] = '-Please fill in all the fields.';
	    		$open_tab = 'shippingAddressLink';
	    	}
    	}

    	if($user_id != null)
    	{
	    	//set userid as current user in all the cart items for current session
	    	foreach ($arrCartItems as $key => $item) {
	    		$objCartItem = App\CartMaster::where('item_id',$item['item_id'])->first();

	    		$objCartItem->user_id = $user_id;
	    		$objCartItem->save();
	    	}

	    }

	    if(is_array($message))
    	{
    		$temp = '';

    		foreach($message as $value)
    		{
    			$temp = $temp.$value.'<br>';
    		}

    		$message = $temp;
    	}

    	$cart_total_price = 0;
    	$cart_total_items = 0;

    	foreach ($arrCartItems as $key => $value) {
    		$cart_total_price = $cart_total_price + ($value['price']*$value['qty']);
    		$cart_total_items++;
    	}

    	//shipping charges and vat
    	$shipping_charges = 0;
    	$vat = 0;

    	$total_price = $cart_total_price + $shipping_charges + $vat;

    	return view('user.checkout',compact('total_price','vat','shipping_charges','cart_total_items','cart_total_price','open_tab','form','arrCountries','arrStates','message','user_id','objUser','arrStates_code_state','arrCountries_code_country'));
    }
}
