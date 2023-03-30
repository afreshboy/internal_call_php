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

Route::get('/greeting', function () {
    return 'Hello world';
});

Route::get('/v1/ping', function () {
    return "ping";
});

Route::prefix('/api/v1')->group(function () {
    Route::get('/get_count', [\App\Http\Controllers\BaseReqController::class, 'get_count']);
    Route::post('/post_count', [\App\Http\Controllers\BaseReqController::class, 'post_count']);
    Route::get('/internal_call', [\App\Http\Controllers\InternalCallController::class, 'internal_call']);
});

Route::prefix('/mongo')->group(function () {
    Route::post('/get', [\App\Http\Controllers\MongoController::class, 'get']);
    Route::post('/insert', [\App\Http\Controllers\MongoController::class, 'insert']);
    Route::post('/delete', [\App\Http\Controllers\MongoController::class, 'delete']);
});
