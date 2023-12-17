<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubRelawanController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BatchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('subrelawan', SubRelawanController::class);
Route::resource('userprofiles', UserProfileController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');

// Batch routes
Route::get('/batches', [BatchController::class, 'index'])->name('superadmin.batches.index');
Route::get('/batches/create', [BatchController::class, 'create'])->name('superadmin.batches.create');
Route::post('/batches', [BatchController::class, 'store'])->name('superadmin.batches.store');
Route::get('/batches/{batch}/edit', [BatchController::class, 'edit'])->name('superadmin.batches.edit');
Route::put('/batches/{batch}', [BatchController::class, 'update'])->name('superadmin.batches.update');
Route::delete('/batches/{batch}', [BatchController::class, 'destroy'])->name('superadmin.batches.destroy');

Route::get('/superadmin/dapil', [DapilController::class, 'index'])->name('superadmin.dapil.index');
Route::get('/superadmin/dapil/create', [DapilController::class, 'create'])->name('superadmin.dapil.create');
Route::post('/superadmin/dapil', [DapilController::class, 'store'])->name('superadmin.dapil.store');
Route::get('/superadmin/dapil/{id}/edit', [DapilController::class, 'edit'])->name('superadmin.dapil.edit');
Route::put('/superadmin/dapil/{id}', [DapilController::class, 'update'])->name('superadmin.dapil.update');
Route::delete('/superadmin/dapil/{id}', [DapilController::class, 'destroy'])->name('superadmin.dapil.destroy');

Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'role:superadmin']], function () {
    // Dashboard route
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard']);

    // All Users route
    Route::get('/all-users', [SuperAdminController::class, 'allUsers']);

    // All Admin route
    Route::get('/all-admin', [SuperAdminController::class, 'allAdmin']);

    // All Sub Relawans route
    Route::get('/all-sub-relawans', [SuperAdminController::class, 'allSubRelawans']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
