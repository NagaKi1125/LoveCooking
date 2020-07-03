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

    //some tips for edit comment
    ///dishes/comment/3/edit?__method=PUT (@Path?__method=PUT) this is put method not post =)) LOL
    Route::post('dishes/comment/{cmtid}/edit','API\APICommentController@update');

    Route::delete('dishes/comment/{cmtid}/delete','API\APICommentController@delete');

    //Menu (make new )  - add,remove and delete
    Route::post('menu-new','API\APIMenuController@new');
    //?__method=PUT (@Path?__method=PUT)
    Route::post('menu-add/{id}','API\APIMenuController@add');
    Route::post('menu-remove/{id}','API\APIMenuController@remove');
    Route::delete('menu-delete/{id}','API\APIMenuController@delete');
});

Route::middleware('jwt.refresh')->get('/token/refresh', 'API\APIAuthController@refresh');

//categories
Route::get('categories','API\APICategoryController@index');
Route::get('categories/{id}','API\APICategoryController@show');

//market
Route::get('markets', 'API\APIMarketController@index');
Route::get('markets/{id}', 'API\APIMarketController@show');

//dish
Route::get('dishes', 'API\APIDishController@index');
Route::get('dishes/{id}', 'API\APIDishController@show');


//dishhistory
Route::get('dish-history', 'API\APIDishHistoryController@index');
Route::get('dish-history/{id}', 'API\APIDishHistoryController@show');

//menu
Route::get('menus', 'API\APIMenuController@index');
Route::get('menus/{id}', 'API\APIMenuController@show');



