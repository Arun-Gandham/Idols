<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFeetController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\TestimonialContorller;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     $pageConfigs = ['myLayout' => 'front'];
//     return view('templates.front.landing-page', ['pageConfigs' => $pageConfigs]);
// });
Route::get('/', [FrontPageController::class, 'landingPage'])->name('landing.page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Dashboard

    Route::get('/dashboard', [DashboardController::class, 'Home'])->name('dashboard');

    //User
    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/', [UserController::class, 'List'])->name('list');

        Route::get('/add', [UserController::class, 'add'])->name('add');

        Route::get('/profile/{id}', [UserController::class, 'viewUserProfile'])->name('profile.view');

        Route::post('/add/submit', [UserController::class, 'addSubmit'])->name('add.submit');

        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [UserController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    // Product Feet
    Route::prefix('feet')->name('feet.')->group(function () {

        Route::get('/', [ProductFeetController::class, 'List'])->name('list');

        Route::get('/add', [ProductFeetController::class, 'add'])->name('add');

        Route::post('/add/submit', [ProductFeetController::class, 'addSubmit'])->name('add.submit');

        Route::get('/edit/{id}', [ProductFeetController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [ProductFeetController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/delete/{id}', [ProductFeetController::class, 'delete'])->name('delete');
    });

    // Product Type
    Route::prefix('type')->name('type.')->group(function () {

        Route::get('/', [ProductTypeController::class, 'List'])->name('list');

        Route::get('/add', [ProductTypeController::class, 'add'])->name('add');

        Route::post('/add/submit', [ProductTypeController::class, 'addSubmit'])->name('add.submit');

        Route::get('/edit/{id}', [ProductTypeController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [ProductTypeController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/delete/{id}', [ProductTypeController::class, 'delete'])->name('delete');
    });

    // User Roles
    Route::prefix('role')->name('role.')->group(function () {

        Route::get('/', [RoleController::class, 'List'])->name('list');

        Route::get('/add', [RoleController::class, 'add'])->name('add');

        Route::post('/add/submit', [RoleController::class, 'addSubmit'])->name('add.submit');

        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [RoleController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
    });

    // Product
    Route::prefix('product')->name('product.')->group(function () {

        Route::get('/', [ProductController::class, 'List'])->name('list');

        Route::get('/add', [ProductController::class, 'add'])->name('add');

        Route::post('/add/submit', [ProductController::class, 'addSubmit'])->name('add.submit');

        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [ProductController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/{id}/delete', [ProductController::class, 'delete'])->name('delete');

        Route::get('/deleted/list', [ProductController::class, 'deletedList'])->name('deleted.list');

        Route::get('/{id}/restore', [ProductController::class, 'restore'])->name('restore');

        Route::get('/{id}/details', [ProductController::class, 'detailsView'])->name('details.view');

        Route::get('/{id}/orders', [ProductController::class, 'ordersView'])->name('orders.view');

        Route::get('/{id}/teams', [ProductController::class, 'teamsView'])->name('teams.view');

        Route::get('/{id}/stock', [ProductController::class, 'stockView'])->name('stock.view');

        Route::get('/{id}/other', [ProductController::class, 'otherView'])->name('other.view');
    });

    // Order Statuses
    Route::prefix('order-status')->name('order.status.')->group(function () {

        Route::get('/order-status', [OrderStatusController::class, 'List'])->name('list');

        Route::get('/add', [OrderStatusController::class, 'add'])->name('add');

        Route::post('/add/submit', [OrderStatusController::class, 'addSubmit'])->name('add.submit');

        Route::get('/{id}/edit', [OrderStatusController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [OrderStatusController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/{id}/delete', [OrderStatusController::class, 'delete'])->name('delete');
    });

    // Orders
    Route::prefix('order')->name('orders.')->group(function () {

        Route::get('/', [OrderController::class, 'list'])->name('list');

        Route::get('/datatable', [OrderController::class, 'datatblesList'])->name('list.datatables');

        Route::get('/add', [OrderController::class, 'add'])->name('add');

        Route::post('/add/submit', [OrderController::class, 'addSubmit'])->name('add.submit');

        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [OrderController::class, 'editSubmit'])->name('edit.submit');

        Route::get('/{id}/delete', [OrderController::class, 'delete'])->name('delete');

        Route::get('/{id}/view', [OrderController::class, 'viewOrder'])->name('view');

        Route::post('/update/status', [OrderController::class, 'updateOrderStatus'])->name('update.status');

        // Order Timeline 
        Route::get('/order/{id}/timeline/delete', [OrderController::class, 'deleteOrderTimeline'])->name('orders.timeline.delete');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {

        Route::get('/', [SettingsController::class, 'viewSettings'])->name('');

        Route::post('/update', [SettingsController::class, 'updateSettings'])->name('update');
    });

    // Invoice
    Route::get('/Invoice/{orderId}/download', [InvoiceController::class, 'downloadInvoice'])->name('download.invoice');

    // Testimonials
    Route::prefix('testimonials')->name('testimonials.')->group(function () {

        Route::get('/', [TestimonialContorller::class, 'List'])->name('list');

        Route::get('/add', [TestimonialContorller::class, 'add'])->name('add');

        Route::post('/add/submit', [TestimonialContorller::class, 'addSubmit'])->name('add.submit');

        Route::get('/edit/{id}', [TestimonialContorller::class, 'edit'])->name('edit');

        Route::post('/edit/submit', [TestimonialContorller::class, 'editSubmit'])->name('edit.submit');

        Route::get('/delete/{id}', [TestimonialContorller::class, 'delete'])->name('delete');
    });

    Route::get('/navbar/search', [DashboardController::class, 'navbarSearch'])->name('navbar.search');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');


// forgot password
Route::post('/forgot-password/submit', [PasswordResetLinkController::class, 'passwordResetSubmit'])->name('password.reset.submit');

Route::get('/reset-password', [PasswordResetLinkController::class, 'passwordResetConfirm'])->name('password.reset.comfirm');

Route::post('/reset-password/submit', [PasswordResetLinkController::class, 'passwordResetConfirmSubmit'])->name('password.reset.comfirm.submit');

require __DIR__ . '/auth.php';
