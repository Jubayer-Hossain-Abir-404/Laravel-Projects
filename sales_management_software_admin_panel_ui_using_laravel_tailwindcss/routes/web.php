<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});


// super admin

//to get the dashboard

Route::get('/', [\App\Http\Controllers\SuperAdmin\Dashboard\DashboardController::class, 'index'])->name('dashboard');


// to get the area page

Route::get('/area', [\App\Http\Controllers\SuperAdmin\Area\AreaController::class, 'index'])->name('area');

// to get the area page

Route::get('/zone', [\App\Http\Controllers\SuperAdmin\Zone\ZoneController::class, 'index'])->name('zone');

// to get the target page

Route::get('/target', [\App\Http\Controllers\SuperAdmin\Target\TargetController::class, 'index'])->name('target');

// to get the client page

Route::get('/client', [\App\Http\Controllers\SuperAdmin\Client\ClientController::class, 'index'])->name('client');

// to get the representative page

Route::get('/representative', [\App\Http\Controllers\SuperAdmin\Representative\RepresentativeController::class, 'index'])->name('representative');

// to get the monthly sales report page

Route::get('/monthly_sales_report', [\App\Http\Controllers\SuperAdmin\MonthlySalesReport\MonthlySalesReportController::class, 'index'])->name('monthlySalesReport');
