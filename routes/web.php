<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
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

Route::get('/', function () {
    $pageConfigs = ['myLayout' => 'front'];
    return view('templates.front.landing-page', ['pageConfigs' => $pageConfigs]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [ProfileController::class, 'getProfile'])->name('user.profile.view');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    // Dashboard

    Route::get('/dashboard', [DashboardController::class, 'Home'])->name('dashboard');

    //User

    Route::get('/users', [UserController::class, 'List'])->name('users.list');

    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');

    Route::post('/users/add/submit', [UserController::class, 'addSubmit'])->name('users.add.submit');

    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');

    Route::post('/users/edit/submit', [UserController::class, 'editSubmit'])->name('users.edit.submit');

    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/users/datatables', [UserController::class, 'datatblesList'])->name('users.list.datatbles');
    

    // forgot password
    Route::post('/forgot-password/submit', [PasswordResetLinkController::class, 'passwordResetSubmit'])->name('password.reset.submit');

    Route::get('/reset-password', [PasswordResetLinkController::class, 'passwordResetConfirm'])->name('password.reset.comfirm');

    Route::post('/reset-password/submit', [PasswordResetLinkController::class, 'passwordResetConfirmSubmit'])->name('password.reset.comfirm.submit');

});


    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.submit');

require __DIR__.'/auth.php';
