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

Route::get('/', 'Frontend\HomeController@index');

Route::get('detail/{id}', [
    'uses' => 'Frontend\HomeController@detail',
    'as'   => 'detail'
]);

Route::get('customer/register', [
    'uses' => 'Frontend\HomeController@register_customer',
    'as'   => 'register'
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as'   => 'admin'
    ]);

    Route::resource('logos', 'LogoController');
    Route::group(['as' => 'logos.', 'prefix' => 'logos'], function() {
        Route::get('{logo_id}/requirements', [
            'uses' => 'RequirementsController@listByLogo',
            'as'   => 'requirements'
        ]);
        Route::get('{logo_id}/images', [
            'uses' => 'LogoController@editImages',
            'as'   => 'images'
        ]);
        Route::post('{logo_id}/images/list', [
            'uses' => 'ImagesLogoController@listByLogo',
            'as'   => 'images.list'
        ]);
        Route::post('{logo_id}/images/create', [
            'uses' => 'ImagesLogoController@storeByLogo',
            'as'   => 'images.create'
        ]);
        Route::post('images/{id}/update', [
            'uses' => 'ImagesLogoController@update',
            'as'   => 'images.update'
        ]);
        Route::post('images/{id}/destroy', [
            'uses' => 'ImagesLogoController@destroy',
            'as'   => 'images.destroy'
        ]);
    });

    Route::resource('customers', 'CustomerController');
    Route::resource('categories', 'CategoryController');
    Route::resource('keywords', 'KeywordController');

});


// Authentication routes...
Route::get('login', [
    'uses'  => 'Auth\AuthController@getLogin',
    'as'    => 'login'
]);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', [
    'uses'  => 'Auth\AuthController@getLogout',
    'as'    => 'logout'
]);

Route::auth();


