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

// JARS
Route::post('/jar/new/raffle', 'JarController@newRaffle')->name('jar.newRaffle');
Route::post('/jar/new/memory', 'JarController@newMemory')->name('jar.newMemory');
Route::get('/jar/{jar}/draw', 'JarController@drawRaffle')->name('jar.drawRaffle');
Route::get('jar/{jar}/view', 'JarController@view')->name('jar.view');
Route::get('/prize/{prize}/draw', 'JarController@drawPrize')->name('jar.drawPrize');
Route::get('/jar/{jar}/confirm', 'JarController@confirm')->name('jar.confirmArchive');
Route::get('/jar/{jar}/archive', 'JarController@delete')->name('jar.delete');

// TICKETS
Route::get('jar/{jar}/ticket/create', 'TicketController@create')->name('ticket.create');
Route::post('jar/{jar}/ticket/store', 'TicketController@store')->name('ticket.store');
Route::post('/jar/{jar}/ticket/{ticket}/update', 'TicketController@update')->name('ticket.update');
Route::post('ticket/{ticket}/updateStatus', 'TicketController@updateStatus')->name('ticket.updateStatus');

// PRIZES
Route::get('jar/{jar}/prize/create', 'PrizeController@create')->name('prize.create');
Route::post('jar/{jar}/prize/store', 'PrizeController@store')->name('prize.store');
Route::get('prize/{prize}/edit', 'PrizeController@edit')->name('prize.edit');
Route::post('prize/{prize}/update', 'PrizeController@update')->name('prize.update');
Route::get('prize/{prize}/confirm', 'PrizeController@confirm')->name('prize.confirmDelete');
Route::get('prize/{prize}/delete', 'PrizeController@delete')->name('prize.delete');
Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

