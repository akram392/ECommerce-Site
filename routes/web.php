<?php

use Illuminate\Support\Facades\Route;
// Frontend Controller
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\SslCommerzPaymentController;

// Backend Controller
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OrderManagement;

/*
|--------------------------------------------------------------------------
| Frontend Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PagesController::class, 'index'])->name('homepage');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact-Mail', [PagesController::class, 'contactMail'])->name('contactMail');

//  Product Pages
Route::get('/all-products', [PagesController::class, 'products'])->name('products');
Route::get('/product-details/{slug}', [PagesController::class, 'pdetails'])->name('pdetails');

// User Login Pages
Route::get('/user-login', [PagesController::class, 'userLogin'])->name('userLogin');
Route::get('/customer-dashboard', [CustomerController::class, 'index'])->name('customerDashboard');
Route::post('/update/{id}', [CustomerController::class, 'update'])->name('dashboard.update');

//  Cart
Route::group(['prefix'=>'cart'], function(){
    Route::get('/', [CartController::class, 'index'])->name('cart.manage');
    Route::post('/store', [CartController::class, 'store'])->name('cart.store');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
});


//  Checkout
 Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');


// SSLCOMMERZ Start
Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('makePayment');

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'admin'], function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

    // Brand Group
    Route::group(['prefix'=>'/brand'], function(){
        Route::get('/manage', [BrandController::class, 'index'])->name('brand.manage');
        Route::get('/trash', [BrandController::class, 'trash'])->name('brand.trash');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/show', [BrandController::class, 'show'])->name('brand.show');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::post('/destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    });

    // Category Group
    Route::group(['prefix'=>'/category'], function(){
        Route::get('/manage', [CategoryController::class, 'index'])->name('category.manage');
        Route::get('/trash', [CategoryController::class, 'trash'])->name('category.trash');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/show', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Product Group
    Route::group(['prefix'=>'/product'], function(){
        Route::get('/manage', [ProductController::class, 'index'])->name('product.manage');
        Route::get('/trash', [ProductController::class, 'trash'])->name('product.trash');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/show', [ProductController::class, 'show'])->name('product.show');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::post('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    // Division Group
    Route::group(['prefix'=>'/division'], function(){
        Route::get('/manage', [DivisionController::class, 'index'])->name('division.manage');
        Route::get('/trash', [DivisionController::class, 'trash'])->name('division.trash');
        Route::get('/create', [DivisionController::class, 'create'])->name('division.create');
        Route::post('/store', [DivisionController::class, 'store'])->name('division.store');
        Route::get('/show', [DivisionController::class, 'show'])->name('division.show');
        Route::get('/edit/{id}', [DivisionController::class, 'edit'])->name('division.edit');
        Route::post('/update/{id}', [DivisionController::class, 'update'])->name('division.update');
        Route::post('/destroy/{id}', [DivisionController::class, 'destroy'])->name('division.destroy');
    });

    // District Group
    Route::group(['prefix'=>'/district'], function(){
        Route::get('/manage', [DistrictController::class, 'index'])->name('district.manage');
        Route::get('/trash', [DistrictController::class, 'trash'])->name('district.trash');
        Route::get('/create', [DistrictController::class, 'create'])->name('district.create');
        Route::post('/store', [DistrictController::class, 'store'])->name('district.store');
        Route::get('/show', [DistrictController::class, 'show'])->name('district.show');
        Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
        Route::post('/update/{id}', [DistrictController::class, 'update'])->name('district.update');
        Route::post('/destroy/{id}', [DistrictController::class, 'destroy'])->name('district.destroy');
    });

    // User Group
    Route::group(['prefix'=>'/user'], function(){
        Route::get('/manage', [UserController::class, 'index'])->name('user.manage');
        Route::get('/trash', [UserController::class, 'trash'])->name('user.trash');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/show', [UserController::class, 'show'])->name('user.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // Order Group
    Route::group(['prefix'=>'/order-management'], function(){
        Route::get('/all-orders', [OrderManagement::class, 'index'])->name('all.orders');
        Route::get('/edit/{id}', [OrderManagement::class, 'edit'])->name('order.edit');
        Route::post('/update/{id}', [OrderManagement::class, 'update'])->name('order.update');
    });
});

require __DIR__.'/auth.php';
