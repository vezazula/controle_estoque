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
    return redirect('/home');
});


/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/contatos', 'ContatosController@index');
Route::post('/contatos', 'ContatosController@store');
Route::get('/contatos/{id}','ContatosController@edit'); 
Route::delete('/contatos', 'ContatosController@destroy');
Route::put('/contatos/{id}', 'ContatosController@update');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::get('/dashboard', 'AdministratorController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'UserController@index');
Route::post('/user/register', 'UserController@store');
Route::post('/user/update', 'UserController@update');
Route::post('/user/disabled', 'UserController@disabled');
Route::post('/user/reactivate', 'UserController@reactivate');

Route::get('/product', 'ProductsController@index');
Route::get('/product/supplier/{id}', 'ProductsController@listSuppliers');
Route::get('/product/search', 'ProductsController@search');
Route::post('/product/insert', 'ProductsController@store');
Route::post('/product/debit', 'ProductsController@debit');
Route::post('/product/edit', 'ProductsController@edit');

Route::get('/supplier', 'SuppliersController@index');
Route::get('/supplier/search', 'SuppliersController@search');
Route::post('/supplier/delete', 'SuppliersController@deleteIt');
Route::post('/supplier/edit', 'SuppliersController@edit');
Route::post('/supplier/insert', 'SuppliersController@store');