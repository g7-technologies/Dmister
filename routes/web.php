<?php

Route::get('/test','AdminController@test');

//-------------------company portal Routes------------------------------------------------------
Route::get('/','CustomerController@login');
Route::get('/login','CustomerController@login');
Route::get('/customer_registration','CustomerController@customer_registration');
Route::post('/customer_register','CustomerController@customer_register');
Route::post('/check_login_details','CustomerController@check_login_details');
Route::get('/lost_password','CustomerController@lost_password');
Route::get('/recover_password/{token}','CustomerController@recover_password');
Route::post('/reset_password_submit','CustomerController@reset_password_submit');

//---------------------------------------Company Auth Routes------------------------------------------
Route::group(['middleware' => ['auth:customer','backHistory']], function()
{
    //----------Customer Dashboard routes---------------
    Route::get('/customer_dashboard','CustomerController@customer_dashboard');
    Route::post('/customer_chart_orders','CustomerController@customer_chart_orders')->name('customer_chart_orders');
    //----------Customer Orders routes-------------------
    Route::get('customer_create_order','CustomerController@customer_create_order');
    Route::post('customer_add_order','CustomerController@customer_add_order');
    Route::get('customer_all_orders','CustomerController@customer_all_orders');
    Route::get('customer_awaiting_orders','CustomerController@customer_awaiting_orders');
    Route::get('customer_pending_orders','CustomerController@customer_pending_orders');
    Route::get('customer_processing_orders','CustomerController@customer_processing_orders');
    Route::get('customer_inprogress_orders','CustomerController@customer_inprogress_orders');
    Route::get('customer_completed_orders','CustomerController@customer_completed_orders');
    Route::get('customer_partial_orders','CustomerController@customer_partial_orders');
    Route::get('customer_cancelled_orders','CustomerController@customer_cancelled_orders');
    Route::get('customer_refunded_orders','CustomerController@customer_refunded_orders');
    //----------Customer auth routes---------------------
    Route::get('customer_logout','CustomerController@customer_logout');
    Route::get('customer_change_password','CustomerController@customer_change_password');
    Route::post('customer_change_password_submit','CustomerController@customer_change_password_submit');
    //----------Customer services routes-----------------
    Route::post('/get_services','CustomerController@get_services')->name('get_services');
    Route::post('/get_service_info','CustomerController@get_service_info')->name('get_service_info');
    //----------Customer funds routes---------------------
    Route::get('customer_add_funds','CustomerController@customer_add_funds');
    Route::get('customer_add_amount/{id}','CustomerController@customer_add_amount');
    Route::post('customer_deposit','CustomerController@customer_deposit');
    Route::get('customer_transaction_history','CustomerController@customer_transaction_history');
    Route::get('customer_funds_history','CustomerController@customer_funds_history');

    
});

//---------------------------------------Admin Auth Routes------------------------------------------

Route::get('/admin_login','AdminController@login');
Route::post('/login_submit','AdminController@login_submit');
Route::get('/forgot_password','AdminController@forgot_password');
Route::post('/forgot_password_submit','AdminController@forgot_password_submit');

Route::group(['middleware' => ['auth:admin','backHistory']], function()
{
    //----------admin logout----------------------
    Route::get('/logout','AdminController@logout');

    //----------admin Dashboard--------------------
    Route::get('/admin_dashboard','AdminController@dashboard');
    Route::post('/chart_orders','AdminController@chart_orders')->name('chart_orders');
    
    //----------admin Profile-----------------------
    Route::get('/change_password','AdminController@change_password');
    Route::post('/change_password_submit','AdminController@change_password_submit');

    //----------Admin Orders routes-------------------
    Route::get('all_orders','AdminController@all_orders');
    Route::get('awaiting_orders','AdminController@awaiting_orders');
    Route::get('pending_orders','AdminController@pending_orders');
    Route::get('processing_orders','AdminController@processing_orders');
    Route::get('inprogress_orders','AdminController@inprogress_orders');
    Route::get('completed_orders','AdminController@completed_orders');
    Route::get('partial_orders','AdminController@partial_orders');
    Route::get('cancelled_orders','AdminController@cancelled_orders');
    Route::get('refunded_orders','AdminController@refunded_orders');

    //----------Admin funds routes---------------------
    Route::get('transactions','AdminController@transactions');
    Route::get('funds','AdminController@funds');
    Route::get('approve_funds/{id}','AdminController@approve_funds');
    Route::get('cancel_funds/{id}','AdminController@cancel_funds');

    //---------Admin Coin routes------------------------
    Route::get('add_coin','AdminController@add_coin');
    Route::get('view_coins','AdminController@view_coins');
    Route::post('store_coin','AdminController@store_coin');
    Route::get('disable_coin/{id}','AdminController@disable_coin');
    Route::get('enable_coin/{id}','AdminController@enable_coin');
    Route::get('edit_coin/{id}','AdminController@edit_coin');
    Route::post('update_coin','AdminController@update_coin');

    //---------Admin Category routes------------------------
    Route::get('view_categories','AdminController@view_categories');
    Route::get('disable_category/{id}','AdminController@disable_category');
    Route::get('enable_category/{id}','AdminController@enable_category');
    Route::get('edit_category/{id}','AdminController@edit_category');
    Route::post('update_category','AdminController@update_category');

    //---------Admin Services routes------------------------
    Route::get('view_services','AdminController@view_services');
    Route::get('disable_service/{id}','AdminController@disable_service');
    Route::get('enable_service/{id}','AdminController@enable_service');
    Route::get('edit_service/{id}','AdminController@edit_service');
    Route::post('update_service','AdminController@update_service');
});	

