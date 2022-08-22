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
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    /*
        Scanning Routes
    */
    Route::get('/scan', 'App\Http\Controllers\admin\RFIDController@scan')->name('scan');
    Route::post('/scanning', 'App\Http\Controllers\admin\RFIDController@scanner')->name('scanner');
    Route::post('/pin', 'App\Http\Controllers\admin\RFIDController@pin')->name('pin');
    /*
        End Scanning Routes
    */

    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    Route::get('/admin/transactions', 'App\Http\Controllers\admin\TransactionController@index')->name('admin-transactions');
    Route::get('/admin/report', 'App\Http\Controllers\admin\TransactionController@report')->name('admin-transaction-report');

    Route::get('/admin/card/{id}', 'App\Http\Controllers\admin\DashboardController@card')->name('admin-card');
    Route::post('/admin/add/card', 'App\Http\Controllers\admin\DashboardController@add_card')->name('admin-add-card');

    Route::get('/admin/exempt/{id}', 'App\Http\Controllers\admin\DashboardController@add_exempt')->name('admin-exempt');
    Route::get('/admin/remove-exempt/{id}', 'App\Http\Controllers\admin\DashboardController@remove_exempt')->name('admin-romove-exempt');
    Route::post('/admin/remove/exempt', 'App\Http\Controllers\admin\DashboardController@remove')->name('admin-delete-exempt');

    Route::get('/admin/prices', 'App\Http\Controllers\admin\PriceController@index')->name('admin-prices');
    Route::get('/admin/price{id}', 'App\Http\Controllers\admin\PriceController@price')->name('admin-price');
    Route::post('/admin/update/price', 'App\Http\Controllers\admin\PriceController@update')->name('admin-update-price');

});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');

    Route::get('/user/transactions', 'App\Http\Controllers\user\AccountController@transactions')->name('user-transactions');
    Route::get('/user/transactions/report', 'App\Http\Controllers\user\AccountController@report')->name('user-report');
    Route::get('/user/deposit', 'App\Http\Controllers\user\AccountController@deposit_index')->name('user-deposit');
    Route::post('/user/deposit/post', 'App\Http\Controllers\user\AccountController@deposit')->name('user-deposit-post');

    Route::get('/user/my-card', 'App\Http\Controllers\user\CardController@index')->name('user-card');
    Route::post('/user/change/pin', 'App\Http\Controllers\user\CardController@change')->name('user-change-pin');

    Route::get('/user/report', 'App\Http\Controllers\user\AccountController@report')->name('user-transaction-report');

});

require __DIR__.'/auth.php';
