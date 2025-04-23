<?php

use App\Models\UlasaBuku;
use App\Models\KoleksiPribadi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\UlasaBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KoleksiPribadiController;

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
    return view('welcome');
});

//login register laravel
// Auth::routes(
//     ['verify'=>true]
// );

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::get('login', function () {
    return view('user/login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('register', function () {
    return view('user/register');
})->name('register');

Route::post('register', [LoginController::class, 'register'])->name('register');

Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::middleware(['auth'])->group(function () {

//user
Route::get('/dashboard', [PeminjamController::class,'index'])->name('dashboard');

//peminjaman & pengembalian
Route::get('/peminjaman', [PeminjamanController::class,'peminjaman'])->name('peminjaman');
Route::get('/riwayatpeminjaman', [PeminjamanController::class,'riwayatpeminjaman'])->name('riwayatpeminjaman');
Route::post('/prosespeminjaman', [PeminjamanController::class,'prosespeminjaman'])->name('prosespeminjaman');
Route::put('/kembalikanbuku/{id}', [PeminjamanController::class,'kembalikanbuku'])->name('kembalikanbuku');

//koleksibukupribadi
Route::get('/koleksipribadi', [KoleksiPribadiController::class,'koleksipribadi'])->name('koleksipribadi');
Route::get('/tambahkoleksi', [KoleksiPribadiController::class,'tambahkoleksi'])->name('tambahkoleksi');
Route::post('/proseskoleksi', [KoleksiPribadiController::class,'proseskoleksi'])->name('proseskoleksi');
Route::delete('/hapuskoleksi/{id}', [KoleksiPribadiController::class,'hapuskoleksi'])->name('hapuskoleksi');

//ulasanbuku
Route::get('/ulasanbuku', [UlasaBukuController::class,'ulasanbuku'])->name('ulasanbuku');
Route::get('/tambahulasan/{id}', [UlasaBukuController::class,'tambahulasan'])->name('tambahulasan');
Route::post('/prosesulasan', [UlasaBukuController::class,'prosesulasan'])->name('prosesulasan');
Route::get('/tampilkanulasan/{id}', [UlasaBukuController::class,'tampilkanulasan'])->name('tampilkanulasan');
Route::get('/editulasan/{id}', [UlasaBukuController::class,'editulasan'])->name('editulasan');
Route::post('/updateulasan/{id}', [UlasaBukuController::class,'updateulasan'])->name('updateulasan');

});

//admin
Route::middleware(['auth', 'admin'])->group(function () {

//databuku
//index
Route::get('/databuku', [BukuController::class,'index'])->name('databuku');
Route::get('/tambahbuku', [BukuController::class,'create'])->name('tambahbuku');
Route::post('/insertbuku', [BukuController::class,'store'])->name('insertbuku');
Route::get('/editbuku/{id}', [BukuController::class,'edit'])->name('editbuku');
Route::post('/updatebuku/{id}', [BukuController::class, 'update'])->name('updatebuku');
Route::get('/hapusbuku/{id}', [BukuController::class,'destroy'])->name('hapusbuku');
Route::get('/databukupdf', [BukuController::class,'eksporpdf'])->name('databukupdf');

//datauser
Route::get('/datauser', [PenggunaController::class,'index'])->name('datauser');
Route::get('/tambahuser', [PenggunaController::class,'create'])->name('tambahuser');
Route::post('/insertuser', [PenggunaController::class,'store'])->name('insertuser');
Route::get('/edituser/{id}', [PenggunaController::class,'edit'])->name('edituser');
Route::post('/updateuser/{id}', [PenggunaController::class, 'update'])->name('updateuser');
Route::get('/hapususer/{id}', [PenggunaController::class,'destroy'])->name('hapususer');

//dataulasan
Route::get('/dataulasan', [UlasaBukuController::class,'index'])->name('dataulasan');

//datapeminjaman
Route::get('/datapeminjaman', [PeminjamanController::class,'index'])->name('datapeminjaman');

//datakoleksi
Route::get('/datakoleksi', [KoleksiPribadiController::class,'index'])->name('datakoleksi');

});

//petugas
Route::middleware(['auth', 'petugas'])->group(function () {

    //databuku
    //index
    Route::get('/databuku', [BukuController::class,'index'])->name('databuku');
    Route::get('/tambahbuku', [BukuController::class,'create'])->name('tambahbuku');
    Route::post('/insertbuku', [BukuController::class,'store'])->name('insertbuku');
    Route::get('/editbuku/{id}', [BukuController::class,'edit'])->name('editbuku');
    Route::post('/updatebuku/{id}', [BukuController::class, 'update'])->name('updatebuku');
    Route::get('/hapusbuku/{id}', [BukuController::class,'destroy'])->name('hapusbuku');
    Route::get('/databukupdf', [BukuController::class,'eksporpdf'])->name('databukupdf');
    
    //datauser
    Route::get('/datauser', [PenggunaController::class,'index'])->name('datauser');
    Route::get('/tambahuser', [PenggunaController::class,'create'])->name('tambahuser');
    Route::post('/insertuser', [PenggunaController::class,'store'])->name('insertuser');
    Route::get('/edituser/{id}', [PenggunaController::class,'edit'])->name('edituser');
    Route::post('/updateuser/{id}', [PenggunaController::class, 'update'])->name('updateuser');
    Route::get('/hapususer/{id}', [PenggunaController::class,'destroy'])->name('hapususer');
    
    //dataulasan
    Route::get('/dataulasan', [UlasaBukuController::class,'index'])->name('dataulasan');
    
    //datapeminjaman
    Route::get('/datapeminjaman', [PeminjamanController::class,'index'])->name('datapeminjaman');
    
    //datakoleksi
    Route::get('/datakoleksi', [KoleksiPribadiController::class,'index'])->name('datakoleksi');
    
    });