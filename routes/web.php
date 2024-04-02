<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
      
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

     //Category Routes
     Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');

     Route::get('/add-category', [CategoryController::class, 'create'])->name('admin.addcategory');

     Route::post('/add-category', [CategoryController::class, 'store'])->name('admin.addcategory');

     Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('admin.editcategory');

     Route::put('/update-category/{category_id}', [CategoryController::class, 'update'])->name('admin.updatecategory');

    Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete'])->name('admin.deletecategory');

     //Posts Routes
     Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');

     Route::get('/add-posts', [PostController::class, 'create'])->name('admin.addposts');
 
     Route::post('/add-posts', [PostController::class, 'store'])->name('admin.addposts');

     Route::get('/edit-post/{post_id}', [PostController::class, 'edit'])->name('admin.editpost');

     Route::put('/update-post/{post_id}', [PostController::class, 'update'])->name('admin.updatepost');

    Route::get('/delete-post/{post_id}', [PostController::class, 'delete'])->name('admin.deletepost');

    //  Route::post('/delete-post', [PostController::class, 'delete'])->name('admin.deletepost');

});
