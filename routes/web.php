<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::post('/add-item/{product}', 'App\Http\Controllers\OrderController@store');
    Route::get('/cart', 'App\Http\Controllers\OrderController@index');
    Route::get('/paid-orders', 'App\Http\Controllers\OrderController@paidOrders');
    Route::post('/process-payment', 'App\Http\Controllers\PaymentController@processPayment');
    Route::delete('/order-item/{orderItemID}', 'App\Http\Controllers\OrderController@deleteOrderItem');
    Route::apiResource('/product', 'App\Http\Controllers\ProductController');
});
