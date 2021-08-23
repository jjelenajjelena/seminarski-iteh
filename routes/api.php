<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function () {
    Route::middleware('auth.doktor')->get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:api')->group(function () {
    Route::get('vakcine', 'VakcinaController@get');
    Route::get('ustanove', 'UstanovaController@get');
    Route::put('prijave/{prijava}', 'PrijavaController@updatePrijava');
    Route::post('prijave', 'PrijavaController@createPrijava');
});

Route::get('prijave/datatable', 'PrijavaController@getDatatable');

Route::middleware(['auth:api'])->group(function () {
    Route::middleware(['auth.doktor'])->group(function () {

        Route::get('prijave', 'PrijavaController@get');
        Route::delete('prijave/{prijava}', 'PrijavaController@delete');
        Route::put('prijave/{prijava}/update', 'PrijavaController@updateDoktor');
    });
});
