<?php

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

Route::group(['prefix' => 'regular','middleware' => 'auth'], function() { 
    //カレンダーコントローラー
    Route::get('calendar', 'Regular\CalendarController@index');
    Route::get('calendar/nextmonth', 'Regular\CalendarController@nextmonth');
    Route::get('calendar/prevmonth', 'Regular\CalendarController@prevmonth');
    //イベントコントローラー
    Route::get('event/create', 'Regular\EventController@add');
    Route::post('event/create', 'Regular\EventController@create');
    Route::get('event/show', 'Regular\EventController@show');
    Route::get('event/edit', 'Regular\EventController@edit');
    Route::post('event/edit', 'Regular\EventController@update');
    Route::get('event/delete', 'Regular\EventController@delete');
    //家計簿コントローラー
    Route::get('expenses/create', 'Regular\ExpensesController@add');
    Route::post('expenses/create', 'Regular\ExpensesController@create');
    Route::get('expenses/show', 'Regular\ExpensesController@show');
    Route::get('expenses/edit', 'Regular\ExpensesController@edit');
    Route::post('expenses/edit', 'Regular\ExpensesController@update');
    Route::get('expenses/delete', 'Regular\ExpensesController@delete');
    //todoコントローラー
    Route::get('todo/create', 'Regular\TodoController@add');
    Route::post('todo/create', 'Regular\TodoController@create');
    Route::get('todo/show', 'Regular\TodoController@show');
    Route::get('todo/edit', 'Regular\TodoController@edit');
    Route::post('todo/update', 'Regular\TodoController@update');
    Route::get('todo/delete', 'Regular\TodoController@delete');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
