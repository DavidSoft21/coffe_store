<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LogoutController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard',[SaleController::class, 'index'])->name('dashboard'); 
    Route::resource('product', ProductController::class);
    Route::post('/product_update/{id}', [ProductController::class,'actualizar'])->name('product.actualizar');
    Route::post('/product_delete/{id}', [ProductController::class, 'eliminar'])->name('product.eliminar');
    Route::resource('sale', SaleController::class);
    Route::post('/sale_update/{id}', [SaleController::class, 'actualizar'])->name('sale.actualizar');
    Route::post('/sale_delete/{id}', [SaleController::class, 'eliminar'])->name('sale.eliminar');
    Route::get('/inventario', [SaleController::class, 'inventario'])->name('sale.inventario');
    Route::get('/', [SaleController::class, 'inventario'])->name('sale.inventario');
});


Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Route
     */
    Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');
});


