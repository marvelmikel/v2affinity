<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Facades\Voyager;

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
    return view('home');
})->name('home');

Route::view('/about', 'about')->name('about');

Route::get('/register', \App\Http\Livewire\Registration::class)->name('subscription.create');

Route::get('/dashboard', function () {
    return redirect('/admin');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

     //  // Invoice Routes
     Route::group(['middleware' => 'admin.user' ], function ()  {
        Route::get('invoices',   [InvoiceController::class, 'index'])->name('voyager.invoices.index');
        Route::get('invoices/create',   [InvoiceController::class, 'create'])->name('voyager.invoices.create');

        Route::post('invoices/{invoice}/add-item',   [InvoiceController::class, 'addItem'])->name('voyager.invoices.add-item');
        Route::get('invoices/{invoice}/save-item/{item}',   [InvoiceController::class, 'saveItem'])->name('voyager.invoices.save-item');
        Route::post('invoices/{invoice}/add-meta-column',   [InvoiceController::class, 'addItemMetaColumn'])->name('voyager.invoices.add-meta-column');


        Route::get('invoices/{invoice}/save-pricing/',   [InvoiceController::class, 'savePricing'])->name('voyager.invoices.save-pricing');
        Route::post('invoices/{invoice}/add-pricing-column',   [InvoiceController::class, 'addPricingColumn'])->name('voyager.invoices.add-pricing-column');
        
        Route::delete('/invoices/{id}/delete', [InvoiceController::class, 'delete'])->name('voyager.invoices.delete');
    });


     //  // Product Routes
     Route::group(['middleware' => 'admin.user' ], function ()  {
        // Route::resource('products',   ProductController::class, ['as' => 'voyager']);
        Route::post('products/{product}/add-product-column',   [ProductController::class, 'addProductColumn'])->name('voyager.products.add-product-column');
       
    });

});

require __DIR__.'/auth.php';
