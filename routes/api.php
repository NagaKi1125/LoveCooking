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
    Route::get('follow-liked','API\APIFollowLikedController@show');
    Route::get('user-menu','API\APIMenuController@show');
    Route::get('user-menu-spinner','API\APIMenuController@spinner');
    Route::get('user-dishes','API\APIUserController@userDishes');

    Route::get('user-info', 'API\APIUserController@show');
    Route::post('user-update','API\APIUserController@update');
	Route::post('user-change-password','API\APIUserController@changePassword');

    //dishes
    Route::post('dishes/upload', 'API\APIDishController@store');
    Route::post('dishes-edit/{id}', 'API\APIDishController@update');
    Route::delete('dishes-delete/{id}', 'API\APIDishController@delete');

    //dish love and loveless
    Route::put('dishes/{id}/love','API\APIUserLikedListController@love');
    Route::put('dishes/{id}/loveless','API\APIUserLikedListController@loveless');

    //user comment
    Route::post('dishes/{id}/comment','API\APICommentController@comment');

    //some tips for edit comment
    ///dishes/comment/3/edit
    Route::post('dishes/comment/{cmtid}/edit','API\APICommentController@update');
    Route::delete('dishes/comment/{cmtid}/delete','API\APICommentController@delete');

    //Menu (make new )  - add,remove and delete
    Route::post('menu-new','API\APIMenuController@new');
    Route::post('menu-add/{id}','API\APIMenuController@add');
    Route::post('menu-remove/{id}','API\APIMenuController@remove');
    Route::delete('menu-delete/{id}','API\APIMenuController@delete');

	//categories added
    Route::post('cate-add','API\APICategoryController@store');

    //follows  - unfollow
    Route::post('unfollow/{fid}','API\APIFollowLikedController@unfollow');
    //follows - follow
    Route::post('follow/{fid}','APi\APIFollowLikedController@follow');
});

Route::middleware('jwt.refresh')->get('/token/refresh', 'API\APIAuthController@refresh');

//search
Route::get('search',"API\APISearchController@searchDish");

//categories
Route::get('categories','API\APICategoryController@index');
Route::get('categories/{id}','API\APICategoryController@show');

//market
Route::get('markets', 'API\APIMarketController@index');
Route::get('markets/{id}', 'API\APIMarketController@show');

//dish
Route::get('dishes', 'API\APIDishController@index');
Route::get('dishes/{id}', 'API\APIDishController@show');
Route::get('dishes-get-edit/{id}', 'API\APIDishController@getEdit');


//dishhistory
Route::get('dish-history', 'API\APIDishHistoryController@index');
Route::get('dish-history/{id}', 'API\APIDishHistoryController@show');

//menu
Route::get('menus', 'API\APIMenuController@index');
Route::get('menus/{id}', 'API\APIMenuController@show');

//comment
Route::get('dishes/{id}/comment','API\APICommentController@show');

