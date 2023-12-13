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

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubRelawanController;
// test mr


Route::redirect('/', '/dashboard');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('subrelawan', SubRelawanController::class);
Route::resource('userprofiles', UserProfileController::class);

Route::post('/admin/relawan/{user}', [AuthController::class, 'resetPassword'])->name('admin.reset-password');
// web.php

Route::post('/profileku/index/{user}', [AuthController::class, 'userResetPassword'])->name('user.reset-password');



// routes/web.php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // Your admin routes go here, e.g., admin dashboard
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/relawan', [AdminController::class, 'allUsers'])->name('admin.relawan');
    Route::get('/anggota-relawan', [AdminController::class, 'allSubRelawans'])->name('admin.anggota-relawan');

    // Batch routes
    Route::get('/batches', [BatchController::class, 'index'])->name('admin.batches.index');
    Route::get('/batches/create', [BatchController::class, 'create'])->name('admin.batches.create');
    Route::post('/batches', [BatchController::class, 'store'])->name('admin.batches.store');
    Route::get('/batches/{batch}/edit', [BatchController::class, 'edit'])->name('admin.batches.edit');
    Route::put('/batches/{batch}', [BatchController::class, 'update'])->name('admin.batches.update');
    Route::delete('/batches/{batch}', [BatchController::class, 'destroy'])->name('admin.batches.destroy');

    // Candidate routes
    Route::get('/candidates', [CandidateController::class, 'index'])->name('admin.candidates.index');
    Route::get('/candidates/create', [CandidateController::class, 'create'])->name('admin.candidates.create');
    Route::post('/candidates', [CandidateController::class, 'store'])->name('admin.candidates.store');
    Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])->name('admin.candidates.edit');
    Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])->name('admin.candidates.update');
    Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy'])->name('admin.candidates.destroy');
});


// Other routes here

Route::middleware(['auth.check'])->group(function () {
    // Your protected routes go here
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::resource('subrelawan', SubRelawanController::class);

        Route::get('/anggota-relawan', function () {
            return view('anggota-relawan');
        });
        Route::get('/quickcount', function () {
            return view('quickcount.index');
        });
        Route::get('/help', function () {
            return view('help');
        });
        Route::get('/profileku', [AuthController::class, 'profileku'])->name('profileku');
    });

