<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

        Route::get('/districts','LocationControllers@index');
        Route::get('communities','AdminLocationController@communities');
        Route::get('add-community','AdminLocationController@add_community');
        Route::post('add-community','AdminLocationController@save_community');
        Route::get('edit-community/{id}','AdminLocationController@edit_community');
        Route::post('edit-community/{id}','AdminLocationController@update_community');


