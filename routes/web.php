<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CartController;

// Public Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Login & Register
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// OTP Verification
Route::get('/verify', [VerificationController::class, 'showVerificationForm'])->name('verify.form');
Route::post('/verify-otp', [VerificationController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [VerificationController::class, 'resendOtp'])->name('resend.otp');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Admin Routes
    Route::middleware(['admin_auth'])->group(function () {

        // User List
        Route::get('user/list', [AdminController::class, 'userList'])->name('user#list');
        Route::get('user/changeUserRole', [AdminController::class, 'changeUserRole'])->name('user#changeUserRole');

        // Categories
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // Products
        Route::prefix('product')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('new', [ProductController::class, 'new'])->name('product#new');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('product#update');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('show/{id}', [ProductController::class, 'show'])->name('product#show');
        });

        // Admin Account
        Route::prefix('admin/account')->group(function () {
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('change-password', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('update-password', [AdminController::class, 'updatePassword'])->name('admin#updatePassword');
            Route::get('detail', [AdminController::class, 'detail'])->name('admin#detail');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('updateRole/{id}', [AdminController::class, 'updateRole'])->name('admin#updateRole');
        });

        // Orders
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'list'])->name('order#list');
            Route::get('status', [AjaxController::class, 'orderStatus'])->name('ajax#orderStatus');
            Route::get('filter', [AjaxController::class, 'filterOrders'])->name('ajax#filterOrders');
            Route::get('/order/download/csv', [OrderController::class, 'downloadCSV'])->name('order#csvDownload');
        });
    });

    // User Routes
    Route::prefix('user')->middleware('user_auth')->group(function () {
        Route::get('home', [UserController::class, 'home'])->name('user#home');
        Route::get('home/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('menu/{id}', [UserController::class, 'show'])->name('user#show');
        Route::get('changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
        Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('user#updatePassword');
        Route::get('view', [UserController::class, 'view'])->name('user#view');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user#edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user#update');

        // Carts
        Route::get('carts', [UserController::class, 'carts'])->name('user#carts');

        // Orders
        Route::get('history', [UserController::class, 'history'])->name('user#history');

        // Ajax for user
        Route::prefix('ajax')->group(function () {
            Route::get('menu', [AjaxController::class, 'menuList'])->name('ajax#menuList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('autoAddToCart', [AjaxController::class, 'autoAddToCart'])->name('ajax#autoAddToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
        });

    });

    Route::prefix('user/ajax')->group(function () {
        Route::post('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax.clear.cart');
        Route::post('remove', [AjaxController::class, 'remove'])->name('ajax.remove.item');
    });

    // Order List for both admin/user
    Route::get('orderList/{id}', [OrderController::class, 'orderList'])->name('orderList');
});

// Checkout (user only)
Route::middleware(['user_auth'])->group(function () {
    Route::get('/user/checkout', [CheckoutController::class, 'index'])->name('user#checkout');
    Route::post('/user/checkout/submit', [CheckoutController::class, 'submit'])->name('user#checkoutSubmit');
});

Route::get('/team', function () {
    return view('team');
})->name('team');

