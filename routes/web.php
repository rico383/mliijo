<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ImageController;
use Illuminate\Contracts\Session\Session;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

//Authentication session
Route::get('/', [SessionController::class, 'index'])->name('session.index');
Route::post('/', [SessionController::class, 'store'])->name('session.store');
Route::post('/register', [SessionController::class, 'create'])->name('session.create');
Route::post('/logout', [SessionController::class, 'destroy'])->name('session.destroy');
Route::get('/error', [SessionController::class, 'show'])->name('session.show');
Route::get('/register-show', [SessionController::class, 'edit'])->name('session.edit');

//Home session
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

//Admin profile session
Route::get('/profile-index', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');;
Route::get('/profile-show', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');;
Route::middleware('auth')->post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
Route::middleware('auth')->delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::middleware('auth')->post('/password-edit', [ProfileController::class, 'edit'])->name('profile.edit');

//Product session
Route::get('/product-index', [ProductController::class, 'index'])->name('product.index')->middleware('auth');
Route::get('/product-show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product-add', [ProductController::class, 'store'])->name('product.store');
Route::post('/product-update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product-delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

//Order session
Route::get('/order-delete', [OrderController::class, 'index'])->name('order.index')->middleware('auth');
Route::get('/order-show', [OrderController::class, 'show'])->name('order.show')->middleware('auth');
Route::post('/order-update/{id}', [OrderController::class, 'update'])->name('order.update');
Route::delete('/order-destroy', [OrderController::class, 'destroy'])->name('order.destroy');

//Date session
Route::post('/date-update/{id}', [DateController::class, 'update'])->name('date.update');
Route::get('/date-show/{id}', [DateController::class, 'show'])->name('date.show');

//Admin session
Route::get('/admin-get', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::post('/admin-update/{id}', [AdminController::class, 'update'])->name('admin.update')->middleware('auth');
Route::delete('/admin-delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

//Customer session
Route::get('/customer-index', [CustomerController::class, 'index'])->name('customer.index')->middleware('auth');
Route::delete('/customer-delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

//Employee session
Route::get('/employee-index', [EmployeeController::class, 'index'])->name('employee.index')->middleware('auth');
Route::post('/employee-add', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('/employee-update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee-delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

//Partner session
Route::get('/partner-index', [PartnerController::class, 'index'])->name('partner.index')->middleware('auth');
Route::post('/partner-add', [PartnerController::class, 'store'])->name('partner.store');
Route::post('/partner-update/{id}', [PartnerController::class, 'update'])->name('partner.update');
Route::delete('/partner-delete/{id}', [PartnerController::class, 'destroy'])->name('partner.destroy');

//Message session
Route::get('/message-index', [MessageController::class, 'index'])->name('message.index')->middleware('auth');
Route::delete('/message-delete', [MessageController::class, 'destroy'])->name('message.destroy');


Route::get('/download-image/{proof_payment}', [ImageController::class, 'download'])->name('image.download');
