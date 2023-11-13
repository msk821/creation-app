<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class,'index'])->name('posts.index');
    Route::post('/posts',[PostController::class,'store']);
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::get('/tags/{tag}', [TagController::class, 'index'])->name('tags.index');
    Route::post('/posts/like', [PostController::class, 'like'])->name('posts.like');
    Route::get('/calendar', [PostController::class, 'calendar'])->name('calendar');
    Route::get('/calendar/list',  [PostController::class, 'getTasksByDate'])->name("date"); // ページを読み込む毎に実行
    Route::post('/calendar/search',  [PostController::class, 'searchTasks'])->name("search"); // ページを読み込む毎に実行
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});


require __DIR__.'/auth.php';
