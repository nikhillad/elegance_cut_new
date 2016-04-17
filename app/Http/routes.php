<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home', 'uses' => 'IndexController@index']);

	Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'UserController@login']);

	Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@logout']);

	Route::match(['get', 'post'], 'sign-up', ['as' => 'register', 'uses' => 'UserController@register']);

	Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@index']);

	Route::get('cart/remove/{item_id}', ['as' => 'remove_cart_item', 'uses' => 'CartController@remove_item']);

	Route::post('cart/change-qty', ['as' => 'change_qty', 'uses' => 'CartController@change_qty']);

	Route::post('cart/apply-coupon/{item_id}', ['as' => 'apply_coupon', 'uses' => 'CartController@apply_coupon']);

	Route::get('my-account', ['as' => 'account', 'uses' => 'UserController@account']);

	Route::get('my-orders', ['as' => 'orders', 'uses' => 'UserController@orders']);

	Route::match(['get', 'post'], 'about-us', ['as' => 'about_us', 'uses' => 'IndexController@about_us']);

    Route::match(['get', 'post'], 'contact-us', ['as' => 'contact_us', 'uses' => 'IndexController@contact_us']);

    Route::match(['get', 'post'], '/my-account/deactivate', ['as' => 'deactivate_account', 'uses' => 'UserController@deactivate_account']);

    Route::match(['get', 'post'], '/my-account/edit', ['as' => 'edit_account', 'uses' => 'UserController@edit_account']);

    Route::get('verify/{token_type}', ['as' => 'generate_verify_link', 'uses' => 'UserController@generate_verify_link']);

    Route::get('category/{cat_code}', ['as' => 'category_page', 'uses' => 'CategoryController@index']);

    Route::get('type/{category}/{type_code}', ['as' => 'type_page', 'uses' => 'TypeController@index']);

    Route::match(['get','post'],'product/{item_code}', ['as' => 'product', 'uses' => 'ItemController@index']);

    Route::get('product/add-to-cart', ['as' => 'add_to_cart', 'uses' => 'ItemController@add_to_cart']);

    Route::match(['get','post'], 'checkout', ['as' => 'checkout', 'uses' => 'CartController@checkout']);

    Route::get('cart/make-payment/{uid}/{session}/{hash}', ['as' => 'make_payment', 'uses' => 'CartController@make_payment']);
});
