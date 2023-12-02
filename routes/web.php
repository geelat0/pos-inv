<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserManagementController;
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

Route::get('/', [Auth\AuthController::class, 'index']);
Route::get('/login', [Auth\AuthController::class, 'index'])->name('login');
Route::post('/login', [Auth\AuthController::class, 'login']);
Route::get('/home', [Auth\AuthController::class, 'home']);
Route::get('/logout', [Auth\AuthController::class, 'logout']);






Route::middleware(['auth'])->group(function () {

    Route::get('/generate/{id}', [\App\Http\Controllers\BarcodeController::class, 'index']);

    Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'index']);
    Route::post('/profile-update', [\App\Http\Controllers\ProfileController::class, 'update']);
    Route::post('/change-password/{id}', [\App\Http\Controllers\ProfileController::class, 'changePassword']);
});




///  admin
Route::group([
    'middleware' => ['auth', 'admin'],
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {

    Route::get('/', [AdminController::class, 'index']); // sample

    // Category Module
    Route::get('/item-category', [AdminController::class, 'item_category']);
    Route::post('/store-category', [AdminController::class, 'storeCategory']);
    Route::post('/category-status', [AdminController::class, 'CategoryStatus']);
    Route::post('/update_category', [AdminController::class, 'updateCategory']);

    // Supplier Module
    Route::get('/supplier', [AdminController::class, 'supplier']);
    Route::post('/store-supplier', [AdminController::class, 'storeSupplier']);
    Route::post('/supplier-status', [AdminController::class, 'SupplierStatus']);
    Route::post('/update_supplier', [AdminController::class, 'updateSupplier']);

    // Stocks Module
    Route::get('/stocks', [AdminController::class, 'stocks']);
    Route::get('/getItems', [AdminController::class, 'getItems']);
    Route::post('/add-stocks', [AdminController::class, 'storeStocks']);
    Route::post('/restocks', [AdminController::class, 'storeRestock']);
    Route::post('/stock-status', [AdminController::class, 'StockStatus']);
    Route::post('/item-status', [AdminController::class, 'ItemStatus']);
    Route::post('/update_item', [AdminController::class, 'updateStocks']);

    // Return Item Module
    Route::get('/return', [AdminController::class, 'return']);
    Route::post('/add-return', [AdminController::class, 'AddReturn']);
    Route::post('/add-grounds', [AdminController::class, 'storeReturnGrounds']);
    Route::post('/remove', [AdminController::class, 'removereturnItem']);
    Route::get('/search', [AdminController::class, 'search']);

    // user management
    Route::get('/user-management', [UserManagementController::class, 'index']);
    Route::post('/store-user', [UserManagementController::class, 'store']);
    Route::post('/update-user/{user}', [UserManagementController::class, 'update']);
    Route::post('/update-user-password/{user}', [UserManagementController::class, 'changePassword']);
    Route::get('/view-user/{user}', [UserManagementController::class, 'show'])->name('viewUser');

    Route::get('/monthly', [AdminController::class, 'monthly']);

});

//  manager
Route::group([
    'middleware' => ['auth', 'manager'],
    'prefix' => 'manager',
    'as' => 'manager.',
], function () {

    Route::get('/', [ManagerController::class, 'index']); // sample

    // Category Module
    Route::get('/item-category', [ManagerController::class, 'item_category']);
    Route::post('/store-category', [ManagerController::class, 'storeCategory']);
    Route::post('/category-status', [ManagerController::class, 'CategoryStatus']);
    Route::post('/update_category', [ManagerController::class, 'updateCategory']);

    // Supplier Module
    Route::get('/supplier', [ManagerController::class, 'supplier']);
    Route::post('/store-supplier', [ManagerController::class, 'storeSupplier']);
    Route::post('/supplier-status', [ManagerController::class, 'SupplierStatus']);
    Route::post('/update_supplier', [ManagerController::class, 'updateSupplier']);

    // Stocks Module
    Route::get('/stocks', [ManagerController::class, 'stocks']);
    Route::get('/getItems', [ManagerController::class, 'getItems']);
    Route::post('/add-stocks', [ManagerController::class, 'storeStocks']);
    Route::post('/restocks', [ManagerController::class, 'storeRestock']);
    Route::post('/stock-status', [ManagerController::class, 'StockStatus']);
    Route::post('/item-status', [ManagerController::class, 'ItemStatus']);
    Route::post('/update_item', [ManagerController::class, 'updateStocks']);

    // Return Item Module
    Route::get('/return', [ManagerController::class, 'return']);
    Route::post('/add-return', [ManagerController::class, 'AddReturn']);
    Route::post('/add-grounds', [ManagerController::class, 'storeReturnGrounds']);
    Route::post('/remove', [ManagerController::class, 'removereturnItem']);
    Route::get('/search', [ManagerController::class, 'search']);

    Route::get('/monthly', [ManagerController::class, 'monthly']);


});
//  employee
Route::group([
//    'middleware' => ['auth', ',employee'],
    'prefix' => 'employee',
    'as' => 'employee.',
], function () {

    Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index']);
    Route::get('/receipt/{id}', [\App\Http\Controllers\EmployeeController::class, 'receipt']);
    Route::get('/void', [\App\Http\Controllers\EmployeeController::class, 'void']);
    Route::get('/report', [\App\Http\Controllers\EmployeeController::class, 'report']);

    Route::get('/items', [\App\Http\Controllers\EmployeeController::class, 'searchProductByNameOrID']);
    Route::post('/add-cart', [\App\Http\Controllers\EmployeeController::class, 'addCart']);
    Route::post('/change-quantity', [\App\Http\Controllers\EmployeeController::class, 'changeQuantity']);
    Route::get('/add-item', [\App\Http\Controllers\EmployeeController::class, 'addItem']);

    Route::post('/void-login', [\App\Http\Controllers\EmployeeController::class, 'verifyCredentials']);
    Route::post('/void-item', [\App\Http\Controllers\EmployeeController::class, 'voidItem']);
    Route::get('/void-done', [\App\Http\Controllers\EmployeeController::class, 'voidDone']);
    Route::post('/pay-now', [\App\Http\Controllers\EmployeeController::class, 'payNow']);


});


Route::get('/scanner', [\App\Http\Controllers\EmployeeController::class, 'index']);





