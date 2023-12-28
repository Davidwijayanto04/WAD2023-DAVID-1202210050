<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


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
    return view('welcome');
})->name('home');

Route::get('/login', [App\Http\Controllers\AuthManager::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/registration', [App\Http\Controllers\AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [App\Http\Controllers\AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [App\Http\Controllers\AuthManager::class, 'logout'])->name('logout');

Route::get('/user/home', [App\Http\Controllers\UserController::class, 'home'])->name('user.home');

Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');
Route::delete('/admin/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.delete');
Route::get('/admin/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');

Route::middleware(['auth'])->group(function () {

    Route::get('/user/tenants', [UserController::class, 'showTenants'])->name('user.tenants');
    Route::get('/user/tenant/{tenantId}/menu', [UserController::class, 'showTenantMenu'])->name('user.tenant.menu');
    Route::get('/user/order', [UserController::class, 'showOrderForm'])->name('user.order.form');
    Route::post('/user/order', [UserController::class, 'createOrder'])->name('user.order');
    Route::get('/user/order/status', [UserController::class, 'viewOrderStatus'])->name('user.order.status');
    Route::get('/user/order/{orderId}/confirm-received', [UserController::class, 'confirmReceived'])->name('user.order.confirmReceived');

    Route::get('/admin/orders', [AdminController::class, 'viewOrders'])->name('admin.orders');
    Route::put('/admin/order/update/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.order.update');
    Route::get('/admin/menu/create', [AdminController::class, 'showMenuForm'])->name('admin.menu.create');
    Route::post('/admin/menu/store', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
    Route::post('/admin/order/cancel/{id}', [AdminController::class, 'cancelOrder'])->name('admin.order.cancel');
});