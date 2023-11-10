<?php

use App\Http\Controllers\Api\BlogControllerApi;
use App\Http\Controllers\Api\CartControllerApi;
use App\Http\Controllers\Api\CheckoutControllerApi;
use App\Http\Controllers\Api\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserControllerAPI;
use App\Http\Controllers\Auth\ResetPasswordController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Reset password
Route::post('reset-password', [ResetPasswordController::class,'sendMail']);
Route::put('reset-password/{token}', [ResetPasswordController::class, 'reset']);
// Bài viết 
Route::apiResource('/post', PostControllerApi::class);
Route::apiResource('/blog', BlogControllerApi::class);
// Người dùng
Route::apiResource('/user',UserControllerApi::class);
// Giỏ hàng
Route::apiResource('/cart', CartControllerApi::class);
Route::apiResource('/checkout', CheckoutControllerApi::class);
