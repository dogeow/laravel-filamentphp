<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 联系表单路由 - 限制同一IP一天只能提交一次
Route::post('/contacts', [ContactController::class, 'store']);
