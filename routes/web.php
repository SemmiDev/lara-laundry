<?php

use App\Http\Controllers\LaundryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PriceListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'laundries', 'middleware' => 'auth'], function () {
    Route::get('/', [LaundryController::class, 'index'])->name('laundries.index');
    Route::get('/create', [LaundryController::class, 'create'])->name('laundries.create');
    Route::post('/', [LaundryController::class, 'store'])->name('laundries.store');
    Route::get('/{laundry}', [LaundryController::class, 'show'])->name('laundries.show');
    Route::get('/{laundry}/edit', [LaundryController::class, 'edit'])->name('laundries.edit');
    Route::put('/{laundry}', [LaundryController::class, 'update'])->name('laundries.update');
    Route::delete('/{laundry}', [LaundryController::class, 'destroy'])->name('laundries.destroy');

    Route::get('/{laundry}/price_lists', [PriceListController::class, 'index'])->name('price_lists.index');
    Route::get('/{laundry}/price_lists/create', [PriceListController::class, 'create'])->name('price_lists.create');
    Route::post('{laundry}/price_lists', [PriceListController::class, 'store'])->name('price_lists.store');
    Route::get('/{laundry}/price_lists/{price_list}', [PriceListController::class, 'edit'])->name('price_lists.edit');
    Route::put('/{laundry}/price_lists/{price_list}', [PriceListController::class, 'update'])->name('price_lists.update');
    Route::delete('/{laundry}/price_lists/{price_list}', [PriceListController::class, 'destroy'])->name('price_lists.destroy');

    Route::get('/{laundry}/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/{laundry}/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('{laundry}/packages', [PackageController::class, 'store'])->name('packages.store');
    Route::get('/{laundry}/packages/{package}', [PackageController::class, 'edit'])->name('packages.edit');
    Route::put('/{laundry}/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('/{laundry}/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');

    Route::get('/{laundry}/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{laundry}/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/{laundry}/orders/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/{laundry}/orders/confirm', [OrderController::class, 'confirmStore'])->name('orders.confirm');
    Route::post('{laundry}/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/{laundry}/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/{laundry}/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/{laundry}/statistic', [OrderController::class, 'statistic'])->name('statistics.index');
});

Route::get('/orders/tracking', [OrderController::class, 'tracking'])->name('tracking.index');
