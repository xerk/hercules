<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ExtractDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('vendor.hercules.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/clients', [ExtractDataController::class, 'index'])->name('clients');
Route::middleware(['auth:sanctum', 'verified'])->put('/dashboard/clients', [ExtractDataController::class, 'export2'])->name('clients.export');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{id}/download', [ExtractDataController::class, 'download'])->name('clients.download');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/purchase', [PurchaseController::class, 'index'])->name('purchase');
Route::middleware(['auth:sanctum', 'verified'])->post('/dashboard/purchase', [PurchaseController::class, 'redeem'])->name('purchase.redeem');


Route::get('lang/{locale}', function ($locale) {
    $validLocale = in_array($locale, ['ar', 'en']);
    if ($validLocale) {
        session()->put('locale', $locale);
        session()->get('locale');
    }
    return back();
});
