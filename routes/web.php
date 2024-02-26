<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.submit');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'Home'])->name('dashboard');

    //Admins

    Route::get('/admins', [AdminController::class, 'List'])->name('admin.list');

    Route::get('/admins/add', [AdminController::class, 'add'])->name('admin.add');

    Route::post('/admins/add/submit', [AdminController::class, 'addSubmit'])->name('admin.add.submit');

    Route::get('/admins/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

    Route::post('/admins/edit/submit', [AdminController::class, 'editSubmit'])->name('admin.edit.submit');

    Route::get('/admins/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    Route::get('/admins/datatables', [AdminController::class, 'datatblesList'])->name('admin.list.datatbles');
    
    // Groups

    Route::get('/groups', [GroupController::class, 'List'])->name('group.list');

    Route::get('/groups/datatables', [GroupController::class, 'datatblesList'])->name('group.list.datatbles');

    Route::get('/groups/add', [GroupController::class, 'add'])->name('group.add');

    Route::post('/groups/add/submit', [GroupController::class, 'addSubmit'])->name('group.add.submit');

    Route::get('/groups/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');

    Route::post('/groups/edit/submit', [GroupController::class, 'editSubmit'])->name('group.edit.submit');

    Route::get('/groups/delete/{id}', [GroupController::class, 'delete'])->name('group.delete');

    Route::post('/forgot-password/submit', [PasswordResetLinkController::class, 'passwordResetSubmit'])->name('password.reset.submit');

    Route::get('/reset-password', [PasswordResetLinkController::class, 'passwordResetConfirm'])->name('password.reset.comfirm');

    Route::post('/reset-password/submit', [PasswordResetLinkController::class, 'passwordResetConfirmSubmit'])->name('password.reset.comfirm.submit');
require __DIR__.'/auth.php';
