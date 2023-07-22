<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Frontend'] ,function () {
    // Home
    Route::get('/', 'HomeController@index');
    Route::get('/homepage', 'HomeController@index');
    Route::get('/homeaddcart/{product_id}', 'HomeController@homeaddcart');
    Route::get('/addfavorite/{product_id}', 'HomeController@addfavorite');
    Route::post('/filterproduct', 'HomeController@filterproduct');
    Route::post('/search-product', 'HomeController@searchproduct');
    // Route::post('/autocomplete-ajax', 'HomeController@autocompleteajax');

    // Comments
    Route::post('/addcomment', 'ProductController@addcomment');  
    Route::get('/deletecomment/{comment_id}', 'ProductController@deletecomment');
    
    // List Category
    Route::get('/category-product/{id}', 'CategoryController@listcategory');
    Route::get('/brand-product/{id}', 'BrandController@listbrand');
    Route::get('/product-detail/{id}', 'ProductController@productdetail');
    
    // Cart
    Route::post('/savecart', 'CartController@savecart');
    Route::post('//updatecart-qty', 'CartController@updatecartqty');
    Route::get('/showcart', 'CartController@showcart');
    Route::post('/deletecart', 'CartController@deletecart');
    
    // Checkout
    Route::get('/login-checkout', 'CheckoutController@logincheckout');
    Route::get('/checkout/{customer_id}', 'CheckoutController@checkout');
    Route::post('/savecheckout', 'CheckoutController@savecheckout');
    Route::get('/showcheckout', 'CheckoutController@showcheckout');


    // Login - Sign up -  Logout
    Route::post('/customer-signup' , 'LoginController@customersignup');
    Route::post('/customer-login' , 'LoginController@customerlogin');
    Route::get('/checklogin', 'LoginController@checklogin');
    Route::get('/customer-logout', 'LoginController@customerlogout');
    
    // Payment
    Route::get('/payment', 'PaymentController@showpayment');
    Route::post('/order', 'PaymentController@order');
    
    // Account
    Route::get('/account-info/{customer_id}', 'AccountController@account_info');
    Route::get('/history/{customer_id}', 'AccountController@history');
    Route::get('/historydetails/{order_id}', 'AccountController@historydetails');
    Route::get('/customerupdate/{customer_id}', 'AccountController@customerupdate');
    Route::get('/detailscancel/{order_id}', 'AccountController@detailscancel');
    Route::get('/account-info', 'AccountController@showinfo');
    Route::get('/account/{customer_id}', 'AccountController@account');
    Route::get('/favorite/{customer_id}', 'AccountController@favorite');
    Route::get('/deletefavorite/{product_id}', 'AccountController@deletefavorite');
    Route::get('/customercancel/{order_id}', 'AccountController@customercancel');
    Route::post('/accountchange/{customer_id}', 'AccountController@accountchange');
    Route::post('/customersave/{customer_id}', 'AccountController@customersave');

});

Route::group(['namespace' => 'Backend'], function () {
    // Amin
    Route::get('/admin', 'AdminController@index');
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/logout', 'AdminController@logout');
    Route::post('/login', 'AdminController@login');

    // Category
    Route::get('/addcategory', 'CategoryController@addcategory');
    Route::get('/listcategory', 'CategoryController@listcategory');
    Route::get('/editcategory/{id}', 'CategoryController@editcategory');
    Route::get('/deletecategory/{id}', 'CategoryController@deletecategory');
    Route::post('/updatecategory/{id}', 'CategoryController@updatecategory');
    Route::post('/savecategory', 'CategoryController@savecategory');

    // Brand
    Route::get('/addbrand', 'BrandController@addbrand');
    Route::get('/listbrand', 'BrandController@listbrand');
    Route::get('/editbrand/{id}', 'BrandController@editbrand');
    Route::get('/deletebrand/{id}', 'BrandController@deletebrand');
    Route::post('/updatebrand/{id}', 'BrandController@updatebrand');
    Route::post('/savebrand', 'BrandController@savebrand');

    // Product
    Route::get('/addproduct', 'ProductController@addproduct');
    Route::get('/listproduct', 'ProductController@listproduct');
    Route::get('/editproduct/{id}', 'ProductController@editproduct');
    Route::get('/deleteproduct/{id}', 'ProductController@deleteproduct');
    Route::post('/updateproduct/{id}', 'ProductController@updateproduct');
    Route::post('/saveproduct', 'ProductController@saveproduct');

    // User
    Route::get('/listcustomer', 'CustomerController@listcustomer');

    // Order
    Route::get('/listorder', 'OrderController@listorder');
    Route::get('/showorderdetails/{orderId}', 'OrderController@showorderdetails');
    Route::get('/confirm/{order_id}', 'OrderController@confirm');
    Route::get('/cancel/{order_id}', 'OrderController@cancel');
    Route::get('/deleteorder/{order_id}', 'OrderController@deleteorder');

    // Comment
    Route::get('/listcomment', 'CommentController@listcomment');
    Route::get('/commentdetails/{product_id}', 'CommentController@commentdetails');
    Route::get('/deletecomment/{comment_id}', 'CommentController@deletecomment');

    // Statistical
    Route::post('/dailystatis', 'StatisticalController@dailystatis');
    Route::get('/statistical', 'StatisticalController@statistical');
    Route::post('/filter-by-date', 'StatisticalController@filter_by_date');
    Route::post('/dashboard-filter', 'StatisticalController@dashboard_filter');
    Route::post('/autodisplay', 'StatisticalController@autodisplay');
    Route::post('/filter-by-date-cate', 'StatisticalController@filter_by_date_cate');
});



