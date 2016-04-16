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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Frontend\HomeController@index');


Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function(){

    Route::get('/', function () {
        return view('welcome');
    });
    //dd("HOLA");

    /*Route::get('logos', function(){
        dd("Hola");
        return view('admin.logos.index');
    });*/
    Route::resource('logos', 'LogoController');
    Route::resource('customers', 'CustomerController');
    Route::resource('categories', 'CategoryController');

});
