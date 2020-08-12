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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'OccurrenceController@index')->name('home');
Route::get('occurrence_element/create/{occurrence_id}', 'Occurrence_elementController@create')->name('occurrence_element.create');
Route::get('occurrence_element/{occurrence_id}', 'Occurrence_elementController@index')->name('occurrence_element.index');
Route::get('note/create/{occurrence_id}', 'NoteController@create')->name('note.create');
Route::get('note/{occurrence_id}', 'NoteController@index')->name('note.index');
Route::get('element_condominium/create/{element_id}', 'Element_condominiumController@create')->name('element_condominium.create');
Route::get('element_condominium/{element_id}', 'Element_condominiumController@index')->name('element_condominium.index');
Route::resource('type', 'TypeController');
Route::resource('element', 'ElementController');
Route::resource('condominium', 'CondominiumController');
Route::resource('element_condominium', 'Element_condominiumController');
Route::resource('occurrence', 'OccurrenceController');
Route::resource('occurrence_element', 'Occurrence_elementController');
Route::resource('note', 'NoteController');
