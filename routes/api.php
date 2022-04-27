<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FcmController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewerController;
use App\Models\Order;
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

    //chats
    Route::get('/chats',[ChatController::class,'index']);
    Route::get('/chats/{id}',[ChatController::class,'show']);
    Route::put('/chats/{id}',[ChatController::class,'update']);
    Route::post('/chats',[ChatController::class,'store']);

    //messages
    Route::post('/messages',[MessageController::class,'store']);
    Route::put('/messages/{id}',[MessageController::class,'update']);
    Route::delete('/messages/{id}',[MessageController::class,'destroy']);

    //filter-funs
    Route::get('/filter/news',[NewsItemController::class,'filtering']);
    Route::get('/filter/orders', [OrderController::class, 'filtering']);

    //all
    Route::get('/all/news',[NewsItemController::class,'all']);
    Route::get('/all/orders', [OrderController::class, 'all']);

    //Push notification send user by id
     Route::post('/sendPushNotification', [FcmController::class, 'sendPushNotification']);
     Route::post('/sendPushAll', [FcmController::class, 'sendPushNotificationAllDevices']);

     //rating
     Route::get('/marks', [RatingController::class, 'index']);
     Route::get('/mark', [RatingController::class, 'getUserNewsMark']);
     Route::post('/mark', [RatingController::class, 'store']);

});

Route::post('/register', [UserController::class,'register']);
Route::post('/login',[UserController::class, 'login'])->name('login');
//reset password
Route::put('/reset',[UserController::class,'resetPassword']);

//Get file to download
Route::get('/getfile', [FileController::class,'getDownloadFile']);
//Get file content
Route::get('/getContent',[FileController::class, 'getContentFile']);

//show viewer
Route::get('/viewer',[ViewerController::class, 'getViewer']);