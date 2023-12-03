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

use App\Http\Controllers\UserProfileController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubRelawanController;


Route::redirect('/', '/dashboard');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('subrelawan', SubRelawanController::class);
Route::resource('userprofiles', UserProfileController::class);

// routes/web.php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // Your admin routes go here, e.g., admin dashboard
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/relawan', [AdminController::class, 'allUsers'])->name('admin.relawan');
    Route::get('/anggota-relawan', [AdminController::class, 'allSubRelawans'])->name('admin.anggota-relawan');
});


// Other routes here

Route::middleware(['auth.check'])->group(function () {
    // Your protected routes go here
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // });
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
    });

