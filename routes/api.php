<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/company/mailPermission', [ApiController::class, 'companyMailPermissionChange'])->name('companyMailPermissionChange');
Route::post('follow', [ApiController::class, 'followedAdd'])->name('followedAdd');
Route::delete('follow/{company_id}/{student_id}', [ApiController::class, 'followedDelete'])->name('followedDelete');
Route::post('history', [ApiController::class, 'historyAdd'])->name('historyAdd');
