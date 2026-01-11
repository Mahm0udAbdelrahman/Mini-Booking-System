<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ServiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome'); 
});

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {

        Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
        Route::post('/admin/login', [AuthController::class, 'loginAction'])->name('loginAction');

        Route::group(['middleware' => ['auth', 'notification', 'is_role:admin,provider'], 'prefix' => 'admin', 'as' => 'Admin.'], function () {
            // home
            Route::get('/home', [HomeController::class, 'index'])->name('home');
            Route::get('/delete/{model}/{id}', [HomeController::class, 'confirmDelete'])->name('confirmDelete');

            Route::prefix('services')->name('services.')->group(function () {
                Route::get('/', [ServiceController::class, 'index'])->name('index');
                Route::get('create', [ServiceController::class, 'create'])->middleware('can:create,App\Models\Service')->name('create');
                Route::post('/', [ServiceController::class, 'store'])->middleware('can:create,App\Models\Service')->name('store');
                Route::get('show/{service}', [ServiceController::class, 'show'])->middleware('can:view,service')->name('show');
                Route::get('edit/{service}', [ServiceController::class, 'edit'])->middleware('can:update,service')->name('edit');
                Route::put('update/{service}', [ServiceController::class, 'update'])->middleware('can:update,service')->name('update');
                Route::delete('{service}', [ServiceController::class, 'destroy'])->middleware('can:delete,service')->name('destroy');
                Route::post('{id}/restore', [ServiceController::class, 'restore'])->middleware('can:restore,App\Models\Service')->name('restore');
                Route::delete('{id}/force-delete', [ServiceController::class, 'forceDelete'])->middleware('can:forceDelete,App\Models\Service')->name('forceDelete');
            });

            // booking
            Route::prefix('booking')->name('booking.')->group(function () {
                Route::get('/', [BookingController::class, 'index'])->middleware('can:viewAnyDashboard,App\Models\Booking')->name('index');
                Route::get('show/{booking}', [BookingController::class, 'show'])->middleware('can:view,booking')->name('show');
                Route::get('edit/{booking}', [BookingController::class, 'edit'])->middleware('can:update,booking')->name('edit');
                Route::put('update/{booking}', [BookingController::class, 'update'])->middleware('can:update,booking')->name('update');
                Route::delete('{booking}', [BookingController::class, 'destroy'])->middleware('can:delete,booking')->name('destroy');
            });
            // logout
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        });
    });

