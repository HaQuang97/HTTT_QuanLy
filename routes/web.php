<?php

use Illuminate\Support\Facades\Artisan;
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
Route::get('/', 'BranchController@getListBranch')->name('index-branch');
//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', 'UsersController@getLogin')->name('login');
//Route::post('/login', 'UsersController@postLogin')->name('post-login');
//Route::post('/register', 'UsersController@postRegister')->name('register');
//Route::get('/logout', 'UsersController@logout')->name('logout');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::prefix('/branchs')->group(function () {
    Route::get('/', 'BranchController@getListBranch')->name('index-branch');
    Route::post('/add-new-branch', 'BranchController@postAddNewBranch');
    Route::post('/update-branch/{id}', 'BranchController@postEditBranch');
    Route::post('/delete-branch/{id}','BranchController@getDeleteBranch');
});

Route::prefix('/customers')->group(function () {
    Route::get('/', 'CustomerController@getListCustomer')->name('index-customer');
    Route::post('/add-new-customer', 'CustomerController@postAddNewCustomer');
    Route::post('/update-customer/{id}', 'CustomerController@postEditCustomer');
    Route::post('/delete-customer/{id}','CustomerController@getDeleteCustomer');
});

Route::prefix('/employees')->group(function () {
    Route::get('/', 'EmployeeController@getListEmployee')->name('index-employee');
    Route::post('/add-new-employee', 'EmployeeController@postAddNewEmployee');
    Route::post('/update-employee/{id}', 'EmployeeController@postEditEmployee');
    Route::post('/delete-employee/{id}','EmployeeController@getDeleteEmployee');
});
