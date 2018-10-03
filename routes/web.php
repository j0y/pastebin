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


Route::get('/', 'SnippetController@index');
Route::post('/', 'SnippetController@submit');
Route::get('/{uuid}', 'SnippetController@view');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
