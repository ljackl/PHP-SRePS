<?php

use App\Sale;

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

// Report routes
Route::get('reports', 'ReportController@show');
Route::post('reports/csv', 'ReportController@toCSV');
Route::post('reports/view', 'ReportController@viewReport');

// Route for Items and Sales
Route::resources([
    'sales' => 'SalesController',
    'items' => 'ItemController'
]);

// Home page route
Route::get('/', function () {
    return view('welcome');
});
