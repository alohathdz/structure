<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resources([
    'employees' => EmployeeController::class,
    'positions' => PositionController::class,
]);

Route::get('/report/education', [EmployeeController::class, 'education'])->name('employees.education');
Route::get('/report/age', [EmployeeController::class, 'age'])->name('employees.age');
Route::get('/report/position', [PositionController::class, 'report'])->name('positions.null');

Route::get('/test', function(){
    line('test', '7bH2RxyRinrEwHJDVGRyZufzhBq8ZYBJaZeWYFZuA53');
});