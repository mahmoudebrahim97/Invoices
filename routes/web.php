<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//______________________________________________________________________________________________//

// .. login ,, register  .. //

Route::get('/', function () {
    return view('auth.login');
});
// Route::get("register", function () {
//     return view('auth.register');
// });

// .. auth_jetStream .. //

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','check.account.status'
    ])->group(function () {
        Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');
});

// .. invoices list .. //
Route::get("index/invoices", [InvoiceController::class, "index"])->name('invoices');
Route::get("invoices/add", [InvoiceController::class, "add"])->name('invoices.add');
Route::post("invoices/insert", [InvoiceController::class, "insert"])->name('invoices.insert');
Route::get("invoices/details/{id}", [InvoiceController::class, "details"])->name('invoice.details');
Route::get("invoices/edit/{id}", [InvoiceController::class, "edit"])->name('invoice.edit');
Route::post("invoices/update/{id}", [InvoiceController::class, "update"])->name('invoice.update');
Route::get("invoices/delete/{id}", [InvoiceController::class, "delete"])->name('invoice.delete');
Route::get("invoices/delete_1/{id}", [InvoiceController::class, "delete_1"])->name('invoice.delete_1');
Route::get("invoices/archive/{id}", [InvoiceController::class, "archive"])->name('invoice.archive');
Route::get("invoices/softDeleted", [InvoiceController::class, "softDeleted"])->name('invoice.softDeleted');
Route::get("invoices/restore/{id}", [InvoiceController::class, "restore"])->name('invoice.restore');
Route::get("invoices/forceDelete/{id}", [InvoiceController::class, "forceDelete"])->name('invoice.forceDelete');
Route::get("invoices/forceDelete_1/{id}", [InvoiceController::class, "forceDelete_1"])->name('invoice.forceDelete_1');
Route::get("invoices/status/{id}", [InvoiceController::class, "status"])->name('invoice.status');
Route::get("invoices/showInvoice/{id}", [InvoiceController::class, "showInvoice"])->name('invoice.showInvoice');
Route::post("invoices/status_update/{id}", [InvoiceController::class, "status_update"])->name('invoice.status_update');
Route::get("invoices/paid", [InvoiceController::class, "paid_invoices"])->name('paid_invoices');
Route::get("invoices/unpaid", [InvoiceController::class, "unpaid_invoices"])->name('unpaid_invoices');
Route::get("invoices/spaid", [InvoiceController::class, "spaid_invoices"])->name('spaid_invoices');
Route::get('viewFile/{invoice_number}/{file_name}',[InvoiceAttachmentsController::class,'viewFile'] )->name('viewFile');
Route::get('downloadFile/{id}',[InvoiceAttachmentsController::class,'downloadFile'] )->name('downloadFile');
Route::get('deleteFile/{id}',[InvoiceAttachmentsController::class,'deleteFile'] )->name('deleteFile');
Route::get("/section/{id}", [InvoiceController::class, 'getproducts']);

// .. sections .. //
Route::get('index/sections', [SectionController::class, 'index'])->name('sections');
Route::post('sections/insert', [SectionController::class, 'insert']);
Route::get("section/edit/{id}", [SectionController::class, 'edit']);
Route::post('sections/update/{id}', [SectionController::class, 'update'])->name('update');
Route::get('sections/delete_1/{id}', [SectionController::class, 'delete_1'])->name('delete_1');
Route::get('sections/delete_2/{id}', [SectionController::class, 'delete_2'])->name('delete_2');

// .. products .. //
Route::get('index/products', [ProductController::class, 'index'])->name('products');
Route::post('index/insert', [ProductController::class, 'insert'])->name('products.insert');
Route::get('index/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('index/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('index/delete1/{id}', [ProductController::class, 'delete1'])->name('products.delete1');
Route::get('index/delete2/{id}', [ProductController::class, 'delete2'])->name('products.delete2');

// .. permission .. //

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

// .. reports .. //
Route::get("invoices/reports", [ReportsController::class, "reports"])->name('invoices_reports');
Route::post("invoices/invoices_search", [ReportsController::class, "invoices_search"])->name('invoices_search');
Route::get("invoices/customers", [ReportsController::class, "customers"])->name('customers');
Route::post("invoices/customers_search", [ReportsController::class, "customers_search"])->name('customers_search');

// .. notifications .. //
Route::get('markAsRead',[InvoiceController::class,'markAsRead'])->name('markAsRead');
Route::get("invoices/details_notify/{id}", [InvoiceController::class, "details_notify"])->name('invoice.details_notify');

// .. home page .. //
Route::get('/{page}', [AdminController::class, "index"]);
