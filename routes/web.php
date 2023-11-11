<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AdminController;
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



///  admin
Route::group([
    'middleware' => ['auth', 'admin'],
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {

    Route::get('/', [AdminController::class, 'index']); // sample

    Route::get('/item-category', [AdminController::class, 'item_category']);
    Route::post('/store-category', [AdminController::class, 'storeCategory']);
    Route::post('/category-status', [AdminController::class, 'CategoryStatus']);
    Route::post('/update_category', [AdminController::class, 'updateCategory']);

    Route::get('/supplier', [AdminController::class, 'supplier']);
    Route::post('/store-supplier', [AdminController::class, 'storeSupplier']);
    Route::post('/supplier-status', [AdminController::class, 'SupplierStatus']);
    Route::post('/update_supplier', [AdminController::class, 'updateSupplier']);


    // user management
    Route::get('/user-management', [UserManagementController::class, 'index']);
    Route::post('/store-user', [UserManagementController::class, 'store']);
    Route::post('/update-user/{user}', [UserManagementController::class, 'update']);
    Route::post('/update-user-password/{user}', [UserManagementController::class, 'changePassword']);
    Route::get('/view-user/{user}', [UserManagementController::class, 'show'])->name('viewUser');






});

//  manager
Route::group([
    'middleware' => ['auth', ',manager'],
    'prefix' => 'manager',
    'as' => 'manager.',
], function () {

});
//  employee
Route::group([
    'middleware' => ['auth', ',employee'],
    'prefix' => 'employee',
    'as' => 'employee.',
], function () {

});



