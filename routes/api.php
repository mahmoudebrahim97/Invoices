<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::group(['middleware' => ['jwt.verify']], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

    //invoices
    Route::get('index/invoices', [InvoiceController::class, 'index']);
    Route::post("invoices/insert", [InvoiceController::class, "insert"]);
    Route::get("invoices/details/{id}", [InvoiceController::class, "details"]);

    //products
    Route::post('index/insert', [ProductController::class, 'insert']);
    Route::post('index/update/{id}', [ProductController::class, 'update']);
    Route::delete('index/delete/{id}', [ProductController::class, 'delete']);

    //sections

    Route::get('sections', [SectionController::class, 'sections']);
    Route::get('get_section/{id}', [SectionController::class, 'get_section']);
    Route::post('insert_section', [SectionController::class, 'insert_section']);

});
