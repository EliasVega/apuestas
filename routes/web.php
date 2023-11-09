<?php

use App\Http\Controllers\CashInflowController;
use App\Http\Controllers\CashOutflowController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\LotteryController;
use App\Http\Controllers\LotteryPlayController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\ProhibitedNumberController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use FontLib\Table\Type\name;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('cashInflow', CashInflowController::class);
Route::resource('cashOutflow', CashOutflowController::class);
Route::resource('cashRegister', CashRegisterController::class);
Route::resource('company', CompanyController::class);
Route::resource('department', DepartmentController::class);
Route::resource('indicator', IndicatorController::class);
Route::resource('lottery', LotteryController::class);
Route::resource('lotteryPlay', LotteryPlayController::class);
Route::resource('municipality', MunicipalityController::class);
Route::resource('permission', PermissionController::class);
Route::resource('play', PlayController::class);
Route::resource('prohibitedNumber', ProhibitedNumberController::class);
Route::resource('roles', RolController::class);
Route::resource('user', UserController::class);


Route::get('cashRegister/show_cashOutflow/{id}', [CashRegisterController::class, 'show_cashOutflow'])->name('show_cashOutflow');
Route::get('cashRegister/show_cashInflow/{id}', [CashRegisterController::class, 'show_cashInflow'])->name('show_cashInflow');
Route::get('cashRegister/cashRegisterPos/{id}', [CashRegisterController::class, 'cashRegisterPos'])->name('cashRegisterPos');
Route::get('cashRegister/casRegisterClose/{id}', [CashRegisterController::class, 'cashRegisterClose'])->name('cashRegisterClose');

Route::get('company/create/{id}', [CompanyController::class, 'getMunicipalities']);
Route::post('company/logout', [CompanyController::class, 'logout'])->name('logout_company');
Route::get('company/status/{id}', [CompanyController::class, 'status'])->name('companyStatus');

Route::get('indicator/dianStatus/{id}', [IndicatorController::class, 'dianStatus'])->name('dianStatus');
Route::get('indicator/posStatus/{id}', [IndicatorController::class, 'posStatus'])->name('posStatus');
Route::get('indicator/logoStatus/{id}', [IndicatorController::class, 'logoStatus'])->name('logoStatus');
Route::get('indicator/payrollStatus/{id}', [IndicatorController::class, 'payrollStatus'])->name('payrollStatus');
Route::get('indicator/accountingStatus/{id}', [IndicatorController::class, 'accountingStatus'])->name('accountingStatus');
Route::get('indicator/inventoryStatus/{id}', [IndicatorController::class, 'inventoryStatus'])->name('inventoryStatus');
Route::get('indicator/productPrice/{id}', [IndicatorController::class, 'productPrice'])->name('productPrice');
Route::get('indicator/materialStatus/{id}', [IndicatorController::class, 'materialStatus'])->name('materialStatus');
Route::get('indicator/restaurantStatus/{id}', [IndicatorController::class, 'restaurantStatus'])->name('restaurantStatus');

Route::get('posPlay', [PlayController::class, 'posPlay'])->name('posPlay');
Route::get('play/playPos/{id}', [PlayController::class, 'playPos'])->name('playPos');

Route::get('user/status/{id}', [UserController::class, 'status'])->name('status');
Route::get('inactive', [UserController::class, 'inactive'])->name('inactive');
Route::patch('user/logout', [UserController::class, 'logout'])->name('logout_user');

