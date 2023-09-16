<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 商品一覧画面
Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);

    // 商品詳細画面
    Route::get('/detail/{id}', [App\Http\Controllers\ItemController::class, 'detail']);

    // 商品編集画面
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);

    // 商品情報更新
    Route::post('/update', [App\Http\Controllers\ItemController::class, 'update']);

    // 商品情報削除
    Route::get('/delete', [App\Http\Controllers\ItemController::class, 'delete']);
});


// ユーザー一覧画面
Route::get('/user',[App\Http\Controllers\UserController::class, 'users']);
Route::get('/user/{id}',[App\Http\Controllers\UserController::class, 'edit']);

// ユーザー情報編集画面
Route::post('user/userUpdate', [App\Http\Controllers\UserController::class, 'update']);
Route::get('user/delete', [App\Http\Controllers\UserController::class, 'delete']);
