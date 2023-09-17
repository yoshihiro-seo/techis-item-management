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
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->middleware(['auth']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add'])->middleware(['auth']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add'])->middleware(['auth']);

    // 商品検索
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'index'])->middleware(['auth']);

    // 商品検索(ジャンル)
    Route::get('/search/type', [App\Http\Controllers\ItemController::class, 'index'])->middleware(['auth']);

    // 商品詳細画面
    Route::get('/detail/{id}', [App\Http\Controllers\ItemController::class, 'detail'])->middleware(['auth']);

    // 商品編集画面
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->middleware(['auth']);

    // 商品情報更新
    Route::post('/update', [App\Http\Controllers\ItemController::class, 'update'])->middleware(['auth']);

    // 商品情報削除
    Route::get('/delete', [App\Http\Controllers\ItemController::class, 'delete'])->middleware(['auth']);

});


// ユーザー一覧画面
Route::get('/user',[App\Http\Controllers\UserController::class, 'users'])->middleware(['auth']);
Route::get('/user/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware(['auth']);

// ユーザー情報編集画面
Route::post('user/userUpdate', [App\Http\Controllers\UserController::class, 'update'])->middleware(['auth']);
Route::get('user/delete', [App\Http\Controllers\UserController::class, 'delete'])->middleware(['auth']);
