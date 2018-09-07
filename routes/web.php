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

// Route for Sales
Route::resource('sales', 'SalesController');

// Route for Items
Route::resource('items', 'ItemController');

// Home page route
Route::get('/', function () {
    return view('welcome');
});
