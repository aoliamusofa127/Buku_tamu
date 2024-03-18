<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\TentangDinasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// route ennd user in landing page
Route::controller(TamuController::class)->group(function () {
    Route::get('/form-tamu', 'GetViewFormTamu');
    Route::post('/add-tamu', 'AddTamu');
});

// route admin
Route::get('/dashboard', [DashboardController::class, 'GetDataDashboard'])->middleware('auth');
Route::controller(TamuController::class)->middleware('auth')->group(function () {
    Route::get('/tamu', 'GetAllTamu');
    Route::post('/tamu-post', 'AddTamuWithAdmin');
    Route::post('/tamu-update', 'UpdateDataTamu');
    Route::get('/delete-tamu/{id}', 'DeleteTamu');
});

Route::controller(DataMasterController::class)->middleware('auth')->group(function () {
    Route::get('/dataMaster', 'GetAllDataMaster')->name('data-master');
    Route::post('/add-dataMaster', 'AddDataMaster');
    Route::post('/update-dataMaster', 'UpdateDataMaster');
    Route::get('/delete-dataMaster/{id}', 'DeleteDataMaster');
});

Route::controller(PegawaiController::class)->middleware('auth')->group(function () {
    Route::get('/pegawai', 'GetAllPegawai');
    Route::post('/add-pegawai', 'AddDataPegawai');
    Route::post('/update-pegawai', 'UpdateDataPegawai');
    Route::get('/delete-pegawai/{id}', 'DeleteDataPegawai');
});


// route index landingpage
Route::get('/', [HomeController::class, 'ViewIndexLandingpage']);

// login admin from landingpage
Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'login')->name('auth.login'); //get view login
    Route::post('/login-akun', 'authenticate'); // post  data login
});

// route admin
Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/users', 'GetAllUser');
    // Route::get('/register-view', 'RegisterView');
    Route::post('/register', 'AddAkunUser');
    Route::post('/update-user', 'UpdateUser');
    Route::get('/delete-user/{id}', 'DeleteUser');
    Route::get('/logout', 'logout');
});

// route tentang dinas
Route::controller(TentangDinasController::class)->middleware('auth')->group(function () {
    Route::get('/dinas', 'GetAllTentangDinas');
    Route::post('/add-tentang-dinas', 'AddTentangDinas');
    Route::post('/update-tentang-dinas', 'UpdateTentangDinas');
    Route::get('/delete-tentang-dinas/{id}', 'DeleteTentangDinas');
});
