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

Route::prefix('product')
    ->as('product.')
    ->namespace('Product\\Controllers')
    ->group(function(){
        Route::get('/', 'Models')->name('models');
        Route::get('availability', 'Availability')->name('Availability');
    });
