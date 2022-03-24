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
    return redirect('login');
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('app.logout');

Route::middleware(['auth'])->group(function (){
    Route::resource('todoList',\App\Http\Controllers\TodoList\TodoListController::class);
    Route::get('/todoList',[\App\Http\Controllers\TodoList\TodoListController::class,'index']);
    Route::post('createTodoList',[\App\Http\Controllers\TodoList\TodoListController::class,'store']);
    Route::post('updateTodoList',[\App\Http\Controllers\TodoList\TodoListController::class,'update']);
    Route::post('verifyTodoList/{id}',[\App\Http\Controllers\TodoList\TodoListController::class, 'verify']);

    Route::get('list_todolist',[\App\Http\Controllers\Datatable\TodoList\TodoListController::class,'getAll']);   
});

