<?php

use App\Http\Controllers\Admin\DapilController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\TpsuaraController;
use App\Http\Controllers\Admin\CalegController;
use App\Http\Controllers\Admin\PartaiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.dashboard.index');
});

Route::prefix('admin')->group(function () {
        // untuk membuat route Barang
        Route::resource('/dapil', DapilController::class, ['as'=>'admin']);

        Route::resource('/kecamatan', KecamatanController::class, ['as'=>'admin']);

        Route::resource('/kelurahan', KelurahanController::class, ['as'=>'admin']);

        Route::resource('/tpsuara', TpsuaraController::class, ['as'=>'admin']);

        Route::resource('/caleg', CalegController::class, ['as'=>'admin']);

        Route::resource('/partai', PartaiController::class, ['as' => 'admin']);


    });
    
