<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('post/list',[PostController::class,'getPost'])->name('post#list');
Route::get('post/create',[PostController::class,'create'])->name('post#create');
Route::post('create',[PostController::class,'postCreate'])->name('post#createPost');
Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
Route::get('post/edit/{id}',[PostController::class,'edit'])->name('post#edit');
Route::post('edit/{id}',[PostController::class,'postEdit'])->name('post#editPost');