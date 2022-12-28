<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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

Route::get('/pegawai',[EmployeesController::class, 'index'])->name('pegawai' );

Route::get('/tambahpegawai',[EmployeesController::class, 'tambahpegawai'])->name('tambahpegawai' );
Route::post('/insertdata',[EmployeesController::class, 'insertdata'])->name('insertdata' );

Route::get('/tampilkandata/{id}',[EmployeesController::class, 'tampilkandata'])->name('tampilkandata' );
Route::post('/updatedata/{id}',[EmployeesController::class, 'updatedata'])->name('updatedata' );
Route::get('/deletedata/{id}',[EmployeesController::class, 'deletedata'])->name('deletedata' );

//exportPDF
Route::get('/exportpdf',[EmployeesController::class, 'exportpdf'])->name('exportpdf' );