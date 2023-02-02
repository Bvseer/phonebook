<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::group(['namespace' => 'API', 'middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/search-by-fullname', [ContactController::class, 'searchByFullname'])->name('SearchByFullname');
        Route::get('/search-by-phone_number', [ContactController::class, 'searchByPhoneNumber'])->name('SearchByPhoneNumber');
        Route::get('/search-by-email', [ContactController::class, 'searchByEmail'])->name('SearchByEmail');
        Route::get('/getContacts/{id}', [ContactController::class, 'getContacts'])->name('GetContacts');
        Route::post('/deleteContact/{id}', [ContactController::class, 'deleteContact'])->name('GetContacts');
    });
});


