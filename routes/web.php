<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

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

Route::get('file-import-export', [PersonController::class, 'fileImportExport']);
Route::post('file-import', [PersonController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [PersonController::class, 'fileExport'])->name('file-export');