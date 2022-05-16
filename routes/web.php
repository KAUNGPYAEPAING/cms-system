<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function(){
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');


    Route::put('admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');

    Route::delete('admin/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

});

Route::middleware('role:Admin')->group(function(){
    Route::get('admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::put('/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');

    Route::get('admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.role.index');
    Route::post('admin/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.role.store');
    Route::delete('admin/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.role.destroy');
    Route::get('admin/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.role.edit');  
    Route::put('admin/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.role.update');  




    Route::get('admin/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('admin.permission.index');
    Route::post('admin/permissions', [App\Http\Controllers\PermissionController::class, 'store'])->name('admin.permission.store');
    Route::delete('admin/permissions,{permission}/destroy', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('admin.permission.destroy');

});

Route::middleware(['auth', 'can:view,user'])->group(function(){
    Route::get('admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});