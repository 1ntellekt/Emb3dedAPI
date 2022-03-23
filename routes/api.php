<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\OrderController;
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

Route::group(['middleware' => ['auth:sanctum']],function(){

    //logout user from token
    Route::post('/logout', [UserController::class, 'logout']);

    //users
    Route::put('/users/{id}',[UserController::class, 'update']);
    Route::get('/users/{id}',[UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);

    //Put file to upload
    Route::post('/putfile', [FileController::class,'uploadFile']);
    //Get file to download
    Route::get('/getfile', [FileController::class,'getDownloadFile']);
    
    //devices
    Route::get('/devices', [DeviceController::class, 'index']);
    Route::post('/devices', [DeviceController::class, 'store']);
    Route::post('/deldevices', [DeviceController::class, 'destroy']);

    //orders
    Route::get('/orders',[OrderController::class,'index']);
    Route::get('/orders/{id}',[OrderController::class,'show']);
    Route::post('/orders',[OrderController::class,'store']);
    Route::put('/orders/{id}',[OrderController::class,'update']);
    Route::delete('/orders/{id}',[OrderController::class,'destroy']);

    //news
    Route::get('/news',[NewsItemController::class,'index']);
    Route::get('/news/{id}',[NewsItemController::class,'show']);
    Route::post('/news',[NewsItemController::class,'store']);
    Route::put('/news/{id}',[NewsItemController::class,'update']);
    Route::delete('/news/{id}',[NewsItemController::class,'destroy']);

        // //Push notification send user by id
    // Route::post('/sendPushNotification', [FcmController::class, 'sendPushNotification']);
    // Route::post('/sendPushAll', [FcmController::class, 'sendPushNotificationAllDevices']);
});

Route::post('/register', [UserController::class,'register']);
Route::post('/login',[UserController::class, 'login'])->name('login');