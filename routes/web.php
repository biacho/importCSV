<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportCSVController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [ImportController::class, 'index']);
Route::post('import', [ImportController::class, 'importExcelCSV']);

Route::get('/importCSV', [ImportCSVController::class, 'show']);
Route::post('/load', [ImportCSVController::class, 'importCSV']);
