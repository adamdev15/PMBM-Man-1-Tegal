<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class , 'index'])->name('landing');
Route::get('/pendaftaran', [RegistrationController::class , 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [RegistrationController::class , 'store'])->name('pendaftaran.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:admin,petugas'])->group(function () {
            Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');
            Route::post('/admin/verify/{id}', [DashboardController::class , 'verify'])->name('admin.verify');

            Route::middleware(['role:admin'])->group(function () {
                    Route::post('/admin/unverify/{id}', [DashboardController::class , 'unverify'])->name('admin.unverify');
                }
                );

                Route::get('/admin/casis', [\App\Http\Controllers\Admin\CasisController::class , 'index'])->name('admin.casis.index');
                Route::get('/admin/casis/{casis}', [\App\Http\Controllers\Admin\CasisController::class , 'show'])->name('admin.casis.show');

                Route::middleware(['role:admin'])->group(function () {
                    Route::get('/admin/casis/create', [\App\Http\Controllers\Admin\CasisController::class , 'create'])->name('admin.casis.create');
                    Route::post('/admin/casis', [\App\Http\Controllers\Admin\CasisController::class , 'store'])->name('admin.casis.store');
                    Route::get('/admin/casis/{casis}/edit', [\App\Http\Controllers\Admin\CasisController::class , 'edit'])->name('admin.casis.edit');
                    Route::put('/admin/casis/{casis}', [\App\Http\Controllers\Admin\CasisController::class , 'update'])->name('admin.casis.update');
                    Route::delete('/admin/casis/{casis}', [\App\Http\Controllers\Admin\CasisController::class , 'destroy'])->name('admin.casis.destroy');

                    Route::post('/admin/casis/{id}/selection', [\App\Http\Controllers\Admin\CasisController::class , 'updateSelection'])->name('admin.casis.selection');

                    Route::resource('admin/users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
                    Route::get('/admin/settings', [SettingController::class , 'index'])->name('admin.settings');
                    Route::post('/admin/settings', [SettingController::class , 'update'])->name('admin.settings.update');

                    Route::get('/admin/nilai', [\App\Http\Controllers\Admin\NilaiController::class , 'index'])->name('admin.nilai.index');
                    Route::get('/admin/nilai/download', [\App\Http\Controllers\Admin\NilaiController::class , 'download'])->name('admin.nilai.download');
                }
                );
            }
            );

            Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
        });

// Student Login Routes (Public)
Route::get('/login-siswa', [\App\Http\Controllers\CasisLoginController::class , 'showLoginForm'])->name('casis.login');
Route::post('/login-siswa', [\App\Http\Controllers\CasisLoginController::class , 'login'])->name('casis.login.post');

// Student Protected Routes
// Student Protected Routes
Route::middleware([\App\Http\Middleware\EnsureCasisLoggedIn::class])->group(function () {
    Route::get('/siswa/dashboard', [\App\Http\Controllers\CasisLoginController::class , 'dashboard'])->name('casis.dashboard');
    Route::post('/siswa/logout', [\App\Http\Controllers\CasisLoginController::class , 'logout'])->name('casis.logout');

    // PDF Printing
    Route::get('/siswa/print-kartu', [\App\Http\Controllers\CasisLoginController::class , 'printKartu'])->name('casis.print.kartu');
    Route::get('/siswa/print-rekap', [\App\Http\Controllers\CasisLoginController::class , 'printRekap'])->name('casis.print.rekap');
    Route::get('/siswa/print-formulir', [\App\Http\Controllers\CasisLoginController::class , 'printFormulir'])->name('casis.print.formulir');

    // Document Upload
    Route::post('/siswa/upload-berkas', [\App\Http\Controllers\CasisLoginController::class , 'uploadBerkas'])->name('casis.upload.berkas');
});

require __DIR__ . '/auth.php';