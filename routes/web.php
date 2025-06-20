<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\StockManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Home;
use App\Http\Controllers\Cashier;
use App\Http\Controllers\Daashboard ;

Route::get('/',[Home::class,'index'])->name('home');

// -----------------------------------------------------------------
// -----------------------------------------------------------------
// -----------------------------------------------------------------

Route::get('dashboard', [Dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


// -----------------------------------------------------------------
// ------------------ STOCK MANAGEMENT -----------------------------
// -----------------------------------------------------------------


Route::get('stock_management',[StockManagement::class,'index'])->name('stock_management')->middleware(['auth', 'verified']);;

Route::get('stock_management/creteOredit/{id?}', [StockManagement::class,'indexCreateOrEdit'])->name('editOrcreate')->middleware(['auth', 'verified']);;

Route::post('stock_management/creteOredit/store', [StockManagement::class,'createOrupdate'])->name('stock_management.store');

Route::put('stock_management/creteOredit/update/{id}', [StockManagement::class,'createOrupdate'])->name('stock_management.update');

// -----------------------------------------------------------------
// ------------------ ORDER HISTORY    -----------------------------
// -----------------------------------------------------------------

Route::get('cashier_report', [Cashier::class, 'report'])->name('report')->middleware(['auth', 'verified']);

// -----------------------------------------------------------------
// ------------------ ORDER HISTORY    -----------------------------
// -----------------------------------------------------------------

Route::get('order_history', [Cashier::class,'orderHistory'])->name('order_history')->middleware(['auth', 'verified']);

// -------------------------------------------------------------------------------------
// -------------------------------------- CASHIER --------------------------------------
// -------------------------------------------------------------------------------------

Route::get('cashier', [Cashier::class,'index'])->name('cashier')->middleware(['auth', 'verified']);

Route::post('checkout', [Cashier::class,'order'])->name('checkout')->middleware(['auth', 'verified']);

// -------------------------------------------------------------------------------------------
// ------------------------------ AUTENTIFICATION  -------------------------------------------
// -------------------------------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
