<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/getList/{status}', 'App\Http\Controllers\HomeController@getList')->name('getList');
Route::post('/saveTask', 'App\Http\Controllers\HomeController@saveTask')->name('saveTask');
Route::post('/changeComplete', 'App\Http\Controllers\HomeController@changeComplete')->name('changeComplete');
Route::post('/deleteRecord', 'App\Http\Controllers\HomeController@deleteRecord')->name('deleteRecord');



