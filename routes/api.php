<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'API\APIRegisterController@register');
Route::post('login', 'API\APIRegisterController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('categories','API\APICategoryController@index');
Route::get('categories/{id}','API\APICategoryController@show');
Route::post('categories','API\APICategoryController@store');
Route::put('categories/{id}/edit','API\APICategoryController@update');
Route::delete('categories/{id}/delete','API\APICategoryController@destroy');

