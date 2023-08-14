<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;

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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/recruit', [MainController::class, 'recruit'])->name('recruit');
Route::get('/recruit/company/{id}', [MainController::class, 'companyDetail'])->name('companyDetail');

Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['permission:admin'], function () {
        Route::get('/companyList', [AdminController::class, 'companyList'])->name('companyList');
        Route::get('/studentList', [AdminController::class, 'studentList'])->name('studentList');
        Route::get('/company/add', [AdminController::class, 'companyAdd'])->name('companyAdd');
        Route::post('/company/add', [AdminController::class, 'companyAddPost'])->name('companyAddPost');
        Route::get('/company/edit/{id}', [AdminController::class, 'companyEdit'])->name('companyEdit');
    });
    Route::group(['permission:company'], function () {
        Route::get('/company/firstLogin', [CompanyController::class, 'firstLogin'])->name('companyFirstLogin');
        Route::post('/company/firstLogin', [CompanyController::class, 'firstLoginPost'])->name('companyFirstLoginPost');
        Route::get('/company/detail', [CompanyController::class, 'companyDetail'])->name('companyDetail');
        Route::get('/company/detail/edit', [CompanyController::class, 'companyDetailEdit'])->name('companyDetailEdit');
        Route::post('/company/detail/edit', [CompanyController::class, 'companyDetailEditPost'])->name('companyDetailEditPost');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
