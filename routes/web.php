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
    return view('welcome');
});

Auth::routes();

use App\Http\Controllers\HomeController;
Route::get('/home', [HomeController::class, 'index'])->name('home');


// ********************************
// ********************************
//        one to one lessone
// ********************************
// ********************************
use App\Http\Controllers\ProfileController;

//بعض المبرمجين يكتب بالطريقة التالية
// /profile/{id}
// الطريقة غير مقبولة لأنه يمكن تغيير الرقم ورؤية البروفايلات الأخرى
// والحل في تابع الكونترولر نفسو
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
// الامر تعديل لذلك لا نكتب جيت
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// ********************************
// ********************************
//        one to many lessone
// ********************************
// ********************************
use App\Http\Controllers\PostController;


Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/trashed', [PostController::class, 'postsTrashed'])->name('posts.trashed');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/post/show/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/change/{id}', [PostController::class, 'update'])->name('post.change');

Route::get('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

Route::get('/post/h-delete/{id}', [PostController::class, 'hardDelete'])->name('post.hardDelete');
Route::get('/post/restore/{id}', [PostController::class, 'restore'])->name('post.restore');


// ********************************
// ********************************
//        many to many lessone
// ********************************
// ********************************

use App\Http\Controllers\TagController;


Route::get('/tags', [TagController::class, 'index'])->name('tags');

Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
Route::post('/tag/store', [TagController::class, 'store'])->name('tag.store');

Route::get('/tag/{id}', [TagController::class, 'edit'])->name('tag.edit');
Route::put('/tag/update/{id}', [TagController::class, 'update'])->name('tag.update');

Route::get('/tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');


// ********************************
// ********************************
//        Show all user Lesson
// ********************************
// ********************************
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');


Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
