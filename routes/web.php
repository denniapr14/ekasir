<?php

use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Dashboard;
use App\Http\Controllers\C_OrderCategory;
use App\Http\Controllers\C_Product;
use App\Http\Controllers\C_Transaction;
use App\Http\Controllers\C_User;
use App\Http\Controllers\C_productCategory;
use App\Http\Controllers\C_Schedule;
use App\Http\Controllers\C_EmployeSchedule;
use App\Http\Controllers\C_Checkout;
use App\Http\Controllers\C_TransactionReport;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {

// Route::get('/dashboard-admin-accounting', [AdminAccounting::class, 'index']);
// });



Route::get('/', [C_Login::class, 'index'])->name('login');
Route::post('/loginAction', [C_Login::class, 'LoginAction'])->name('loginAction');
Route::get('/logout', [C_Login::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [C_Dashboard::class, 'index'])->name('dashboard');

// Product
route::get('/Product', [C_Product::class, 'index'])->name('product');
route::get('/addProduct', [C_Product::class, 'addProduct'])->name('addProduct');
route::post('/addProductAction', [C_Product::class, 'addProductAction'])->name('addProductAction');
route::get('/editProduct/{id}', [C_Product::class, 'editProduct'])->name('editProduct');
route::post('/editProductAction/{id}', [C_Product::class, 'editProductAction'])->name('editProductAction');
route::get('/deleteProduk/{id}', [C_Product::class, 'deleteProduct'])->name('deleteProduct');

// productCategory
route::get('/addProductCategory', [C_ProductCategory::class, 'addProductCategory'])->name('addProductCategory');
route::post('/addProductCategoryAction', [C_ProductCategory::class, 'addProductCategoryAction'])->name('addProductCategoryAction');
route::get('/editProductCategory/{id}', [C_ProductCategory::class, 'editProductCategory'])->name('editProductCategory');
route::post('/editProductCategoryAction/{id}', [C_ProductCategory::class, 'editProductCategoryAction'])->name('editProductCategoryAction');
route::delete('/deleteProductCategory/{id}', [C_ProductCategory::class, 'deleteProductCategory'])->name('deleteroductCategory');

// OrderCategory
route::get('/orderCategory', [C_OrderCategory::class, 'index'])->name('orderCategory');
route::post('/addOrderCategoryAction', [C_OrderCategory::class, 'addOrderCategoryAction'])->name('addOrderCategoryAction');
route::post('/editOrderCategory/{id}', [C_OrderCategory::class, 'editOrderCategoryAction'])->name('editOrderCategoryAction');
route::get('/changeStatusOrderCategory/{id}', [C_OrderCategory::class, 'changeStatusOrderCategory'])->name('changeStatusOrderCategory');

// User
route::get('/user', [C_User::class, 'index'])->name('user');
route::get('/addUser', [C_User::class, 'addUser'])->name('addUser');
route::post('/addUserAction', [C_User::class, 'addUserAction'])->name('addUserAction');
route::post('/editUserAction/{id}', [C_User::class, 'editUserAction'])->name('editUserAction');
route::get('/detailUser/{id}', [C_User::class, 'detailUser'])->name('detailUser');
route::put('/editStatus/{id}', [C_User::class, 'UbahStatus'])->name('ubahStatus');
route::get('/editProfile',[C_User::class,'editprofile'])->name('editProfile');
route::post('/editProfile/action',[C_User::class,'editProfileAction'])->name('editProfileAction');
route::get('/deleteUser/{id}', [C_User::class, 'deleteUser'])->name('deleteUser');

// TRANSAKSI
route::get('/transaction', [C_Transaction::class, 'index'])->name('transaction');
route::get('/detailTransaksi/{id}/{status}', [C_Transaction::class, 'showDetail'])->name('detailTransaction');
route::get('/addTransaction/{id}/{status}/{count}/{price}/{startPrice}', [C_Transaction::class, 'addTransaction'])->name('addTransaction');
route::post('/costumTransactionAction/{id}', [C_Transaction::class, 'costumTransactionAction'])->name('costumTransactionAction');
Route::post('/update-cart-quantity/{id}/{action}', [C_Transaction::class, 'updateCartQuantity']);


// Cart

// Checkout
route::post('/checkoutAction/{id_user}', [C_Checkout::class, 'checkoutAction'])->name('checkoutAction');
route::get('/checkoutMidtrans/{orderID}',[C_Checkout::class,'checkoutMidtrans'])->name('checkoutMidtrans');
route::get('/payment/{orderID}',[C_Checkout::class,'payment'])->name('payment');

// Penjadwalan
route::get('/schedule', [C_Schedule::class, 'index'])->name('schedule');
route::get('/getDateSchedule', [C_Schedule::class, 'getDateSchedule'])->name('getDateSchedule');
route::post('/addSchedule', [C_Schedule::class, 'addScheduleAction'])->name('addScheduleAction');
route::get('/changeSchedule/{id}/{status}', [C_Schedule::class, 'changeSchedule'])->name('changeSchedule');

// Penjadwalan Karyawan
route::get('/employee-schedule', [C_EmployeSchedule::class, 'index'])->name('employeSchedule');
route::get('/getEmployeeSchedulule', [C_EmployeSchedule::class, 'getEmployeeSchedule'])->name('getEmployeeSchedule');
route::post('/addEmployeeScheduleAction', [C_EmployeSchedule::class, 'addEmployeeScheduleAction'])->name('addEmployeeScheduleAction');
route::post('/editEmployeeSchedule/{id_schedule}', [C_EmployeSchedule::class, 'editEmployeeScheduleAction'])->name('editEmployeeScheduleAction');
route::get('/deleteEmployeeSchedule/{id_schedule}', [C_EmployeSchedule::class, 'deleteEmployeeSchedule'])->name('deleteEmployeeSchedule');

// Laporan Transaksi
route::get('/report-order',[C_TransactionReport::class,'getReportOrder'])->name('reportOrder');
route::get('/export-pdf',[C_TransactionReport::class, 'exportPDF'])->name('exportPdf');
