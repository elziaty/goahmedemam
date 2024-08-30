<?php

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

use Illuminate\Support\Facades\Route;
use Modules\TaxRate\Http\Controllers\TaxRateController;

Route::middleware(['XSS','IsInstalled'])->group(function(){
    Route::middleware(['auth'])
        ->prefix('settings/tax-rate')
        ->controller(TaxRateController::class)
        ->name('settings.tax.rate.')
        ->group(function(){
            Route::get('/',                      'index')->name('index')->middleware('hasPermission:tax_rate_read');
            Route::get('/create',                'create')->name('create')->middleware('hasPermission:tax_rate_create');
            Route::post('/store',                'store')->name('store')->middleware('hasPermission:tax_rate_create');
            Route::get('/edit/{id}',             'edit')->name('edit')->middleware('hasPermission:tax_rate_update');
            Route::put('/update',                'update')->name('update')->middleware('hasPermission:tax_rate_update');
            Route::delete('/delete/{id}',        'destroy')->name('delete')->middleware('hasPermission:tax_rate_delete');
            Route::get('/status-update/{id}',    'statusUpdate')->name('status.update')->middleware('hasPermission:tax_rate_status_update');
        });
});
