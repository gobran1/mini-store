<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('shop.index');
    })->name('main.show');
});
Route::get('/shop/{page?}',
    [
        'uses' => 'ProductController@index',
        'as' => 'shop.index',
    ]);


Route::group(['prefix' => 'user'], function () {

    Route::get('/signUp', [
        'uses' => 'UserController@showRegisterForm',
        'as' => 'user.showRegisterForm'
    ]);

    Route::post('/signUp', [
        'uses' => 'UserController@signUp',
        'middleware' => 'guest',
        'as' => 'user.signUp',
    ]);

    Route::get('/login', [
        'uses' => 'UserController@showLoginForm',
        'middleware' => 'guest',
        'as' => 'user.showLoginForm',
    ]);

    Route::post('/login', [
        'uses' => 'UserController@login',
        'middleware' => 'guest',
        'as' => 'user.login',
    ]);

    Route::get('/profile', [
        'uses' => 'UserController@profile',
        'as' => 'user.profile',
        'middleware' => 'auth',
    ]);

    Route::post('/logout', [
        'uses' => 'UserController@logout',
        'as' => 'user.logout',
        'middleware' => 'auth',
    ]);
});

Route::group(['prefix' => 'product'], function () {
    Route::post('/addProducts', [
        'uses' => 'ProductController@addToCart',
        'as' => 'products.add',
    ]);

});

Route::get('/shopping/details',[
    'uses' => 'ProductController@showCart',
    'as' => 'cart.show',
]);

Route::get('checkout',[
    'uses' => 'ProductController@showCheckoutForm',
    'middleware' => 'auth',
    'as' => 'checkout',
]);
Route::post('checkout',[
    'uses' => 'ProductController@Checkout',
    'middleware' => 'auth',
    'as' => 'checkout',
]);

Route::get('/remove/one/{id}',[
    'uses' => 'ProductController@removeItemByOne',
    'as' => 'removeOne',
]);
Route::get('/remove/item/{id}',[
    'uses' => 'ProductController@removeItem',
    'as' => 'removeItem',
]);