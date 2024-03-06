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

    Route::get('/users', [UserController::class, 'List'])->name('users.list');

    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');

    Route::get('/users/profile/{id}', [UserController::class, 'viewUserProfile'])->name('user.profile.view');

    Route::post('/users/add/submit', [UserController::class, 'addSubmit'])->name('users.add.submit');

    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');

    Route::post('/users/edit/submit', [UserController::class, 'editSubmit'])->name('users.edit.submit');

    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

    // Product Feet

    Route::get('/feet', [ProductFeetController::class, 'List'])->name('feet.list');

    Route::get('/feet/add', [ProductFeetController::class, 'add'])->name('feet.add');

    Route::post('/feet/add/submit', [ProductFeetController::class, 'addSubmit'])->name('feet.add.submit');

    Route::get('/feet/edit/{id}', [ProductFeetController::class, 'edit'])->name('feet.edit');

    Route::post('/feet/edit/submit', [ProductFeetController::class, 'editSubmit'])->name('feet.edit.submit');

    Route::get('/feet/delete/{id}', [ProductFeetController::class, 'delete'])->name('feet.delete');

    // Product Type

    Route::get('/type', [ProductTypeController::class, 'List'])->name('type.list');

    Route::get('/type/add', [ProductTypeController::class, 'add'])->name('type.add');

    Route::post('/type/add/submit', [ProductTypeController::class, 'addSubmit'])->name('type.add.submit');

    Route::get('/type/edit/{id}', [ProductTypeController::class, 'edit'])->name('type.edit');

    Route::post('/type/edit/submit', [ProductTypeController::class, 'editSubmit'])->name('type.edit.submit');

    Route::get('/type/delete/{id}', [ProductTypeController::class, 'delete'])->name('type.delete');

    // User Roles

    Route::get('/role', [RoleController::class, 'List'])->name('role.list');

    Route::get('/role/add', [RoleController::class, 'add'])->name('role.add');

    Route::post('/role/add/submit', [RoleController::class, 'addSubmit'])->name('role.add.submit');

    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');

    Route::post('/role/edit/submit', [RoleController::class, 'editSubmit'])->name('role.edit.submit');

    Route::get('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

    // Product

    Route::get('/product', [ProductController::class, 'List'])->name('product.list');

    Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');

    Route::post('/product/add/submit', [ProductController::class, 'addSubmit'])->name('product.add.submit');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::post('/product/edit/submit', [ProductController::class, 'editSubmit'])->name('product.edit.submit');

    Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/product/deleted/list', [ProductController::class, 'deletedList'])->name('product.deleted.list');

    Route::get('/product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');

    Route::get('/product/{id}/details', [ProductController::class, 'detailsView'])->name('product.details.view');

    Route::get('/product/{id}/orders', [ProductController::class, 'ordersView'])->name('product.orders.view');

    Route::get('/product/{id}/teams', [ProductController::class, 'teamsView'])->name('product.teams.view');

    Route::get('/product/{id}/stock', [ProductController::class, 'stockView'])->name('product.stock.view');

    Route::get('/product/{id}/other', [ProductController::class, 'otherView'])->name('product.other.view');

    // Order Statuses

    Route::get('/order-status', [OrderStatusController::class, 'List'])->name('order.status.list');

    Route::get('/order-status/add', [OrderStatusController::class, 'add'])->name('order.status.add');

    Route::post('/order-status/add/submit', [OrderStatusController::class, 'addSubmit'])->name('order.status.add.submit');

    Route::get('/order-status/{id}/edit', [OrderStatusController::class, 'edit'])->name('order.status.edit');

    Route::post('/order-status/edit/submit', [OrderStatusController::class, 'editSubmit'])->name('order.status.edit.submit');

    Route::get('/order-status/{id}/delete', [OrderStatusController::class, 'delete'])->name('order.status.delete');

    // Orders

    Route::get('/orders', [OrderController::class, 'list'])->name('orders.list');

    Route::get('/orders/datatable', [OrderController::class, 'datatblesList'])->name('orders.list.datatables');

    Route::get('/order/add', [OrderController::class, 'add'])->name('orders.add');

    Route::post('/order/add/submit', [OrderController::class, 'addSubmit'])->name('orders.add.submit');

    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    Route::post('/order/edit/submit', [OrderController::class, 'editSubmit'])->name('orders.edit.submit');

    Route::get('/order/{id}/delete', [OrderController::class, 'delete'])->name('orders.delete');

    Route::get('/order/{id}/view', [OrderController::class, 'viewOrder'])->name('orders.view');

    Route::post('/order/update/status', [OrderController::class, 'updateOrderStatus'])->name('orders.update.status');

    // Order Timeline 
    Route::get('/order/{id}/timeline/delete', [OrderController::class, 'deleteOrderTimeline'])->name('orders.timeline.delete');

    // Settings
    Route::get('/settings', [SettingsController::class, 'viewSettings'])->name('settings');

    Route::post('/settings/update', [SettingsController::class, 'updateSettings'])->name('settings.update');

    // Invoice
    Route::get('/Invoice/{orderId}/download', [InvoiceController::class, 'downloadInvoice'])->name('download.invoice');

    // Testimonials

    Route::get('/testimonials', [TestimonialContorller::class, 'List'])->name('testimonials.list');

    Route::get('/testimonials/add', [TestimonialContorller::class, 'add'])->name('testimonials.add');

    Route::post('/testimonials/add/submit', [TestimonialContorller::class, 'addSubmit'])->name('testimonials.add.submit');

    Route::get('/testimonials/edit/{id}', [TestimonialContorller::class, 'edit'])->name('testimonials.edit');

    Route::post('/testimonials/edit/submit', [TestimonialContorller::class, 'editSubmit'])->name('testimonials.edit.submit');

    Route::get('/testimonials/delete/{id}', [TestimonialContorller::class, 'delete'])->name('testimonials.delete');



    // forgot password
    Route::post('/forgot-password/submit', [PasswordResetLinkController::class, 'passwordResetSubmit'])->name('password.reset.submit');

    Route::get('/reset-password', [PasswordResetLinkController::class, 'passwordResetConfirm'])->name('password.reset.comfirm');

    Route::post('/reset-password/submit', [PasswordResetLinkController::class, 'passwordResetConfirmSubmit'])->name('password.reset.comfirm.submit');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.submit');

require __DIR__ . '/auth.php';
