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


Route::post('register', 'API\APIAuthController@register');
Route::post('login', 'API\APIAuthController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('auth', 'API\APIAuthController@user');
    Route::get('logout', 'API\APIAuthController@logout');
    //follow and dish liked
    Route::get('follow-liked','API\APIMenuFollowLikedController@show');
    Route::get('user-menu','API\APIMenuController@show');
    Route::get('user-info', 'API\APIUserController@show');

    //dishes
    Route::post('dishes', 'API\APIDishController@store');
    Route::put('dishes/{id}', 'API\APIDishController@update');
    Route::delete('dishes/{id}', 'API\APIDishController@delete');

    //dish love and loveless
    Route::put('dishes/{id}/love','API\APIUserLikedListController@love');
    Route::put('dishes/{id}/loveless','API\APIUserLikedListController@loveless');

    //user comment
    Route::post('dishes/{id}/comment','API\APICommentController@comment');
});

Route::middleware('jwt.refresh')->get('/token/refresh', 'API\APIAuthController@refresh');

//categories
Route::get('categories','API\APICategoryController@index');
Route::get('categories/{id}','API\APICategoryController@show');
Route::post('categories','API\APICategoryController@store');
Route::put('categories/{id}/edit','API\APICategoryController@update');
Route::delete('categories/{id}/delete','API\APICategoryController@destroy');

//market
Route::get('markets', 'API\APIMarketController@index');
Route::get('markets/{id}', 'API\APIMarketController@show');
Route::post('markets', 'API\APIMarketController@store');
Route::put('markets/{id}', 'API\APIMarketController@update');
Route::delete('markets/{id}', 'API\APIMarketController@delete');

//dish
Route::get('dishes', 'API\APIDishController@index');
Route::get('dishes/{id}', 'API\APIDishController@show');

//user
Route::get('users', 'API\APIUserController@index');
Route::post('users', 'API\APIUserController@store');
Route::put('users/{id}', 'API\APIUserController@update');
Route::delete('users/{id}', 'API\APIUserController@delete');

//dishhistory
Route::get('dish-history', 'API\APIDishHistoryController@index');
Route::get('dish-history/{id}', 'API\APIDishHistoryController@show');
Route::post('dish-history', 'API\APIDishHistoryController@store');
Route::put('dish-history/{id}', 'API\APIDishHistoryController@update');
Route::delete('dish-history/{id}', 'API\APIDishHistoryController@delete');

//menu
Route::get('menus', 'API\APIMenuController@index');
Route::get('menus/{id}', 'API\APIMenuController@show');
Route::post('menus', 'API\APIMenuController@store');
Route::put('menus/{id}', 'API\APIMenuController@update');
Route::delete('menus/{id}', 'API\APIMenuController@delete');



