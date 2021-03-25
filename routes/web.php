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
    return view('upload');
});
Route::post('/import/excel', [App\Http\Controllers\ExcelController::class, 'store'])->name('import_excel');
Route::post('/chunk', [App\Http\Controllers\ExcelController::class, 'chunkUpload'])->name('excel_chunk');