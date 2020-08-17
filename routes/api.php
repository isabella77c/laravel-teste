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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/lojas','LojasController@index')->name('lojas');
Route::post('/lojas','LojasController@store');
Route::get('/lojas/{id}','LojasController@show');
Route::put('/lojas/{id}','LojasController@update');
Route::delete('/lojas/{id}','LojasController@destroy');

Route::get('/lojas/{lojaId}/produtos', 'ProdutosController@buscaPorloja');


Route::get('/produtos','ProdutosController@index')->name('produtos');
Route::post('/produtos','ProdutosController@store');
Route::get('/produtos/{id}','ProdutosController@show');
Route::put('/produtos/{id}','ProdutosController@update');
Route::delete('/produtos/{id}','ProdutosController@destroy');
