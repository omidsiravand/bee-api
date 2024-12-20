<?php

use App\Http\Controllers\api\aboutecontroller;
use App\Http\Controllers\api\categorycontroller;
use App\Http\Controllers\api\gallerycontroller;
use App\Http\Controllers\api\menucontroller;
use App\Http\Controllers\Api\MenuController as ApiMenuController;
use App\Http\Controllers\api\productcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

route::group(['prefix'=>'v1'],function(){
    Route::group([
        'prefix' => 'auth'
    
    ], function ($router) {
    
        Route::post('login', [AuthController::class,'login']);
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::post('me', [AuthController::class,'me']);
    
    });
// ******************menu *******************//
    route::resource('/menu',menucontroller::class)->parameters(['menu'=>'id']);
// ******************menu *******************//
// ******************about *******************//
route::resource('/aboute',aboutecontroller::class)->parameters(['aboute'=>'id']);
// ******************about *******************//
// ******************gallery *******************//
route::resource('/gallery',gallerycontroller::class)->parameters(['gallery'=>'id']);
// ******************gallery *******************//
// ******************category *******************//
route::resource('/category',categorycontroller::class)->parameters(['category'=>'id']);
// ******************category *******************//
// ******************product *******************//
route::resource('/product',productcontroller::class)->parameters(['product'=>'id']);
// ******************product *******************//




});


