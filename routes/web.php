<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\PenilaianKinerjaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])
->middleware(['auth', 'verified'])->name('home');

Route::resource('/home/pegawai', PegawaiController::class);
Route::resource('/home/jabatan', JabatanController::class);
Route::resource('/home/indikator', IndikatorController::class);
Route::resource('/home/unit_kerja', UnitKerjaController::class);
Route::resource('/home/periode', PeriodeController::class);
Route::resource('/home/penilaian_kinerja', PenilaianKinerjaController::class);
Route::resource('/home/register_akun', UsersController::class);


Route::get('export-pdf/{id}', [PenilaianKinerjaController::class, 'exportPdf'])->name('export-pdf');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
