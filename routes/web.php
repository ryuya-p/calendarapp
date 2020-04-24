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
    Route::get('event/create', 'EventController@add');
    Route::post('event/create', 'EventController@create');
    Route::get('event/show', 'EventController@show');
    Route::get('event/edit', 'EventController@edit');
    Route::post('event/edit', 'EventController@update');
    Route::get('event/delete', 'EventController@delete');
    //家計簿コントローラー
    Route::get('expenses/create', 'ExpensesController@add');
    Route::post('expenses/create', 'ExpensesController@create');
    Route::get('expenses/show', 'ExpensesController@show');
    Route::get('expenses/edit', 'ExpensesController@edit');
    Route::post('expenses/edit', 'ExpensesController@update');
    Route::get('expenses/delete', 'ExpensesController@delete');
    //todoコントローラー
    Route::get('todo/create', 'TodoController@add');
    Route::post('todo/create', 'TodoController@create');
    Route::get('todo/show', 'TodoController@show');
    Route::get('todo/edit', 'TodoController@edit');
    Route::post('todo/update', 'TodoController@update');
    Route::get('todo/delete', 'TodoController@delete');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
