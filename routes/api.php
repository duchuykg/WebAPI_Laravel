<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [AuthController::class, 'login'])
    ->name('.login');
Route::post('register', [AuthController::class, 'register'])
    ->name('.register');

// Route::middleware('auth:api')->name('.features')->group(function () {
Route::name('.features')->group(function () {
    Route::prefix('/categories')->name('.categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('.index');
        Route::post('', [CategoryController::class, 'store'])
            ->name('.store')
            ->middleware('role:Admin,Member');
        Route::prefix('/{id}')->name('.categories')->group(function () {
            Route::get('', [CategoryController::class, 'show'])
                ->name('.show')->where('id', '[0-9]+');
            Route::put('', [CategoryController::class, 'update'])
                ->name('.update')->where('id', '[0-9]+')       
                ->middleware('role:Guest,Admin,Member');
            Route::delete('', [CategoryController::class, 'destroy'])
                ->name('.destroy')->where('id', '[0-9]+')  
                ->middleware('role:Admin,Member');
        });
    });

    Route::middleware('role:Admin')->prefix('/users')->name('.users')->group(function () {                                                
        Route::get('/', [UserController::class, 'index'])
            ->name('.index');
        Route::post('', [UserController::class, 'store'])
            ->name('.store');
        Route::prefix('/{id}')->name('.users')->group(function () {
            Route::get('', [UserController::class, 'show'])
                ->name('.show')->where('id', '[0-9]+');
            Route::put('', [UserController::class, 'update'])
                ->name('.update')->where('id', '[0-9]+');
            Route::delete('', [UserController::class, 'destroy'])
                ->name('.destroy')->where('id', '[0-9]+');
        });
    });

    Route::prefix('/posts')->name('.posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])
            ->name('.index');
        Route::post('', [PostController::class, 'store'])
            ->name('.store')                                       
            ->middleware('role:Admin,Member');
        Route::prefix('/{id}')->name('.posts')->group(function () {
            Route::get('', [PostController::class, 'show'])
                ->name('.show')->where('id', '[0-9]+');
            Route::put('', [PostController::class, 'update'])
                ->name('.update')->where('id', '[0-9]+')           
                ->middleware('role:Admin,Member');
            Route::delete('', [PostController::class, 'destroy'])
                ->name('.destroy')->where('id', '[0-9]+')      
                ->middleware('role:Admin,Member');
        });
    });
});




