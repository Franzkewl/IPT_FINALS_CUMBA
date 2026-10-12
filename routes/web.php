<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;

Route::resource('categories', CategoryController::class);
Route::resource('students', StudentController::class);
Route::resource('equipments', EquipmentController::class);
Route::resource('borrowings', BorrowingController::class);
Route::resource('returns', ReturnController::class);

Route::redirect('/', '/categories');