<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListAnggotaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VerificationReportController;
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

Route::get('/', [PageController::class, 'login'])->name('index');
Route::post('/logout', [AuthController::class, 'logout'])->name('post.logout');
Route::get('/coba-dokumen', [PengajuanController::class, 'contoh_report'])->name('pengajuan.generateReport');

Route::middleware('guest')->group(function () {
    Route::get('/login', [PageController::class, 'login'])->name('page.login');
    Route::post('/login/process', [AuthController::class, 'login'])->name('post.login');
});

// (level : semua level)
Route::middleware('auth')->group(function () {
    Route::get('/forgot-password', [PageController::class, 'forgot_password'])->name('page.forgot-password');
    Route::get('/change-password/{id_pengguna}', [PageController::class, 'change_password'])->name('page.change-password');
    Route::post('/change-password/{id_pengguna}/process', [AuthController::class, 'change_password'])->name('post.change-password');
    Route::get('/page/profile', [PageController::class, 'profile'])->name('page.profile');
    Route::PUT('/page/profile/{id}', [AuthController::class, 'update'])->name('post.profile');
    Route::resource('/page/list-anggota', ListAnggotaController::class);
});

// Report (level : babinsa dan danramil)
Route::middleware(['auth', 'level:babinsa,danramil'])->group(function () {
    Route::resource('/page/report', ReportController::class);
    Route::get('/download-report/{filename}', [ReportController::class, 'downloadReport'])->name('download.report');
    Route::get('/page/show-index', [ReportController::class, 'show_index'])->name('report.show-index');
    Route::get('/page/show-other-index', [ReportController::class, 'show_other_index'])->name('report.show-other-index');
    Route::get('/page/show-other-index/{report}/document', [ReportController::class, 'other_document_completion'])->name('report.other-document-completion');
    Route::POST('/page/show-other-index/document/publish', [ReportController::class, 'other_document_completion_publish'])->name('report.other-document-completion-publish');
});

// Report (level : danramil dan dandim)
Route::middleware(['auth', 'level:danramil,dandim'])->group(function () {
    // Verification Report
    Route::resource('/verification-report', VerificationReportController::class);
});

// Report (level : dandim)
Route::middleware(['auth', 'level:dandim'])->group(function () {
    // Verification Report
    Route::resource('/verification-pengajuan', VerificationReportController::class);
});

// Letter (level : staf)
Route::middleware(['auth', 'level:staf'])->group(function () {
    Route::resource('/page/pengajuan', PengajuanController::class);
    Route::get('/page/show-index-pengajuan', [PengajuanController::class, 'show_index'])->name('pengajuan.show-index');
    Route::get('/page/show-other-index-pengajuan', [PengajuanController::class, 'show_other_index'])->name('pengajuan.show-other-index');
    Route::get('/page/show-other-index-pengajuan/{pengajuan}/document', [PengajuanController::class, 'show_other_document'])->name('pengajuan.other-document-pengajuan');
    Route::POST('/page/show-other-index-pengajuan/document/publish', [PengajuanController::class, 'post_show_other_document'])->name('post.other-document-pengajuan');
    Route::get('/download-pengajuan/{filename}', [PengajuanController::class, 'downloadPengajuan'])->name('download.pengajuan');
});
