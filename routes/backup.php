<?php

use Illuminate\Support\Facades\Route;
// Frontend Controller
use App\Http\Controllers\Frontend\PagesController;

// Backend Controller
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\DistrictController;

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
//  Product Pages 
Route::get('/products', [PagesController::class, 'products'])->name('products');
Route::get('/details', [PagesController::class, 'pdetails'])->name('pdetails');
// User Login Pages 
Route::get('/user-login', [PagesController::class, 'userLogin'])->name('userLogin');
Route::get('/customer-dashboard', [PagesController::class, 'customerDashboard'])->name('customerDashboard');
//  Cart & Checkout 
 Route::get('/cart', [PagesController::class, 'cart'])->name('cart');
 Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');


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
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
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
});













<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';