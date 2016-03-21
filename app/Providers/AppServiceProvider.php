<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['main','main_wo_header_nav','category_items'], function($view)
        {
            $this->user_session = validate_session();

            //fetch all the categories
            $arrCategory = DB::table('category_master')->get();

            //fetch all the item types
            $arrType = DB::table('type_master')->get();

            foreach ($arrCategory as $key => $category) {
               
                foreach ($arrType as $key1 => $type) {
                    if($type->category == $category->cat_id)
                        $arrTypeCategoryWise[$category->cat_id][] = $type;
                }
            }

            //get category id versus category name array
            $arrCetegory_id_name = getKeyValueArray('cat_id','name',$arrCategory,'object');

            $arrType_id_name = getKeyValueArray('type_id','name',$arrType,'object');
            
            //get cart items count
            if($this->user_session->is_logged_in)
                $user_id = $this->user_session->user_id;
            else
                $user_id = null;

            //get cart details
            if($this->user_session->is_logged_in)
                $count_cart = DB::connection('mongodb')->collection('cart')->where('user_id',$user_id)->orWhere('session_id',session_id())->count();
            else
                $count_cart = DB::connection('mongodb')->collection('cart')->where('session_id',session_id())->count();
            

            $view->with(compact('count_cart','arrTypeCategoryWise','arrCategory','arrType','arrCetegory_id_name','arrType_id_name'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
