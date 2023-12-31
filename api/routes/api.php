<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Message\ChatMessagesController;
use App\Http\Controllers\Message\ResendController;
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

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::resource('/chats', ChatController::class)->only(['index', 'store']);
    Route::resource('/chats/{chat}/messages', ChatMessagesController::class)->only(['index', 'store']);
    Route::resource('/contacts', ContactController::class)->only(['index', 'store']);
    Route::resource('/messages/resend', ResendController::class)->only('store');

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
