<?php


use App\Models\User;
use App\Models\Price;
use App\Notifications\PurchasePoint;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SyncDataController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtractDataController;
use App\Mail\DataExported;

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

Route::middleware('local')->get('/', function () {
    $prices = Price::all();
    return view('vendor.hercules.index')->with([
        'prices' => $prices->load('priceLists')
    ]);
})->name('landingpage');

Route::get('dev', function() {
    Mail::to('gm.xerk@gmail.com')->send(new DataExported);
    // $user = User::where('email', 'gm.xerk@gmail.com')->first();
    // $user->notify(new PurchasePoint(92));

});

Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/search', [SearchController::class, 'index'])->name('search.index');
Route::middleware(['auth:sanctum', 'verified', 'local'])->post('/dashboard/search', [SearchController::class, 'store'])->name('search.store');

Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/sync-data', [SyncDataController::class, 'index'])->name('synnc.index');
Route::middleware(['auth:sanctum', 'verified', 'local'])->post('/dashboard/sync-data', [SyncDataController::class, 'store'])->name('sync.store');


Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/license/{id}/download', [DashboardController::class, 'download'])->name('license.download');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/clients', [ExtractDataController::class, 'index'])->name('clients');
Route::middleware(['auth:sanctum', 'verified', 'local'])->put('/dashboard/clients', [ExtractDataController::class, 'export'])->name('clients.export');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/{id}/download', [ExtractDataController::class, 'download'])->name('clients.download');

Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/purchase', [PurchaseController::class, 'index'])->name('purchase');
Route::middleware(['auth:sanctum', 'verified', 'local'])->post('/dashboard/purchase', [PurchaseController::class, 'redeem'])->name('purchase.redeem');

Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/tutorials', [TutorialController::class, 'index'])->name('tutorials');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/tutorials/{category}', [TutorialController::class, 'show'])->name('tutorials.show');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/tutorials/{category}/{tutorial}', [TutorialController::class, 'tutorial'])->name('tutorials.show.tutorial');

// Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/facebook/autocomplete', [FacebookController::class, 'autocomplete'])->name('facebook.autocomplete.find');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/facebook', [FacebookController::class, 'index'])->name('facebook.search');
Route::middleware(['auth:sanctum', 'verified', 'local'])->post('/dashboard/facebook', [FacebookController::class, 'find'])->name('facebook.find');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/facebook/{key}', [FacebookController::class, 'data'])->name('facebook.data');
Route::middleware(['auth:sanctum', 'verified', 'local'])->post('/dashboard/facebook/store', [FacebookController::class, 'store'])->name('facebook.store');
Route::middleware(['auth:sanctum', 'verified', 'local'])->get('/dashboard/{id}/download/facebook', [FacebookController::class, 'download'])->name('clients.fb.download');

Route::get('lang/{locale}', function ($locale) {
    $validLocale = in_array($locale, ['ar', 'en']);
    if ($validLocale) {
        session()->put('locale', $locale);
        session()->get('locale');
    }
    App::setLocale($locale);
    return back();
});

