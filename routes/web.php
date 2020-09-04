<?php

use Illuminate\Support\Facades\Route;

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
    return view('Inicio');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/EServico/export', 'ServicoController@export')->name('excel');
Route::post('/EditP/{id}', 'ServicoController@EditP')->name('editarStatus');
Route::get('/ECliente/{id}/show', 'ClienteController@show')->name('mostrarPropostas');
route::post('/Busca','ServicoController@Busca')->name('buscar');



Route::resource('ECliente', 'ClienteController');
Route::resource('EServico', 'ServicoController');

