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

Auth::routes();
Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::get('/contacts/create', 'ContactsController@create');
Route::post('/contacts/create', 'ContactsController@store');
Route::get('/contacts/destroy/{id}', 'ContactsController@confirm_destroy');
Route::delete('/contacts/destroy/{id}', 'ContactsController@destroy');
Route::get('/contacts/edit/{id}', 'ContactsController@edit');
Route::put('/contacts/edit/{id}', 'ContactsController@update');
Route::get('/', function() {
    if(Auth::user() === null) {
        return view('guest');
    }
    return redirect('/contacts');
});
