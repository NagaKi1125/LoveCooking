<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'admin','middleware'=>'auth','as'=>'admin.'], function(){
    //user manager
    Route::get('/','AdminController@index')->name('index');

    Route::group(['prefix'=>'user','as'=>'user.'], function(){
        Route::put('{id}','UserController@update')->name('update');
        Route::get('{id}/edit','UserController@edit')->name('edit');
        Route::delete('{id}','UserController@delete')->name('delete');
    });
    //liked list
    Route::get('user/{id}/liked-list','AdminController@userLikedList')->name('user.liked');
    //follow list
    Route::get('user/{id}/follow-list','AdminController@userFollowList')->name('user.follow');

    // categories
    Route::group(['prefix' => 'categories','as'=>'categories.'], function () {
        Route::get('','AdminController@cateIndex')->name('index');
        Route::post('','CategoryController@store')->name('store');
        Route::put('{id}','CategoryController@update')->name('update');
        Route::get('{id}/edit','CategoryController@edit')->name('edit');
        Route::delete('{id}','CategoryController@delete')->name('delete');
    });

     // market
    Route::group(['prefix' => 'market','as'=>'market.'], function () {
        Route::get('','AdminController@marketIndex')->name('index');
        Route::post('','MarketController@store')->name('store');
        Route::put('{id}','MarketController@update')->name('update');
        Route::get('{id}/edit','MarketController@edit')->name('edit');
        Route::delete('{id}','MarketController@delete')->name('delete');
    });

      // dish
    Route::group(['prefix' => 'dish','as'=>'dish.'], function () {
        Route::get('','AdminController@dishIndex')->name('index');
        Route::get('add','DishController@addIndex')->name('add');
        Route::post('','DishController@store')->name('store');
        Route::put('{id}','DishController@update')->name('update');
        Route::get('{id}/edit','DishController@edit')->name('edit');
        Route::delete('{id}','DishController@delete')->name('delete');
    });

    Route::group(['prefix'=>'dish-check','as'=>'dish.check.'],function(){
        Route::get('','DishCheckController@index')->name('index');
        Route::put('{id}/check','DishCheckController@check')->name('checked');
        Route::delete('{id}/delete','DishCheckController@delete')->name('delete');
    });

    //comment
    Route::group(['prefix'=>'comment','as'=>'comment.'],function(){
        Route::get('','AdminController@cmtIndex')->name('index');
        Route::delete('{id}/delete','CommentController@delete')->name('delete');
    });

    //dish_history
    Route::group(['prefix'=>'dishhistory','as'=>'history.'],function(){
        Route::get('','AdminController@historyIndex')->name('index');
        Route::get('add','DishHistoryController@addIndex')->name('add');
        Route::post('','DishHistoryController@store')->name('store');
    });

    // menu
    Route::group(['prefix'=>'menu','as'=>'menu.'],function(){
        Route::get('','AdminController@menuIndex')->name('index');
    });




});
