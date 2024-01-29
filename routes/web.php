<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

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
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales');

Route::get('/sales', [SaleController::class, 'index'])->middleware(['auth'])->name('coffee.sales');
Route::post('/addsale', [SaleController::class, 'addsale'])->middleware(['auth'])->name('coffee.addsales');

Route::get('/shipping-partners', function () {
    return view('shipping_partners');
})->middleware(['auth'])->name('shipping.partners');

require __DIR__.'/auth.php';
