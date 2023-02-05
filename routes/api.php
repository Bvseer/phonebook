<?php

use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\User\ContactController;
use Illuminate\Support\Facades\Route;

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

    Route::group(['namespace' => 'Admin'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::delete('/delete', [UserController::class, 'delete'])->name('delete');
        });
    });

    Route::group(['namespace' => 'User'], function () {
        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/search', [ContactController::class, 'search'])->name('search');
            Route::get('/get-user-contacts', [ContactController::class, 'getUserContacts'])->name('get_user_contacts');
            Route::post('/bulk-create', [ContactController::class, 'bulkCreate'])->name('bulk_create');
            Route::put('/bulk-update', [ContactController::class, 'bulkUpdate'])->name('bulk_update');
            Route::delete('/delete', [ContactController::class, 'delete'])->name('delete');
        });
    });

});
