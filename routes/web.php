<?php

use App\Models\Payment;
use App\Models\session;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\DownPaymentController;
use App\Http\Controllers\TransactionController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);


Route::middleware('auth')->group(function () {

    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('/', function () {
        $customer = Customer::get();
        $pay = Payment::get();
        $sess = session::get();
        $trans = Transaction::where('created_at', 'like', '%' . Carbon::now()->format('Y-m-d') . '%')->get()->sum('cash');
        return view('index', compact('customer', 'pay','trans','sess'));
    });
    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('add-customer', [CustomerController::class, 'create']);
    Route::post('add-customer', [CustomerController::class, 'store']);
    Route::get('edit-customer/{name}', [CustomerController::class, 'edit']);
    Route::post('edit-customer/{name}', [CustomerController::class, 'update']);
    Route::get('delete-customer/{name}', [CustomerController::class, 'destroy']);
    Route::get('billing', [TransactionController::class, 'index']);
    Route::post('/delete-transaction/{id}', [TransactionController::class, 'destroy']);
    Route::post('transaction', [TransactionController::class, 'store']);
    Route::get('/search-name', [CustomerController::class, 'searchName']);
    Route::get('/result', [CustomerController::class, 'resultName']);
    Route::middleware( 'admin')->group(function () {
        // down Payment
        Route::get('/down-payment', [DownPaymentController::class, 'index']);
        Route::post('/down-payment', [DownPaymentController::class, 'store']);
        Route::delete('/down-payment/{id}', [DownPaymentController::class, 'destroy']);
        Route::put('/down-payment-edit/{id}', [DownPaymentController::class, 'update']);

        // color
        Route::resource('/color', ColorController::class);

        // category
        Route::resource('/category', CategoryController::class);

        // session
        Route::resource('/session', SessionController::class);

        // user
        Route::resource('/user', UserController::class);
        Route::post('/user-password/{id}',[UserController::class, 'confirmPass']);

        // price list
        Route::get('/price-list', [PriceListController::class, 'index']);
        Route::post('/price-list', [PriceListController::class, 'store']);
        Route::put('/price-list/{id}', [PriceListController::class, 'update']);
        Route::delete('/price-list/{id}', [PriceListController::class, 'destroy']);

        // report
        Route::get('/report-day', [ReportController::class, 'reportDay']);
        Route::get('/report-finance', [ReportController::class, 'reportFinance']);
        Route::get('/report-shirt', [ReportController::class, 'reportShirt']);

        Route::get('/reset', function(){
            return view('reset');
        });

        Route::post('/reset-customer', [CustomerController::class, 'resetCust']);
    });
});