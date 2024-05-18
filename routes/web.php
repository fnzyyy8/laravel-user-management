<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TodolistController;

Route::get('/',[HomepageController::class,'home']);

Route::get('/template', function () {
    return view('template');
});

Route::controller(UserController::class)
    ->prefix('/user')->group(function () {
        Route::middleware([OnlyGuestMiddleware::class])
            ->group(function (){
                Route::get('/login', 'loginView');
                Route::post('/login','login');
            });
        Route::post('/logout','logout')->middleware([OnlyMemberMiddleware::class]);
    });

Route::controller(TodolistController::class)
    ->middleware([OnlyMemberMiddleware::class])->prefix('/todolist')
    ->group(function (){
    Route::get('/','todolist');
    Route::post('/','createTodolist');
    Route::post('/{todoId}/delete','removeTodolist');
    });

