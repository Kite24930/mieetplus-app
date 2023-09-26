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
Route::post('/recruit/filter', [MainController::class, 'filter'])->name('filter');
Route::get('/recruit/company/{id}', [MainController::class, 'companyDetail'])->name('companyDetailPage');
Route::get('/recruit/search', [MainController::class, 'search'])->name('search');
Route::post('/recruit/search', [MainController::class, 'searchPost'])->name('searchPost');
Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/terms', [MainController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [MainController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::post('/contact', [MainController::class, 'contactPost'])->name('contactPost');
Route::get('/contact-success', [MainController::class, 'contactSuccess'])->name('contactSuccess');

Route::middleware('auth')->group(function () {
    Route::group(['permission:admin'], function () {
        Route::get('/companyList', [AdminController::class, 'companyList'])->name('companyList');
        Route::get('/studentList', [AdminController::class, 'studentList'])->name('studentList');
        Route::get('/studentList/detail/{id}', [AdminController::class, 'studentDetail'])->name('studentDetail');
        Route::get('/company/add', [AdminController::class, 'companyAdd'])->name('companyAdd');
        Route::post('/company/add', [AdminController::class, 'companyAddPost'])->name('companyAddPost');
        Route::get('/company/admin/detail/{id}', [AdminController::class, 'companyDetail'])->name('adminCompanyDetail');
        Route::get('/company/admin/edit/{id}', [AdminController::class, 'companyEdit'])->name('adminCompanyEdit');
        Route::post('/company/admin/edit/{id}', [AdminController::class, 'adminCompanyEditPost'])->name('adminCompanyEditPost');
    });
    Route::group(['permission:company'], function () {
        Route::get('/company/firstLogin', [CompanyController::class, 'firstLogin'])->name('companyFirstLogin');
        Route::post('/company/firstLogin', [CompanyController::class, 'firstLoginPost'])->name('companyFirstLoginPost');
        Route::get('/company/detail', [CompanyController::class, 'companyDetail'])->name('companyDetail');
        Route::get('/company/detail/edit', [CompanyController::class, 'companyDetailEdit'])->name('companyDetailEdit');
        Route::post('/company/detail/edit', [CompanyController::class, 'companyDetailEditPost'])->name('companyDetailEditPost');
        Route::get('company/followers', [CompanyController::class, 'followers'])->name('companyFollowers');
        Route::get('company/setting', [CompanyController::class, 'setting'])->name('companySetting');
        Route::put('company/passwordUpdate', [CompanyController::class, 'passwordUpdate'])->name('companyPasswordUpdate');
    });
    Route::get('/recruit/followed', [MainController::class, 'followed'])->name('followed');
    Route::get('/student/profile', [MainController::class, 'profile'])->name('profile.show');
    Route::get('/student/profile/edit', [MainController::class, 'profileEdit'])->name('profile.edit');
    Route::post('/student/profile/edit', [MainController::class, 'profileEditPost'])->name('profile.edit');
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
