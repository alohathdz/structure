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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/position/index', [App\Http\Controllers\PositionController::class, 'index'])->name('position_index');
Route::get('/employee/index', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee_index');
Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee_create');
Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee_store');