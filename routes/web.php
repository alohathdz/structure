<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resources([
    'employees' => EmployeeController::class,
    'positions' => PositionController::class,
]);

Route::get('/report/education', [EmployeeController::class, 'report'])->name('employees.education');
Route::get('/report/position', [PositionController::class, 'report'])->name('positions.null');

Route::get('/test', function(){
    $var = "2016-10-01";
    return formatdateeng($var);
});