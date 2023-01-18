<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('post/list',[PostController::class,'index'])->name('post.index');
Route::get('post/create',[PostController::class,'create'])->name('post.create');
Route::post('store',[PostController::class,'store'])->name('post.store');
Route::get('post/delete/{id}',[PostController::class,'destroy'])->name('post.destroy');
Route::get('post/{id}/edit',[PostController::class,'edit'])->name('post.edit');
Route::post('update/{id}',[PostController::class,'update'])->name('post.update');