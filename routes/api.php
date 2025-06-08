<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware("auth:sanctum")->group(function () {
    Route::post('/logout', [AuthController::class, "logout"]);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('comments', CommentController::class);
    Route::post('/assign-ticket', [TicketController::class, "assignTo"]);
});

Route::post('/login', [AuthController::class, "login"]);
