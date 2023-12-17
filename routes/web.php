<?php


use App\Http\Controllers\Admin\DapilController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\RekapsuarapartaiController;
use App\Http\Controllers\Admin\RscController;
use App\Http\Controllers\Admin\SesiController;
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
        // untuk membuat route caleg
        Route::resource('/dapil', DapilController::class, ['as'=>'admin']);

    Route::resource('/kecamatan', KecamatanController::class, ['as'=>'admin'])->middleware('userAkses:admin');

    Route::resource('/kelurahan', KelurahanController::class, ['as'=>'admin'])->middleware('userAkses:admin');

    Route::resource('/tpsuara', TpsuaraController::class, ['as'=>'admin'])->middleware('userAkses:admin');

    Route::resource('/partai', PartaiController::class, ['as'=>'admin'])->middleware('userAkses:admin');

    Route::resource('/caleg', CalegController::class, ['as'=>'admin'])->middleware('userAkses:admin');

    Route::resource('/rekap_suara_caleg', RscController::class, ['as'=>'admin'])->middleware('userAkses:saksi');

    Route::resource('/rekap_suara_partai', RekapsuarapartaiController::class, ['as'=>'admin'])->middleware('userAkses:saksi');
});





// Route::get('/', function () {
//     return view('admin.dashboard.index');
// });

// Route::prefix('admin')->group(function () {
//         // untuk membuat route caleg

//     });
    // Route::get('/admin', [AdminController::class, 'index']); //memanggil tampilan admin index
    // Route::get('/admin/admins', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    // Route::get('/admin/saksi', [AdminController::class, 'saksi'])->middleware('userAkses:saksi');
