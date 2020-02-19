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
    return view('index');
});

Route::get('/polices', 'ControladorPolice@indexView');

Route::get('/clients', 'ControladorClient@index');
Route::get('/clients/novo', 'ControladorClient@create');
Route::post('/clients', 'ControladorClient@store');
Route::get('/clients/apagar/{id}', 'ControladorClient@destroy');
Route::get('/clients/editar/{id}', 'ControladorClient@edit');
Route::post('/clients/{id}', 'ControladorClient@update');
