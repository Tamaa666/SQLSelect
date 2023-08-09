<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MateriMahasiswaController;
use App\Http\Controllers\SimulasiLatihanController;
use App\Http\Controllers\SimulasiUjianController;
use App\Http\Controllers\NilaiSimulasiController;
use App\Http\Controllers\SimulasiLatihanMahasiswaController;
use App\Http\Controllers\SimulasiUjianMahasiswaController;
use App\Http\Controllers\SoalSQLController;
use App\Http\Controllers\PaketSoalController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\TestCodeController;

/*                                                                       *\
|-------------------------------------------------------------------------|
| ============================== Web Routes ==============================|
|-------------------------------------------------------------------------|
*/                                                                         

Route::get('/', function () {
    return redirect('login');
});

//login
Route::post('/login_user', [LoginController::class, 'loginUser']);
Auth::routes();

//home 
Route::get('/home', [HomeController::class, 'index']);

//kelas
Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/kelas/create', [KelasController::class, 'create']);
Route::get('/kelas/edit/{id}', [KelasController::class, 'edit']);
Route::get('/kelas/delete/{id}', [KelasController::class, 'delete']);
Route::post('/kelas/store', [KelasController::class, 'store']);
Route::post('/kelas/update/{id}', [KelasController::class, 'update']);
//materi
Route::get('/materi', [MateriController::class, 'index']);
Route::get('/materi/create', [MateriController::class, 'create']);
Route::get('/materi/edit/{id}', [MateriController::class, 'edit']);
Route::get('/materi/delete/{id}', [MateriController::class, 'delete']);
Route::post('/materi/store', [MateriController::class, 'store']);
Route::post('/materi/update/{id}', [MateriController::class, 'update']);
//materi_mahasiswa
Route::get('/materi_mahasiswa', [MateriMahasiswaController::class, 'index']);
//mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']);
Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit']);
Route::get('/mahasiswa/delete/{id}', [MahasiswaController::class, 'delete']);
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
Route::post('/mahasiswa/import', [MahasiswaController::class, 'import']);
//data_table
Route::get('/data_table', [DataTableController::class, 'index']);
Route::get('/data_table/create', [DataTableController::class, 'create']);
Route::get('/data_table/edit/{id}', [DataTableController::class, 'edit']);
Route::get('/data_table/delete/{id}', [DataTableController::class, 'delete']);
Route::post('/data_table/store', [DataTableController::class, 'store']);
Route::post('/data_table/update/{id}', [DataTableController::class, 'update']);
//soal_sql
Route::get('/soal_sql', [SoalSQLController::class, 'index']);
Route::get('/soal_sql/create', [SoalSQLController::class, 'create']);
Route::get('/soal_sql/edit/{id}', [SoalSQLController::class, 'edit']);
Route::get('/soal_sql/delete/{id}', [SoalSQLController::class, 'delete']);
Route::post('/soal_sql/store', [SoalSQLController::class, 'store']);
Route::post('/soal_sql/update/{id}', [SoalSQLController::class, 'update']);
//paket_soal
Route::get('/paket_soal', [PaketSoalController::class, 'index']);
Route::get('/paket_soal/create', [PaketSoalController::class, 'create']);
Route::get('/paket_soal/edit/{id}', [PaketSoalController::class, 'edit']);
Route::get('/paket_soal/delete/{id}', [PaketSoalController::class, 'delete']);
Route::post('/paket_soal/store', [PaketSoalController::class, 'store']);
Route::post('/paket_soal/update/{id}', [PaketSoalController::class, 'update']);
//simulasi_latihan
Route::get('/simulasi_latihan', [SimulasiLatihanController::class, 'index']);
Route::get('/simulasi_latihan/create', [SimulasiLatihanController::class, 'create']);
Route::get('/simulasi_latihan/edit/{id}', [SimulasiLatihanController::class, 'edit']);
Route::get('/simulasi_latihan/delete/{id}', [SimulasiLatihanController::class, 'delete']);
Route::post('/simulasi_latihan/store', [SimulasiLatihanController::class, 'store']);
Route::post('/simulasi_latihan/update/{id}', [SimulasiLatihanController::class, 'update']);
//simulasi_latihan_mahasiswa
Route::get('/simulasi_latihan_mahasiswa', [SimulasiLatihanMahasiswaController::class, 'index']);
Route::get('/simulasi_latihan_mahasiswa_review/{id}/{paket_id}/{sesi}', [SimulasiLatihanMahasiswaController::class, 'review']);
Route::get('/simulasi_latihan_mahasiswa_review/{id}/{paket_id}/{sesi}/{mhs_id}', [SimulasiLatihanMahasiswaController::class, 'review']);
Route::get('/simulasi_latihan_selesai/{id}/{type}', [SimulasiLatihanMahasiswaController::class, 'selesai']);
Route::get('/simulasi_latihan_kerjakan/{id}/{paket_id}/{soal_id}', [SimulasiLatihanMahasiswaController::class, 'kerjakan']);
Route::post('/simulasi_latihan_submit', [SimulasiLatihanMahasiswaController::class, 'lanjut']);
//simulasi_ujian
Route::get('/simulasi_ujian', [SimulasiUjianController::class, 'index']);
Route::get('/simulasi_ujian/create', [SimulasiUjianController::class, 'create']);
Route::get('/simulasi_ujian/edit/{id}', [SimulasiUjianController::class, 'edit']);
Route::get('/simulasi_ujian/delete/{id}', [SimulasiUjianController::class, 'delete']);
Route::post('/simulasi_ujian/store', [SimulasiUjianController::class, 'store']);
Route::post('/simulasi_ujian/update/{id}', [SimulasiUjianController::class, 'update']);
//simulasi_ujian_mahasiswa
Route::get('/simulasi_ujian_mahasiswa', [SimulasiUjianMahasiswaController::class, 'index']);
Route::get('/simulasi_ujian_mahasiswa_review/{id}/{paket_id}/{sesi}', [SimulasiUjianMahasiswaController::class, 'review']);

Route::get('/simulasi_ujian_selesai/{id}/{type}', [SimulasiUjianMahasiswaController::class, 'selesai']);
Route::get('/simulasi_ujian_kerjakan/{id}/{paket_id}/{soal_id}', [SimulasiUjianMahasiswaController::class, 'kerjakan']);
Route::post('/simulasi_ujian_submit', [SimulasiUjianMahasiswaController::class, 'lanjut']);
//nilai mahasiswa
Route::get('/nilai_simulasi', [NilaiSimulasiController::class, 'index']);
Route::get('/nilai_export', [NilaiSimulasiController::class, 'export']);

//test_code
Route::get('/test_code', [TestCodeController::class, 'test']);