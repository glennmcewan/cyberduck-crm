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

Route::resources([
    'employees' => 'EmployeeController',
    'companies' => 'CompanyController',
]);

Route::namespace('Admin')->prefix('admin')->as('admin.')->middleware('auth')->group(function() {
    Route::resources([
        'employees' => 'EmployeeController',
        'companies' => 'CompanyController',
    ]);
});

Route::get('/admin', 'Admin\\DashboardController@index')->name('admin.index')->middleware('auth');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
