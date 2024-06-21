<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
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


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/order', [AdminDashboardController::class, 'order'])->name('admin.order');
    Route::get('/admin/user', [AdminDashboardController::class, 'user'])->name('admin.user');
    Route::get('/admin/user/create', [AdminDashboardController::class, 'user_create'])->name('admin.user.create');
    Route::get('/admin/product', [AdminDashboardController::class, 'product'])->name('admin.product');
    Route::get('/admin/product/create', [AdminDashboardController::class, 'product_create'])->name('admin.product.create');
    Route::post('/admin/product/store', [AdminDashboardController::class, 'product_store'])->name('admin.product.store');
    Route::post('/admin/product/delete', [AdminDashboardController::class, 'product_delete'])->name('admin.product.delete');
    Route::get('/admin/product/edit/{id}', [AdminDashboardController::class, 'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/edit/', [AdminDashboardController::class, 'product_update'])->name('admin.product.update');
    Route::get('/admin/contact', [AdminDashboardController::class, 'contact'])->name('admin.contact');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/order', [UserDashboardController::class, 'order'])->name('user.order');
    Route::get('/user/order_create', [UserDashboardController::class, 'order_create'])->name('user.order_create');
    Route::post('/user/order_create', [UserDashboardController::class, 'order_store'])->name('user.order_store');
    Route::get('/user/thanks', [UserDashboardController::class, 'thanks'])->name('user.thanks');
    Route::get('/user/select', [UserDashboardController::class, 'select'])->name('user.select');
    Route::get('/user/contact', [UserDashboardController::class, 'contact'])->name('user.contact');
    Route::post('/user/contact_store', [UserDashboardController::class, 'contact_store'])->name('user.contact_store');
    Route::get('/user/contact/thanks', [UserDashboardController::class, 'contact_thanks'])->name('user.contact.thanks');
});


require __DIR__ . '/auth.php';
