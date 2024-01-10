<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CompanyController;
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
Route::view('/cancel', 'cancel')->name('cancel');

Route::get('/register', \App\Http\Livewire\Registration::class)->name('subscription.create');

Route::get('/dashboard', function () {
    return redirect('/admin');
});

// Contact form submissions
Route::post('contact/form', [\App\Http\Controllers\ContactController::class, 'contactForm'])->name('contact.form');
Route::post('contact/demo', [\App\Http\Controllers\ContactController::class, 'contactDemo'])->name('contact.demo');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

     //  // Invoice Routes
     Route::group(['middleware' => 'admin.user' ], function ()  {
        Route::get('invoices',   [InvoiceController::class, 'index'])->name('voyager.invoices.index');
        Route::get('invoices/create',   [InvoiceController::class, 'create'])->name('voyager.invoices.create');
        Route::post('invoices/{invoice}/add-item',   [InvoiceController::class, 'addItem'])->name('voyager.invoices.add-item');
        Route::get('invoices/{invoice}/save-item/{item}',   [InvoiceController::class, 'saveItem'])->name('voyager.invoices.save-item');
        Route::get('invoices/{invoice}/delete-item/{item}',   [InvoiceController::class, 'deleteItem'])->name('voyager.invoices.delete-item');
        Route::post('invoices/{invoice}/add-meta-column',   [InvoiceController::class, 'addItemMetaColumn'])->name('voyager.invoices.add-meta-column');

        // Temporary route to generate PDF with DOMPDF
        Route::get('invoices/{invoice}/pdf/',   [InvoiceController::class, 'generatePdf'])->name('voyager.invoices.pdf');

        Route::get('invoices/{invoice}/save-pricing/',   [InvoiceController::class, 'savePricing'])->name('voyager.invoices.save-pricing');
        Route::post('invoices/{invoice}/add-pricing-column',   [InvoiceController::class, 'addPricingColumn'])->name('voyager.invoices.add-pricing-column');
        Route::delete('/invoices/{id}/delete', [InvoiceController::class, 'delete'])->name('voyager.invoices.delete');

    });


     //  // Product Routes
     Route::group(['middleware' => 'admin.user' ], function ()  {
        Route::post('products/{product}/add-product-column',   [ProductController::class, 'addProductColumn'])->name('voyager.products.add-product-column');
        Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('voyager.products.delete');
        Route::get('/products-meta/{id}/delete', [ProductController::class, 'deleteMeta'])->name('product-meta.delete');

    
    });
  

      //Store  Routes
      Route::group(['middleware' => 'admin.user' ], function ()  {
        Route::get('stores',   [StoreController::class, 'index'])->name('voyager.stores.index');
        Route::get('/stores/create', [StoreController::class, 'create'])->name('voyager.stores.create');
        Route::post('stores', [StoreController::class, 'store'])->name('voyager.stores.store');
        Route::delete('/stores/{id}/delete', [StoreController::class, 'delete'])->name('voyager.stores.delete');
        Route::put('/stores/{storeId}', [StoreController::class, 'update'])->name('stores.update');
        Route::delete('/store-employee/{id}', [StoreController::class, 'deleteStoreEmployee'])->name('delete-store-employee');


       
    });

    // Add Employee Routes Store Manager & Sales Person 
    Route::group(['middleware' => 'admin.user' ], function ()  {
        Route::get('employee',   [EmployeeController::class, 'index'])->name('voyager.employee.index');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('voyager.employee.create');
        Route::post('employee', [EmployeeController::class, 'store'])->name('voyager.employee.store');
        
       
    });

    // company profile
    
    Route::group(['middleware' => 'admin.user' ], function ()  {
        Route::get('/company',   [CompanyController::class, 'index'])->name('voyager.company.index');
        Route::put('/company/{id}', [CompanyController::class, 'update'])->name('company.update');
        Route::get('/company/logs',   [CompanyController::class, 'show'])->name('voyager.company.logs');
        Route::post('/add-room-location', [CompanyController::class, 'addRoomLocation'])->name('addRoomLocation');
        Route::get('/subscription/{subscription}/edit', [SubscriptionController::class, 'show'])->name('subscription-edit');



        
    });


});

require __DIR__.'/auth.php';