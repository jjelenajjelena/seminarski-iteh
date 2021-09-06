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

Route::get('/jedna-prijava/{id}', 'PageController@jednaPrijava')->middleware('auth');
Route::get('/moja-prijava', 'PageController@mojaPrijava')->middleware('auth');
Route::get('/prijavljivanje', 'PageController@prijavljivanje')->middleware('auth');
Route::get('/pregled-prijava', 'PageController@pregledPrijava')->middleware('auth.doktor');
Route::get('/statistika', 'PageController@statistikaPrijava')->middleware('auth.doktor');
Route::get('/doktor/obaveze', 'PageController@doktorObaveze')->middleware('auth.doktor');
